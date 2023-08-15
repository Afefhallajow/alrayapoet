<!DOCTYPE html>
<html class="loading" lang="ar" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <title> شاعر الراية </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="assets/logo.png"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.3.2/css/searchBuilder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js">



    @include('layouts.css')

    <style>
        #popup
        {text-align: center;
            position: absolute;
            background-color: #5a5a5a;
            top:0;left: 0;
            height: 100%;
            width: 100%;
            z-index: 100;
            display: none;
        }
        #popup1
        {text-align: center;
            position: absolute;
            background-color: #5a5a5a;
            top:0;left: 0;
            height: 250%;
            width: 100%;
            z-index: 100;
            display: none;
        }

        #popup span{

            top:0;right: 10px;
            font-size: 60px;
            font-weight: bolder;
            color: #ffffff;
            cursor: pointer;
        }
        #popup1 span{

            top:0;right: 10px;
            font-size: 60px;
            font-weight: bolder;
            color: #f8f8f8;
            cursor: pointer;
        }

        #popup video{
            position: absolute;
            top:50%
        ;
            left:50%;
            transform: translate(-50%,-50%);
         }

        #popup1 object{
            position: absolute;
            left:25%;
            top:1%;
         }

        @media only screen and (max-width: 575px) {
            #popup1 object{
                position: absolute;
           width: 100%;
                left: 0%;
              top: 9%;
             }
            #popup video{
                position: absolute;
                top:50%;
                width: 100%;
            }
            #popup a{
                width: 50%;
            }

            #popup1 a{
                width: 50%;
            }

        }

    </style>



    <style>
        .white{
            color: #7367F0 !important;
        }
        body::-webkit-scrollbar {
            display: none; /* for Chrome, Safari, and Opera */
            overflow-y: scroll;
        }
        .task-show a{
            color: #fff;

        }
        .task-show a:hover{
            color: #fff;

        }
        .task-show a:focus{
            color: #fff;

        }
        label{
            font-weight: bolder;
            font-size: 100%;
        }
        thead, th {text-align: right;}

        .brand-text{
            color:black; !important;
        }
        .nav-item{
            font-weight: 700;
        }
        .menu-item-label{
            font-weight: 700;
        }
        .sub-item{
            font-weight: 700;
        }
        .toast-message{
            padding:0rem 3rem;
        }
    </style>
    @yield('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
@include('layouts.header')
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
@include('layouts.menu')
<div style="" id="popup1">
    <a   style=" float: right; display: block; text-align: center; " id="close_image">

        <span   >&times;</span></a>
    <object class = "img-responsive" data="/storage/poems/{{$member->poem}}" width="50%" style="min-height: 400px" height="auto">
    </object>

</div>



<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        {{--<div class="content-header row">--}}
        {{--<div class="content-header-left col-md-9 col-12 mb-2">--}}
        {{--<div class="row breadcrumbs-top">--}}
        {{--<div class="col-12">--}}
        {{--<h2 class="content-header-title float-left mb-0">page</h2>--}}
        {{--<div class="breadcrumb-wrapper">--}}
        {{--<ol class="breadcrumb">--}}
        {{--<li class="breadcrumb-item"><a href="{{url('admin')}}">الرئيسية</a>--}}
        {{--</li>--}}
        {{--@if(isset($menu))--}}
        {{--<li class="breadcrumb-item"><a href="{{$menu_link}}">{{$menu}}</a>--}}
        {{--</li>@endif--}}
        {{--<li class="breadcrumb-item active">page--}}
        {{--</li>--}}
        {{--</ol>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--</div>--}}


        <div class="content-body">
            <!-- BEGIN: Content-->

            <div style="" id="popup">
<a style=" float: right; display: block; text-align: center; " onclick="video()">
                <span  >&times;</span>
</a>
                <video id="my_video" width="80%" height="60%" controls="controls">

                    <source src="{{url('/storage/videos/'.$member->video)}}">
                </video>
            </div>


            <div  class="card shadow mb-2">

                <div  class="card-body" id="con">
                    <div class="row">
                        <div class="col-12">
                            <label>رقم التقديم</label>
                            <br>

                            <label>{{$member->id}} </label>
                        </div>
                        <div style="text-align: center" class="col-12">
                            <h4>الصورة الشخصية للمتسابق</h4>

                        </div>

                        <div style="text-align: center" class=" col-12">
                            <br>
                            <img  height="100%"  style="max-height: 200px" src="{{ url('/storage/images/'.$member->image) }}" alt="job image" title="job image">
                            <br>
                            <br>
                        </div>

                    </div>
                    <br>
                    <div  class="row">
                        <div class="col-12 ">
                            <h4>الفيديو الخاص بالمتسابق</h4>
                        </div>
                        <br>


                        <div  style="text-align: center; margin-top: 3%" class="col-12" >
                            <a style="cursor: pointer; color: blue" id="video" onclick="video()" target="" > عرض الفيديو <span class="fa fa-eye"></span> </a>

                            <a style="color: blue;cursor: pointer;margin-right: 2%"  target="_blank" href="/download/video/{{$member->id}}"> تحميل الفيديو <span class="fa fa-download"></span> </a>

                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="row ">
                        <div class="col-12">
                            <h4>
                                القصيدة الخاصة بالمتسابق
                            </h4></div>
                        <div class="col-12">
                            <div  class="" style="padding: 3%; text-align: center" >
                                <a style="color: blue;cursor: pointer "  onclick="image()" > عرض القصيدة <span class="fa fa-eye"></span> </a>

                                <a style="color: blue;cursor: pointer;margin-right: 2%"  target="_blank" href="/download/poem/{{$member->id}}"> تحميل القصيدة <span class="fa fa-download"></span> </a>

                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>


            </div>





            <!-- END: Content-->
            <!-- Modal to add new user starts-->

        </div>
    </div>
</div>


<div class="sidenav-overlay"></div>`
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ml-25" href="#"></a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->

@include('layouts.js')

<script>
var close=document.getElementById('close_image')
close.addEventListener('click', function () {
image()
});</script>
<script>

    function video(){
        var popup=document.getElementById('popup')
        var con=document.getElementById('con')

        if( popup.style.display == 'none') {
            popup.style.display = 'block';
            con.style.display = 'none';

        }else {
            popup.style.display = 'none';
            con.style.display = 'block';
var myvideo=document.getElementById('my_video');
myvideo.pause();
        }    }
</script>
<script>
    function image(){
        var popup=document.getElementById('popup1')
        var menu=document.getElementsByClassName('main-menu')
        var footer=document.getElementsByClassName('footer')


        var con=document.getElementById('con')

        if( popup.style.display == 'none') {

            document.documentElement.scrollTop=0;

            popup.style.display = 'block';
            con.style.display = 'none';
            footer[0].style.display = 'none';
            menu[0].style.display = 'none';

        }else {
            popup.style.display = 'none';
            con.style.display = 'block';
            footer[0].style.display = 'block';
            menu[0].style.display = 'block';

        }    }
</script>

</body>
<!-- END: Body-->

</html>
