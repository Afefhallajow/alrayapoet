@extends('layouts.appp')

@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic&display=swap" rel="stylesheet">
    <style>
        h4{
            color: white;
        }
        h2{
            color: white;
        }
        #myChartGender{
            width:17rem !important;
            height:17rem !important;
            margin:auto;
        }
        #myChartAge{
            width:17rem !important;
            height:17rem !important;
            margin:auto;
        }
        #myChartCountries{
            width:17rem !important;
            height:17rem !important;
            margin:auto;
        }

    </style>
@endpush

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
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card card-congratulations">
            <div class="card-body text-center">
                <div class="avatar avatar-xl bg-primary shadow">
                    <div class="avatar-content">
                        <i data-feather="award" class="font-large-1"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="mb-1 text-white">{{auth()->user()->name}} تهانينا </h1>
                    <p class="card-text m-auto w-75">
                        <strong>'asffa'</strong> Completed.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header flex-column align-items-start pb-0">
                <div class="avatar bg-light-primary p-50 m-0">
                    <div class="avatar-content">
                        <i data-feather="users" class="font-medium-5"></i>
                    </div>
                </div>
                <h2 class="font-weight-bolder mt-1">{{'aaa'}}</h2>
                <p class="card-text">الفواتير </p>
            </div>
            <div id="gained-chart"></div>
        </div>
    </div>

    <div id="content">
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-2">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">
<a class="btn " data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem">  جدول المستخدمين</a>
<!-- Button trigger modal -->
@can('add user')
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
إضافة مستخدم جديد
</button>
@endif
</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table id='datatable' class="table table-bordered yajra-datatable"  width="100%" cellspacing="0">
<thead>
<tr>
<th>التسلسل</th>
<th> الاسم</th>
<th>الإيميل</th>
<th>نوع المستخدم</th>
<th>الموسم</th>

<th>الإجراء</th>
</tr>
</thead>
<tbody>


@foreach($users as $user)
<tr>
<td>
{{$user->id}}
</td>
<td>
{{$user->name}}

</td>
<td>
{{$user->email }}

</td>
<td>
@if($user->type == 1)
<label>Master</label>
@endif
@if($user->type == 5)
<label>admin</label>
@endif

@if($user->type == 2)
<label>Evaluator</label>
@endif
@if($user->type == 3)
<label>viewer</label>
@endif
@if($user->type == 4)
<label>Refree</label>
@endif

</td>


<td>
@foreach($seasons as $se  )
@if($se->id==$user->season)
{{$se->name}}
@endif
@endforeach
</td>
<td>
@if(\Illuminate\Support\Facades\Auth::user()->hasPermissionTo('update user')||\Illuminate\Support\Facades\Auth::user()->id ==$user->id)
<button style="display:inline-block;" type="button" class="btn btn-info btn-sm" data-toggle="modal"
data-target="#updateUser{{$user->id}}"
title="تعديل"><i
class="fa fa-edit"></i></button>
@endif
@can('delete user')
<button  style="display:inline-block;" type="button" class="btn btn-danger btn-sm" data-toggle="modal"
data-target="#delete{{ $user->id }}"
title="حذف"><i
class="fa fa-trash"></i></button>
@endif
@can('update user')

<button  style="display:inline-block;" type="button" class="btn btn-primary btn-sm" data-toggle="modal"
data-target="#addper{{$user->id}}"
title="اضافة صلاحيات"> <i
class="fa fa-check-circle"></i></button>
<button  style="display:inline-block;" type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
data-target="#active{{$user->id}}"
title="تفعيل او ايقاف "><i
class="fa fa-child"></i></button>

@endif

</td>
<div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
id="exampleModalLabel">
هل انت متأكد من الحذف
</h5>
</div>
<div class="modal-body">
<form action="{{route('delete_user',$user->id)}}" method="post">
{{method_field('Delete')}}
@csrf

<input id="id" type="hidden" name="id" class="form-control"
value="{{ $user->id }}">
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
<!-- add valide time -->

<div class="modal fade" id="active{{$user->id}}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">

<div class="modal-content">

<div class="modal-header">
<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
id="exampleModalLabel">
اضافة وقت الصلاحية
</h5>
</div>
<div class="modal-body">
<form action="{{route('active')}}" method="post">
@csrf
<input id="id" type="hidden" name="id" class="form-control"
value="{{ $user->id }}">
<div>
<div class="row">
<div class="col-6" >

