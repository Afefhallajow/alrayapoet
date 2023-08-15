@extends('layouts.appp')
@section('css')
<style>
.red{
color:red;
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
<a class="btn" data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem">متقدمين غير مقيمين</a>
</h6>
<div class="row">
<div class="col-md-12">
<h4 style="text-align:center">الاسم </h4>
<span id="name"></span>
</div>
</div>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered yajra-datatable"  width="100%" cellspacing="0">
<thead>
<tr>
<th>التسلسل</th>
<th>رقم الاشتراك</th>
<th>الصورة</th>
<th>الفيديو</th>
<th>القصيدة</th>
<th>الكل</th>
<th>تمت المشاهدة</th>

<th>الإجراء</th>
</tr>
</thead>
<tbody>

</tbody>
</table>
</div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>

@push('style')

<link href="assets/SmartWizard/bootstrap.css" rel="stylesheet" type="text/css" />
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard_theme_arrows.css')}}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ asset('assets/SmartWizard/theme_new.css')}}" rel="stylesheet" type="text/css" />--}}
<link href="assets/SmartWizard/theme-ar.css" rel="stylesheet" type="text/css" />

@endpush

@push('script')

<!--<script src="{{ asset('assets/SmartWizard/jquery.min.js')}}"></script>-->

<!--<script src="{{ asset('assets/SmartWizard/bootstrap.js')}}"></script>-->
<!--<script src="{{ asset('assets/SmartWizard/custom_js.js')}}"></script>-->

<!--<script src="{{ asset('assets/SmartWizard/validator.min.js')}}"></script>-->
<!--<script type="text/javascript" src="assets/admin/lib/SmartWizard/dist/js/jquery.smartWizard.js"></script>-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
<script src="https://nightly.datatables.net/searchbuilder/js/dataTables.searchBuilder.js?_=40f0e1a3ea332af586366e40955c1713"></script>
<script type="text/javascript">
var serialNumber = 0;
$(function () {

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

var table = $('.yajra-datatable').DataTable({


ajax: "{{ route('getAllEvulatorRegistereds',['regStatus' => 'need']) }}",
"initComplete": function() {
// Select the column whose header we need replaced using its index(0 based)
this.api().column(1).every(function() {
var column = this;
// Put the HTML of the <select /> filter along with any default options
var select = $('<select class="form-control input-sm"><option value="">All</option></select>')
// remove all content from this column's header and
// append the above <select /> element HTML code into it
.appendTo($('#name'))
// execute callback when an option is selected in our <select /> filter
.on('change', function() {
// escape special characters for DataTable to perform search
var val = $.fn.dataTable.util.escapeRegex(
$(this).val()
);
// Perform the search with the <select /> filter value and re-render the DataTable
column
.search(val ? '^' + val + '$' : '', true, false)
.draw();
});
// fill the <select /> filter with unique values from the column's data
column.data().unique().sort().each(function(d, j) {
select.append("<option value='" + d + "'>" + d + "</option>")
});
});
},
columns: [
{data: 'id', name: 'id'},
{data: 'name', name: 'name'},

{data: 'image', name: 'image'},
{data: 'video', name: 'video'},
{data: 'poem', name: 'poem'},
{data: 'description', name: 'description'},
{
data: 'isshown',
name: 'isshown',
orderable: true,
searchable: true
},

{
data: 'action',
name: 'action',
orderable: true,
searchable: true
},
] ,
columnDefs: [
{
// For Responsive
responsivePriority: 14,
targets: 0
},
{
targets: 0,
render: function (data, type, full) {
return ++serialNumber;

}
},                {
targets: 1,
render: function (data, type, full) {
var text = full['id'];
return text;

}
},

{
targets: 2,
render: function (data, type, full) {
var text = full['image'];
var id=full['id']
console.log(id);

return '<a target="_blank" style="color:white;"  class="btn btn-sm btn-primary" href="/storage/images/'+text+'">عرض</a>';
}
},
{
targets: 3,
render: function (data, type, full) {
var text = full['video'];
var id=full['id']
console.log(id);

return '<a id="all"  style="color:white;"  class="btn btn-sm btn-primary" target="_blank"  href="/show/video/'+id+'">عرض</a>';
}
},
{
targets: 4,
render: function (data, type, full) {
var text = full['poem'];
var id=full['id']
console.log(id);

return '<a style="color:white;"  class="btn btn-sm btn-primary"  target="_blank" href="/storage/poems/'+text+'">عرض</a>';
}
},
{
targets: 5,
render: function (data, type, full) {
var id=full['id']
console.log(id);

return '<a id="all" style="color:white;"  class="btn btn-sm btn-primary" target="_blank" href="/showphoto/'+id+'"> عرض</a>';
}
},
{
targets: 6,
render: function (data, type, full) {
var id=full['isshown']
console.log(id);

return id;  }
},


{
// Actions
targets: 7,
render: function (data, type, full, meta) {
var id = full['id'];
var name = full['name'];
var description = full['description'];
return (
'<div>' +
'<a style="text-align:center" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal'+id+'"> <i class="fa fa-edit"></i></a>'+
'</div>'+
'<div class="modal fade" id="exampleModal'+id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
'<div class="modal-dialog" role="document">'+
'<div class="modal-content">'+
'<div class="modal-header">'+
'<h5 class="modal-title" id="exampleModalLabel">'+id+'</h5>'+
'</div>'+
'<form action="/evulate-user" id="updateUser'+id+'" class="updateUser">'+
'<div class="modal-body">'+
'<input type="hidden" name="reg_id" value="'+id+'">'+
'<label for="name">النسبة المئوية</label>'+
'<input type="number" dir="trl" class="form-control percent"  name="percent2" placeholder="ابداع الشاعر وتميزه%10  " required/>'+
'<input type="number" dir="trl" class="form-control percent" name="percent3" placeholder="لغة وسلاسة المفردة%10" required/>'+
'<input type="number" dir="trl" class="form-control percent" name="percent4" placeholder="الكاريزما وقوة الحضور%20" required/>'+
'<input type="number" dir="trl" class="form-control percent" name="percent5" placeholder="حسن الصوت والالقاء وسلامة النطق%10" required/>'+
'<input type="number" dir="trl" class="form-control percent" name="percent1" placeholder="بناء القصيدة والوزن%50" required/>'+

'<label for="speaker">ملاحظات </label>'+
'<textarea class="form-control" required name="notes">'+
'</textarea>'+
'</div>'+
'<div class="modal-footer">'+
'<button type="button" class="btn btn-secondary btnClose" data-dismiss="modal">إغلاق</button>'+
'<button type="submit" class="btn btn-primary">حفظ</button>'+
'</div>'+
'</form>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="modal fade" id="exampleOtherModal'+id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
'<div class="modal-dialog" role="document">'+
'<div class="modal-content">'+
'<div class="modal-header">'+
'<h5 class="modal-title" id="exampleModalLabel">'+name+'</h5>'+
'</div>'+
'<div class="modal-body">'+
description+
'</div>'+
'<div class="modal-footer">'+
'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'+
'</div>'+
'</div>'+
'</div>'+
'</div>'

);

}
}
]
});

$(document).on('click', '#all', function (e) {
console.log('asffa');
table.ajax.reload();
setInterval(function () {
table.ajax.reload();
},2000);

});
$(document).on('click', '#delete_btn', function (e) {
e.preventDefault();

var url = $(this).attr('href');
bootbox.confirm('سيتم حذف بيانات العضو المسجل ,هل أنت متأكد ؟', function (res) {

if (res) {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$.ajax({
'url': url,
'type': 'DELETE',
'dataType': 'json',
data: {
'_token': $('meta[name="csrf-token"]').attr('content')
},
success: function (response) {
toastr.options = {
"debug": false,
position: { X: 'Left', Y: 'Top' },
"fadeIn": 300,
"fadeOut": 1000,
"timeOut": 5000,
"extendedTimeOut": 1000
}
table.ajax.reload();
},
error: function (xhr) {

}
});
}

});
});

$(document).on('click', '#acceptReg', function (e) {
e.preventDefault();

var url = $(this).attr('href');
bootbox.confirm('سيتم قبول العضو المسجل ,هل أنت متأكد ؟', function (res) {

if (res) {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$.ajax({
'url': url,
'type': 'GET',
'dataType': 'json',
data: {
'_token': $('meta[name="csrf-token"]').attr('content')
},
success: function (response) {
toastr.options = {
"debug": false,
position: { X: 'Left', Y: 'Top' },
"fadeIn": 300,
"fadeOut": 1000,
"timeOut": 5000,
"extendedTimeOut": 1000
}
table.ajax.reload();
},
error: function (xhr) {
console.log(xhr);
}
});
}

});
});
$(document).on('click', '#all', function (e) {
console.log('asffa');
table.ajax.reload();

});

$(document).on('click', '#refuseReg', function (e) {
e.preventDefault();

var url = $(this).attr('href');
bootbox.confirm('سيتم رفض العضو المسجل ,هل أنت متأكد ؟', function (res) {

if (res) {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$.ajax({
'url': url,
'type': 'GET',
'dataType': 'json',
data: {
'_token': $('meta[name="csrf-token"]').attr('content')
},
success: function (response) {
toastr.options = {
"debug": false,
position: { X: 'Left', Y: 'Top' },
"fadeIn": 300,
"fadeOut": 1000,
"timeOut": 5000,
"extendedTimeOut": 1000
}
table.ajax.reload();
},
error: function (xhr) {
console.log(xhr);
}
});
}

});
});


$(document).on('submit', '.updateUser', function (e) {
e.preventDefault();

var url = $(this).attr('action');
var data = $(this).serialize();
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
'url': url,
'type': 'post',
'dataType': 'json',
data: data,
success: function (response) {
toastr.success('تمت العملية بنجاح');
table.ajax.reload();
// location.reload();
$('.btnClose').trigger('click');
},
error: function (xhr) {
toastr.error('حدث خطأ ما');
$(".closeModal").click();
}
});

});


});
</script>
<script>
$(function () {


$(document).on('change', '.percent', function (e) {
if ($(this).val() > 100) {
e.preventDefault();
$(this).val(100);
}
});

$(document).on('keyup', '.percent', function (e) {
if ($(this).val() > 100) {
e.preventDefault();
$(this).val(100);
}
});

// $('.percent').on('keydown keyup change', function(e){
//     if ($(this).val() > 100) {
//       e.preventDefault();
//       $(this).val(100);
//     }
// });



});
</script>
@endpush

@endsection
