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
<a class="btn" data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem">  الاعدادات</a>
<!-- Button trigger modal -->
@can('add season')
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
اضافة موسم جديد
</button>
    @endif
    @can('delete season')
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal">
حذف موسم
</button>
@endif
</h6>


</div>

<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered yajra-datatable"  width="100%" cellspacing="0">
<thead>
<tr>
</tr>
</thead>
<tbody>

<tr>
<td>
نسبة الحد الأدنى للنجاح

</td>

<td>
{{$user->therate}}
</td>
<td>
    @can('update setting')
<button type="button" class="btn btn-info btn-sm" data-toggle="modal"
data-target="#updateRate{{$user->id}}"
title="تعديل"><i
class="fa fa-edit"></i></button>

@endcan
</td>
<div class="modal fade" id="updateRate{{$user->id}}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">

<div class="modal-content">

<div class="modal-header">
<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
    id="exampleModalLabel">
    نسبة الحد الأدنى للنجاح  </h5>
</div>
<div class="modal-body">
<form action="{{route('updatesetting')}}" method="post">
    @csrf
    <input id="id" type="hidden" name="id" class="form-control"
           value="{{ $user->id }}">
    <div>
        <label> النسبة المؤية</label>
        <input id="rate" value="{{$user->therate}}" type="number"  step="0.01" max="100" onchange="setTwoNumberDecimal(this)" name="rate" class="form-control">


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
                data-dismiss="modal">إلغاء</button>
        <button type="submit"
                class="btn btn-danger">حفظ</button>
    </div>
</form>
</div>
</div>
</div>
</div>

</tr>

<tr>
<td>
الحد الأعلى للمتأهلين المسموح  للحكام

</td>

<td>
{{$user->refreemax}}
</td>
<td>
@can('update setting')
<button type="button" class="btn btn-info btn-sm" data-toggle="modal"
data-target="#updatemax{{$user->id}}"
title="تعديل"><i
class="fa fa-edit"></i></button>

@endcan
</td>
<div class="modal fade" id="updatemax{{$user->id}}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">

<div class="modal-content">

<div class="modal-header">
<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
    id="exampleModalLabel">
    الحد الأعلى للمتأهلين المسموح  للحكام  </h5>
</div>
<div class="modal-body">
<form action="{{route('updatesetting1')}}" method="post">
    @csrf
    <input id="id" type="hidden" name="id" class="form-control"
           value="{{ $user->id }}">
    <div>
        <label> الحد الأعلى للمتأهلين المسموح  للحكام</label>
        <input id="rate" value="{{$user->refreemax}}" type="text" name="refreemax" class="form-control">


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
                data-dismiss="modal">إلغاء</button>
        <button type="submit"
                class="btn btn-danger">حفظ</button>
    </div>
</form>

</div>
</div>
</div>
</div>

</tr>
<tr>
<td>

االموسم الفعال
</td>

<td>
@foreach($seasons as $s)
@if($user->activeseason==$s->id)
{{$s->name}}
@endif
@endforeach

</td>
<td>
    @can('update setting')

<button type="button" class="btn btn-info btn-sm" data-toggle="modal"
data-target="#active{{$user->id}}"
title="تعديل"><i
class="fa fa-edit"></i></button>

@endcan
</td>
<div class="modal fade" id="active{{$user->id}}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">

<div class="modal-content">

<div class="modal-header">
<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
    id="exampleModalLabel">
    الموسم الفعال
</h5>
</div>
<div class="modal-body">
<form action="{{route('updatesetting')}}" method="post">
    @csrf
    <input id="id" type="hidden" name="id" class="form-control"
           value="{{ $user->id }}">
    <div>
        <label>الموسم الفعال</label>
        <select class="form-control" name="active">
            @foreach($seasons as $s)
                <option value="{{$s->id}}">
                    {{$s->name}}
                </option>
            @endforeach
        </select>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
                data-dismiss="modal">إلغاء</button>
        <button type="submit"
                class="btn btn-danger">حفظ</button>
    </div>
</form>
</div>
</div>
</div>
</div>

</tr>

<tr>
<td>
عدد المقيمين
</td>
<td>
{{$user->countev}}
</td>
</tr>
<tr>
<td>
   اعدادات الواتساب
</td>
    <td>
        @can('update setting')

        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                data-target="#updateWhatsapp{{$user->id}}"
                title="تعديل"><i
                class="fa fa-edit"></i></button>

        @endif
    </td>
    <div class="modal fade" id="updateWhatsapp{{$user->id}}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        اعدادات الواتساب
                    </h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('updatewhatsapp')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input id="id" type="hidden" name="id" class="form-control"
                               value="{{ $user->id }}">
                        <div>
                            <label>instance</label>
                            <input id="rate" value="{{$user->instance}}" type="text" name="raw1" class="form-control">
                            <label>token</label>
                            <input id="rate" value="{{$user->token}}" type="text" name="raw1" class="form-control">
                            <label>السطر الأول</label>
                            <input id="rate" value="{{$user->raw1}}" type="text" name="raw1" class="form-control">
                            <label>السطر الثاني</label>
                            <input id="rate" value="{{$user->raw2}}" type="text" name="raw2" class="form-control">
                            <label>ارفاق صورة جديدة</label>
                            <input id="file"  type="file" name="image" class="form-control">



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">إلغاء</button>
                            <button type="submit"
                                    class="btn btn-danger">حفظ</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</tr>
</tbody>
</table>
</div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">إضافة</h5>
</div>
<form action="{{ route('addseason') }}" method="post" id="addNewUser">
@csrf
<div class="modal-body">

<div class="row">
<div class="col-md-6">
<label for="name">الاسم</label>
<input class="form-control" name="name" type="text" >
</div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">إلغاء</button>
<button type="submit" class="btn btn-primary">حفظ </button>
</div>
</form>
</div>
</div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">حذف</h5>
</div>
<form action="{{ route('deleteseason') }}" method="post" id="addNewUser">
@csrf
<div class="modal-body">

<div class="row">
<div class="col-md-6">
<label for="name">الاسم</label>
<select name="name" class="form-control">
@foreach($seasons as $s)
<option value="{{$s->id}}" >   {{$s->name}}</option>
@endforeach
</select>
</div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">إلغاء</button>
<button type="submit" class="btn btn-primary">حفظ </button>
</div>
</form>
</div>
</div>
</div>

@push('style')

<link href="{{ asset('assets/SmartWizard/bootstrap.css')}}" rel="stylesheet" type="text/css" />
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard_theme_arrows.css')}}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ asset('assets/SmartWizard/theme_new.css')}}" rel="stylesheet" type="text/css" />--}}
<link href="{{ asset('assets/SmartWizard/theme-ar.css')}}" rel="stylesheet" type="text/css" />

@endpush

@push('script')

<script src="{{ asset('assets/SmartWizard/jquery.min.js')}}"></script>

<script src="{{ asset('assets/SmartWizard/bootstrap.js')}}"></script>
<script src="{{ asset('assets/SmartWizard/custom_js.js')}}"></script>

<script src="{{ asset('assets/SmartWizard/validator.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/lib/SmartWizard/dist/js/jquery.smartWizard.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
<script type="text/javascript">

</script>
<script>
    function setTwoNumberDecimal(event) {
        this.value = parseFloat(this.value).toFixed(2);
    }
</script>
<script>
    function changeHandler(val)
    {
        if (Number(val.value) > 100)
        {
            val.value = 100
        }
    }
</script>

@endpush

@endsection