<label>تفعيل دائم</label>
<br>
@if($user->status ==1 && $user->validetime == null)
<input onchange="aaa({{$user->id}})" type="radio" checked value="1" class="" name="active">
@else
<input onchange="aaa({{$user->id}})" type="radio" value="1" class="" name="active">
@endif
</div>
<div class="col-6" >
<label>ايقاف دائم</label>
<br>
@if($user->status ==0 )

<input checked onchange="aaa({{$user->id}})" type="radio" value="0" class="" name="active">
@else
<input onchange="aaa({{$user->id}})" type="radio" value="0" class="" name="active">

@endif
</div>
</div>

<div class="row">
<div class="col" >
<label>تفعيل لمدة محدودة</label>
@if($user->status == 1 && $user->validetime != null)
<input id="in{{ $user->id }}" onchange="aaa({{$user->id}})" type="radio" checked value="2" class="" name="active">
        <input style="display:block "  id="time{{ $user->id }}"  type="date"  value="{{$user->validetime}}" class="form-control" name="validetime">

    @else
<input id="in{{ $user->id }}" onchange="aaa({{$user->id}})" type="radio"  value="2" class="" name="active">
        <input style="display: none"  id="time{{ $user->id }}"  type="date"  value="{{$user->validetime}}" class="form-control" name="validetime">

@endif

</div>
</div>
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

<!-- update -->
<div class="modal fade" id="updateUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">تعديل مستخدم </h5>
</div>
<form action="{{route('save_edit_user',$user->id)}}" id="updateUser{{$user->id}}" method="post" class="updateUser">      @csrf
<div class="modal-body">
<label for="name">نوع المستخدم</label>
<select class="form-control" name="type" id="type">
@if($user->type ==1)
<option value="{{$user->type}}">Master</option>
@endif
@if($user->type ==2)
<option value="{{$user->type}}">Evaluator</option>
@endif
@if($user->type ==3)
<option value="{{$user->type}}">View Only</option>
@endif
@if($user->type ==4)
<option value="{{$user->type}}">Referee</option>
@endif
@if($user->type ==5)
<option value="{{$user->type}}">Admin</option>
@endif


<option value="1">Master</option>
<option value="5">Admin</option>

<option value="2">Evaluator</option>
<option value="4">Referee</option>
<option value="3">View Only</option>
</select><br>
<label for="name">الاسم</label>
<input type="text" dir="trl" class="form-control" name="name" value="{{$user->name}}" id="name" required/>
<label for="speaker">الإيميل </label>
<input type="email" dir="trl" class="form-control" value="{{$user->email}}" name="email" id="email" required/>
<label for="sea">الموسم </label>
<select class="form-control" name="sea"  id="type">

@foreach($seasons as $sd)
@if($user->season ==$sd->id)
<option selected value="{{$user->season}}">  الاختيار السابق {{$sd->name}}</option>
@endif
@endforeach
@foreach($seasons as $s)

<option value="{{$s->id}}">{{$s->name}}</option>
@endforeach
</select>
@if($user->type ==5)
<label for="sea">اضافة الصلاحية على موسم جديد  </label>

<select  class="form-control" name="addseason"  id="ii"  >
<option value="0" >لايوجد</option>


@foreach($seasons as $s)
<?php
$temp12=0
?>
@foreach($user->seasons as $userse )
@if($userse->season_id ==$s->id )
    <?php
    $temp12=1
    ?>

@endif
@endforeach
@if($temp12 ==0)


<option value="{{$s->id}}">{{$s->name}}</option>

@endif
@endforeach


</select>
@endif
<label for="day">كلمة المرور </label>
<input type="password" dir="trl" class="form-control" name="password" />
<p>تجاهل حقل كلمة المرور في حال كنت لاترغب بتغييرها</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">إلغاء</button>
<button type="submit" class="btn btn-primary">حفظ </button>
</div>
</form>
</div>
</div>
</div>

<!-- update per -->
<div class="modal fade" id="addper{{$user->id}}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">

<div class="modal-content">

