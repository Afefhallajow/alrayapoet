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
        @media only screen and (max-width: 575px) {
            #upgrades-datatable_wrapper {
                width: 100%;
                overflow: auto;
            }
            #datatable_filter{text-align: right;}
            #datatable_filter input{width: 55%}
            a{font-size:13px}
            .btn {font-size: 10px;
            }

            table.dataTable td { max-width: 100%; width:10px ;height: 10px;text-align: center ;padding: 1px;}
            table.dataTable th{font-size: 10px;}
            table.dataTable {width:10px ;height: 10px;max-width: 100%}

            table td{ font-size: 10px;}
table{width:10px ;height: 10px;max-width: 100%}
        }


        .dataTables_wrapper .dt-buttons {
            float:right;
            text-align:center;
        }
        .dataTables_length{
            float:left;
margin-left: 2%;
        }
        .dataTables_wrapper{
            display:block;
        }
        .dataTables_filter{
            display: block;
            float:left;

     }
    </style>
    @yield('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
@if (\Illuminate\Support\Facades\Session::has('status'))
    <div class="fl-flasher " role="alert">
        <p>{{ \Illuminate\Support\Facades\Session::get('status') }}</p>
    </div>
@endif<!-- BEGIN: Header-->
@include('layouts.header')
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
@include('layouts.menu')
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
@yield('content')
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
    $('.dataTables_filter').addClass('col-12');

</script>
</body>
<!-- END: Body-->

</html>
