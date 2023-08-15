@extends('layouts.appp')
@section('css')
<style>
.red{
color:red;
}
#percent:hover{
font-size: 115%;
}
.error{
color:red;
}
.alert-danger {
background-color: red !important;
}
.dtsb-criteria{
width:100%;
margin:auto;
text-align:center;
}
.dtsb-inputCont{
display: initial;
}
div.dtsb-searchBuilder {
margin-bottom: -2rem;
}
</style>
@endsection
@section('content')
<div id="content">
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-2">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">
<a class="btn" data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem">  جدول التقييمات</a>
<br>
<br>
<a class="btn   "  style="margin-right: 23%; color:white;background-color: #6E6B7B" href="/export">   تصدير
</a>

</h6>
<div class="row">
<div class="col-md-12">
<h4 style="text-align:center">الاسم </h4>
<select id="sear" class="form-control" >
<option value="All">All</option>

@foreach($regs  as $item)
<option value="{{$item->name}}">{{$item->name}}</option>
@endforeach
</select>
</div>
</div>
</div>
<div class="card-body">
<div class="table-responsive">
<table  style="padding: 2%" id="datatable" class="table table-bordered yajra-datatable"  width="100%" cellspacing="0">
<thead style="text-align: center">
<tr style="text-align: center">
<th style="text-align: center">رقم الاشتراك</th>
<th style="text-align: center">الاسم</th>
@foreach($evas as $ev)
<th style="text-align: center">تقييم  {{$ev->name}} </th>
@endforeach
<th style="text-align: center">المتوسط</th>

</tr>
</thead>
<tbody>
@foreach($regs as $re )
<tr>
<td style="text-align: center">
<label>
{{$re->id}}
</label>
</td>
<td style="text-align: center">
<label>
{{$re->name}}
</label>
</td>
@if($re->evas != null)
@for($i=0;$i<count($evas);$i++)
<?php
$temp=0
?>

@foreach($re->evas as $ev1)
@if($ev1->user_id==$evas[$i]->id)
<?php
$temp=1;

?>


<td >
<a id="percent" data-toggle="modal" data-target="#showdetails{{$ev1->id}}">                  <label style="cursor: pointer">
{{$ev1->percent}}    </label></a>


<div class="modal fade" id="showdetails{{$ev1->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">التفاصيل</h5>
</div>
<div class="modal-body">
<div class="row">
<div style="display: inline-block ;width: 19%;padding: 1%;margin-right: 2%" class="">  بناء القصيدة والوزن %50</div>
<div style="display: inline-block ;width: 19%;padding: 1%"class="">ابداع الشاعر وتمييزه %10 </div>
<div style="display: inline-block ;width: 19%;padding: 1%" class="">حسن الصوت و الالقاء %10  </div>
<div style="display: inline-block ;width: 19%;padding: 1%" class="">لغة وسلاسة المفردة %10</div>
<div style="display: inline-block ;width: 19%;padding: 1%" class="">الكاريزما وقوة الحضور %20 </div>
</div>
<div class="row">
<div  style="text-align: center;display: inline-block ;width: 19%;">
<label>
{{$ev1->build}}    </label>
</div><div  style="text-align: center;display: inline-block ;width: 19%;">
<label>
{{$ev1->creative}}    </label>
</div><div  style="text-align: center;display: inline-block ;width: 19%;">
<label>
{{$ev1->sound}}    </label>
</div><div  style=" text-align: center;display: inline-block ;width: 19%;">
<label>

{{$ev1->word}}    </label>
</div><div style="text-align: center; display: inline-block ;width: 19%;">
<label>
{{$ev1->view}}    </label>

</div>
</div>
<div class="row">
<div class="col-12">الملاحظات </div>
<div style=" padding:3%; border: solid #e2d3d3 0.1px;background-color: white" class="col-12"><label>
{{$ev1->notes}}    </label>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
</div>
</div>
</div>
</div>
</div>







</td>

@endif
@endforeach
@if($temp==0)

<td></td>

@endif

@endfor

@endif
<td style="text-align: center">
<?php

$avg=0?>
@foreach($re->evas as $ev1)
<div style="display: none"> {{ $avg+=$ev1->percent}}
</div>

@endforeach
<label>{{ number_format((float)$avg/count($evas), 2, '.', '')}}</label>
</td>
</tr>


@endforeach
</tbody>
</table>
</div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>


@push('script')

<script>
$(document).ready(function() {
var table=    $('#datatable').DataTable(
{  initComplete: function () {

this.api().column(1).every(function () {
var column = this;
// Put the HTML of the <select /> filter along with any default options
var select = $('<select class="form-control input-sm"><option value="">All</option></select>')
// remove all content from this column's header and
// append the above <select /> element HTML code into it
.appendTo($('#name'))
// execute callback when an option is selected in our <select /> filter
.on('change', function () {
// escape special characters for DataTable to perform search
var val = $.fn.dataTable.util.escapeRegex(
$(this).val()
);
// Perform the search with the <select /> filter value and re-render the DataTable
console.log(val);
column
.search(val ? '^' + val + '$' : '', true, false)
.draw();
});
// fill the <select /> filter with unique values from the column's data
column.data().unique().sort().each(function (d, j) {
select.append("<option value='" + d + "'>" + d + "</option>")
});
});
}}







);
$('#sear').on('change',function (){
var s=document.getElementById('sear');
console.log(s.value);
table.column(1).search(s.value).draw();
if(s.value == 'All')
{console.log('s.value');

table.column(1).search('').draw();

}
})
});



</script>



<script src="{{ URL::asset('/assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>



@endpush

@endsection