<div class="modal-header">
<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
id="exampleModalLabel">
الصلاحيات                         </h5>
</div>
<div STYLE="padding: 1%" class="modal-body">
<form action="{{route('perupdate')}}" method="post">
@csrf
<input id="id" type="hidden" name="id" class="form-control"
value="{{ $user->id }}">
<ul>
<div class="row">
<div style= "    margin-right: 2%;  ;width:19%" class="">
<label> الحقل</label>
</div>
<div style="width:19%" class="">
<label> اضافة</label>
</div>

<div style="width:19%" class="">
<label> عرض</label>
</div>
<div style="width:19%" class="">
<label>         تعديل
</label>
</div>
<div style="width:19%" class="">
<label> حذف</label>
</div>



</div>
<div class="row">
<div style="width:19%" class="">
<label> المتقدمين</label>
</div>
<div style="width:19% ;margin-right: 4%" class="">

<input  id="" type="checkbox" value="1"  disabled name="" ></input>
</div>
<div style="width:19%" class="">

@if($user->hasPermissionTo("view register"))
<input  id="viewregistered" type="checkbox" value="1" checked name="viewregister" ></input>
@else
<input  id="viewregistered" type="checkbox" value="1"  name="viewregister" ></input>
@endif
</div> <div style="width:19%" class="">

@if($user->hasPermissionTo("update register"))
<input  id="updateregister" type="checkbox" value="1" checked name="updateregister" > </input>
@else
<input  id="updateregister" type="checkbox" value="1"  name="updateregister" ></input>
@endif
</div>
<div style="width:19%" class="">

@if($user->hasPermissionTo("delete register"))
<input  id="deleteregistered" type="checkbox" value="1" checked name="deleteregister" ></input>
@else
<input  id="deleteregistered" type="checkbox" value="1"  name="deleteregister" ></input>
@endif

</div>
</div>
<div class="row">
<div style="width:19%" class="">
<label>المستخدمين</label>
</div>
<div style="width:19%;margin-right: 4%" class="">

@if($user->hasPermissionTo("add user"))
<input  id="adduser" type="checkbox" value="1" checked name="adduser" > </input>
@else
<input  id="adduser" type="checkbox" value="1"  name="adduser" ></input>
@endif
</div>

<div style="width:19%" class="">

@if($user->hasPermissionTo("view user"))
<input  id="viewuser" type="checkbox" value="1" checked name="viewuser" ></input>
@else
<input  id="viewuser" type="checkbox" value="1"  name="viewuser" ></input>
@endif
</div> <div style="width:19%" class="">

@if($user->hasPermissionTo("update user"))
<input  id="updateuser" type="checkbox" value="1" checked name="updateuser" > </input>
@else
<input  id="updateuser" type="checkbox" value="1"  name="updateuser" ></input>
@endif
</div>            <div style="width:19%" class="">

@if($user->hasPermissionTo("delete user"))
<input  id="deleteuser" type="checkbox" value="1" checked name="deleteuser" ></input>
@else
<input  id="deleteuser" type="checkbox" value="1"  name="deleteuser" ></input>
@endif

</div>
</div>
<div class="row">
<div style="width:19%" class="">
<label>المشاركين</label>
</div>
<div style="width:19%;margin-right: 4%" class="">

@if($user->hasPermissionTo("add final"))
<input  id="addfinal" type="checkbox" value="1" checked name="addfinal" > </input>
@else
<input  id="addfinal" type="checkbox" value="1"  name="addfinal" ></input>
@endif
</div>

<div style="width:19%" class="">

@if($user->hasPermissionTo("view final"))
<input  id="viewfinal" type="checkbox" value="1" checked name="viewfinal" ></input>
@else
<input  id="viewfinal" type="checkbox" value="1"  name="viewfinal" ></input>
@endif
</div> <div style="width:19%" class="">
<input  id="" type="checkbox" value="1"  disabled name="" ></input>

</div>
<div style="width:19%" class="">

@if($user->hasPermissionTo("delete final"))
<input  id="deletefinal" type="checkbox" value="1" checked name="deletefinal" ></input>
@else
<input  id="deletefinal" type="checkbox" value="1"  name="deletefinal" ></input>
@endif

</div>
</div>
<div class="row">
<div style="width:19%" class="">
<label>الاعدادات</label>
</div>
<div style="width:19%;margin-right: 4%" class="">

<input  id="" type="checkbox" value="1"  disabled name="" ></input>
</div>

<div style="width:19%" class="">

@if($user->hasPermissionTo("view setting"))
<input  id="viewsetting" type="checkbox" value="1" checked name="viewsetting" ></input>
@else
<input  id="viewsetting" type="checkbox" value="1"  name="viewsetting" ></input>
@endif
</div> <div style="width:19%" class="">

@if($user->hasPermissionTo("update setting"))
<input  id="updatesetting" type="checkbox" value="1" checked name="updatesetting" > </input>
@else
<input  id="updatesetting" type="checkbox" value="1"  name="updatesetting" ></input>
@endif
</div>            <div style="width:19%" class="">

<input  id="" type="checkbox" value="1"  disabled name="" ></input>
</div>
</div>
<div class="row">
<div style="width:19%" class="">
<label>موسم</label>
</div>
<div style="width:19%;margin-right: 4%" class="">

@if($user->hasPermissionTo("add season"))
<input  id="addseason" type="checkbox" value="1" checked name="addseason" > </input>
@else
<input  id="addseason" type="checkbox" value="1"  name="addseason" ></input>
@endif
</div>

<div style="width:19%" class="">
<input  id="" type="checkbox" value="1"  disabled name="" ></input>


</div> <div style="width:19%" class="">
<input  id="" type="checkbox" value="1"  disabled name="" ></input>
</div>            <div style="width:19%" class="">

@if($user->hasPermissionTo("delete season"))
<input  id="deleteseason" type="checkbox" value="1" checked name="deleteseason" ></input>
@else
<input  id="deleteseason" type="checkbox" value="1"  name="deleteseason" ></input>
@endif

</div>
</div>
<div class="row">
<div style="width:19%" class="">
<label>لجنة التحكيم</label>
</div>
<div style="width:19%;margin-right: 4%" class="">
<input  id="" type="checkbox" value="1"  disabled name="" ></input>
</div>

<div style="width:19%" class="">

@if($user->hasPermissionTo("view refree"))
<input  id="viewrefree" type="checkbox" value="1" checked name="viewrefree" ></input>
@else
<input  id="viewrefree" type="checkbox" value="1"  name="viewrefree" ></input>
@endif
</div> <div style="width:19%" class="">

<input  id="" type="checkbox" value="1"  disabled name="" ></input>
</div>            <div style="width:19%" class="">

<input  id="" type="checkbox" value="1"  disabled name="" ></input>

</div>
</div>
</ul>
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


@endforeach

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
<h5 class="modal-title" id="exampleModalLabel">إضافة مستخدم جديد</h5>
</div>
<form action="{{ url()->current() }}" method="post" id="addNewUser">
@csrf
<div class="modal-body">
<label for="name">نوع المستخدم</label>
<select class="form-control" name="type" id="type">
<option value="1">Master</option>
<option value="5">Admin</option>
<option value="2">Evaluator</option>
<option value="4">Referee</option>
<option value="3">View Only</option>


</select><br>
<label for="name">الاسم</label>
<input type="text" dir="trl" class="form-control" name="name" id="name" required/>
<label for="speaker">الإيميل </label>
<input type="email" dir="trl" class="form-control" name="email" id="email" required/>
<label for="day">كلمة المرور </label>
<div style="padding:2%;border: 1px solid #d9d8d8">{{$temp =Str::random(8)}}</div>


<input type="hidden" value="{{$temp}}" dir="trl" class="form-control" name="password" id="password" required/>

<label for="sea">الموسم </label>
<select class="form-control" name="sea" id="type">
@foreach($seasons as $s)
<option value="{{$s->id}}">{{$s->name}}</option>

@endforeach
</select>
<div class="row">
<input id="id" type="hidden" name="id" class="form-control"
value="{{ $user->id }}">
<div style="" class="col-4" >
<label>تفعيل دائم</label>
<br>
<input checked onchange="jjj()" id="kkk" type="radio" value="1" class="" name="active">

</div>
<div   class="col-4" >
<label>ايقاف دائم</label>
<br>
<input onchange="jjj()" id="kkk" type="radio" value="0" class="" name="active">

</div>

<div class="col-4" >
<label>تفعيل لمدة محدودة</label>
<input id="kkk1" onchange="jjj()" type="radio" value="2" class="" name="active">

</div>
<div class="col-12">

<input style="display: none" id="afef" type="date" class="form-control" name="validetime">


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
    <form method="post" action="/test11" >
    @csrf
        <div class="repeater">
        <!--
            The value given to the data-repeater-list attribute will be used as the
            base of rewritten name attributes.  In this example, the first
            data-repeater-item's name attribute would become group-a[0][text-input],
            and the second data-repeater-item would become group-a[1][text-input]
        -->
        <div data-repeater-list="category">
            <div data-repeater-item>
                <input type="hidden" name="id" id="cat-id"/>
                <input type="text" name="cat-name" />
                <input type="text" name="cat-sec" />
                <input data-repeater-delete type="button" value="Delete"/>
            </div>
        </div>

        <input data-repeater-create type="button" value="Add"/>


    </div>

        <div class="repeater1">
            <!--
                The value given to the data-repeater-list attribute will be used as the
                base of rewritten name attributes.  In this example, the first
                data-repeater-item's name attribute would become group-a[0][text-input],
                and the second data-repeater-item would become group-a[1][text-input]
            -->
            <div data-repeater-list="category1">
                <div data-repeater-item>
                    <input type="hidden" name="id" id="cat-id"/>
                    <input type="text" name="cat-name" />
                    <input type="text" name="cat-sec" />
                    <input data-repeater-delete type="button" value="Delete"/>
                </div>
            </div>

            <input data-repeater-create type="button" value="Add"/>


        </div>


        <button type="submit" class="btn btn-success">afef</button>
    </form>
@push('style')

<link href="{{ asset('assets/SmartWizard/bootstrap.css')}}" rel="stylesheet" type="text/css" />
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard_theme_arrows.css')}}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ asset('assets/SmartWizard/theme_new.css')}}" rel="stylesheet" type="text/css" />--}}
<link href="{{ asset('assets/SmartWizard/theme-ar.css')}}" rel="stylesheet" type="text/css" />

@endpush

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"></script>
    <script>
        $(function () {
            'use strict';

            // form repeater jquery
            $('.repeater, .repeater-default').repeater({
                show: function () {
                    $(this).slideDown();
                    // Feather Icons
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
            $('.repeater1, .repeater-default').repeater({
                show: function () {
                    $(this).slideDown();
                    // Feather Icons
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });

        });

    </script>
<script>
$(document).ready(function() {
$('#datatable').DataTable( {
    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    responsive: true
} );

} );
</script>

<script>
function jjj ()
{
var h=document.getElementById('afef');
console.log('شسيسش');
var g=document.getElementById('kkk1');
console.log(g);

if(g.checked)
{
h.style.display='block';
console.log('asfafa');
}else {h.style.display="none";}
}

</script>
<script>
    function aaa (id)
    {
        var h=document.getElementById('time'+id);
        console.log('شسيسش');
        var g=document.getElementById('in'+id);
        console.log(g);

        if(g.checked)
        {
            h.style.display='block';
            console.log('asfafa');
        }else {h.style.display="none";}
    }

</script>

<script src="{{ URL::asset('public/assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var FinalResult = {!! json_encode('afaf') !!};


    const dataAllCounts = {
        labels: [
            'المتقدمين',
            'المرشحين',
            'المشاركين'
        ],
        datasets: [{
            label: 'العدد',
            data: [{{12}},{{14}},15],
            backgroundColor: [
                'rgba(86, 4, 89, 1)',
                'rgba(4, 3, 92, 1)',
                'rgba(255, 205, 86, 1)'

            ],
            borderColor: [
                'rgb(245,11,11)',
                'rgb(4, 3, 92)',
                'rgb(255, 205, 86)'
            ],
            borderWidth: 1
        }]
    };

    gainedChartOptions = {
        chart: {
            height: 100,
            type: 'area',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            },
            grid: {
                show: false,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [window.colors.solid.primary],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2.5
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 0.9,
                opacityFrom: 0.7,
                opacityTo: 0.5,
                stops: [0, 80, 100]
            }
        },
        series: [
            {
                name: 'Subscribers',
                data: [28, 40, 36, 52, 38, 60, 55]
            },{
                name: 'afef',
                data: [59, 60, 36, 52, 38, 60, 55,100]
            }
        ],
        xaxis: {
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            }
        },
        yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: { left: 0, right: 0 }
            }
        ],
        tooltip: {
            x: { show: false }
        }
    };
    gainedChart = new ApexCharts(document.getElementById('gained-chart'), gainedChartOptions);
    gainedChart.render();


</script>


@endpush

@endsection
