<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <meta name="robots" content="" />

    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:title" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:description" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <title>شاعر الراية </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="assets/logo.png"/>
    <!-- Form step -->
    <!-- Custom Stylesheet -->
    <link href="{{asset('new/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('new/css/style.css')}} " rel="stylesheet">
    <!-- Daterange picker -->
    <link href="{{asset('new/vendor/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- Clockpicker -->
    <link href="{{asset('new/vendor/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
    <!-- asColorpicker -->
    <link href= "{{asset('new/vendor/jquery-asColorPicker/css/asColorPicker.min.css')}}" rel="stylesheet">
    <!-- Material color picker -->
    <link href="{{asset('new/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <!-- Pick date -->
    <link rel="stylesheet" href="{{asset('new/vendor/pickadate/themes/default.css')}}">
    <link rel="stylesheet" href="{{asset('new/vendor/pickadate/themes/default.date.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js" integrity="sha512-+gShyB8GWoOiXNwOlBaYXdLTiZt10Iy6xjACGadpqMs20aJOoh+PJt3bwUVA6Cefe7yF7vblX6QwyXZiVwTWGg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .iti { width: -webkit-fill-available; }

        @media (min-width: 768px)  {
            .iti { width: 100%; }
        }

        .order-create br{
            display: none;
        }
        *{
            font-family: 'Tajawal', sans-serif;
        }

        .form-wizard .nav-wizard li .nav-link::after{
            top: 40%;
        }

        .btn-success{
            background-color:  #dbad3e;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 16px;
        }
        body{
            background-color: #dbad3e;
        }

        .par{
            font-size: 1.3rem;}

        @media only screen and (max-width: 575px){
            .form-wizard .nav-wizard li .nav-link::after{
                top: 30%;
            }
        }



    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');
    </style>
    <style>
        .form-wizard .nav-wizard {
            box-shadow: none !important;
            margin-bottom: 2rem;
        }

        table td{
            border: 1px solid black;
            padding: 1%;
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            padding-left: 0;
            margin-top: 0;
            margin-bottom: 0;
        }
        .sw.sw-justified>.nav .nav-link, .sw.sw-justified>.nav>li {
            flex-basis: 0;
            flex-grow: 1;
            text-align: center;
        }
        .sw *, .sw ::after, .sw ::before {
            box-sizing: border-box;
        }
        .sw-theme-default>.nav .nav-link.active {
            color: #17a2b8!important;
            cursor: pointer;
        }
        .sw.sw-justified>.nav .nav-link, .sw.sw-justified>.nav>li {
            flex-basis: 0;
            flex-grow: 1;
            text-align: center;
        }
        .form-wizard .nav-wizard li .nav-link {
            position: relative;
        }
        .sw-theme-default>.nav .nav-link {
            position: relative;
            height: 100%;
            min-height: 100%;
        }
        .sw>.nav .nav-link {
            display: block;
            padding: 0.5rem 1rem;
            text-decoration: none;
        }
        .form-wizard .nav-wizard li .nav-link.active span {
            background: var(--primary);
            color: #fff;
        }
        .form-wizard .nav-wizard li .nav-link span {
            border-radius: 3.125rem;
            width: 3rem;
            height: 3rem;
            border: 0.125rem solid var(--primary);
            display: block;
            line-height: 3rem;
            color: var(--primary);
            font-size: 1.125rem;
            margin: auto;
            background-color: #fff;
            position: relative;
            z-index: 1;
        }
        [direction="rtl"] .form-wizard .nav-wizard li .nav-link:after {
            right: 50%;
            left: auto;
        }
        .form-wizard .nav-wizard li .nav-link.active:after {
            background: var(--primary) !important;
        }
        .form-wizard .nav-wizard li .nav-link::after {
            top: 40%;
        }
        .sw-theme-default>.nav .nav-link.active::after {
            background: #17a2b8!important;
            width: 100%;
        }
        .form-wizard .nav-wizard li .nav-link:after {
            position: absolute;
            top: 50%;
            left: 50%;
            height: 0.1875rem;
            transform: translateY(-50%);
            background: #eeeeee !important;
            z-index: 0;
            width: 100%;
        }
        .sw-theme-default>.nav .nav-link::after {
            content: "";
            position: absolute;
            height: 2px;
            width: 0;
            left: 0;
            bottom: -1px;
            background: #999;
            transition: all .35s ease .15s;
        }
        .form-wizard .nav-wizard li .nav-link::after {
            top: 40%;
        }
        .sw-theme-default>.nav .nav-link.inactive {
            color: #999;
            cursor: not-allowed;
        }

        .btn1{
            text-align: center;}

        @media (max-width: 575.98px) {
            [direction="rtl"] .form-wizard .nav-wizard li .nav-link:after {
                right: 50%;
                left: auto;
            }
        }
        @media only screen and (max-width: 575px){
            .form-wizard .nav-wizard li .nav-link::after {
                top: 30%;
            }

            h4{
                font-size: small;
            }
            a{  font-size: x-small;}
            .first li{font-size: 12px;}

            table td{font-size: 10px}
            table td li {font-size: 10px}

            table td p {font-size: 10px}

            .btn1{
                text-align: center;}

            .par{
                font-size: 1.0rem;}

        }


        }
    </style>
</head>

<body class="vh-100" style="background-image:url( 'images/background/bg8.jpg') ;background-repeat: no-repeat;background-size: cover;height: 100%;">
@csrf
<div class="authincation h-100" >
    <div class="container h-100" >
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-10" >
                <div class="authincation-content" id="form1">
                    <div class="text-center mb-3">
                        <img src="{{asset( 'images/COLOR.png')}}" width="100%" height="100%" alt="">
                    </div>

                    <div class="text-center mb-3">
                        <img src="/images/logo-new.png" width="90" height="150" alt="">

                    </div>


                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">

                            <div class="">
                                <div id="smartwizard" class="form-wizard order-create">
                                    <br> <br>    <!-- row -->
                                    <div class="row">
                                        <div class="col-md-12 mb-30">
                                            <div class="card card-statistics h-100">
                                                <div class="card-body">
                                                    <livewire:reupload :token="$token" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- row closed -->
                                </div>

                            </div>

                            <img style="background-color: white" src="/images/COLOR.png" width="100%" height="100%" alt="">


                        </div>
                    </div>

                </div>

            </div>
        </div></div></div>


</div>



<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="./new/vendor/global/global.min.js"></script>
<script src="./new/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<script src="./new/vendor/jquery-steps/build/jquery.steps.min.js"></script>
<script src="./new/vendor/jquery-validation/jquery.validate.min.js"></script>
<!-- Form validate init -->
<script src="./new/js/plugins-init/jquery.validate-init.js"></script>

<!-- Form Steps -->
<script src="./new/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>

<!--<script src="./new/js/custom.js"></script>-->
<script src="./new/js/deznav-init.js"></script>


<!-- Daterangepicker -->
<!-- momment js is must -->
<script src="./new/vendor/moment/moment.min.js"></script>
<script src="./new/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- clockpicker -->
<script src="./new/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<!-- asColorPicker -->
<script src="./new/vendor/jquery-asColor/jquery-asColor.min.js"></script>
<script src="./new/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
<script src="./new/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
<!-- Material color picker -->
<script src="./new/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- pickdate -->
<script src="./new/vendor/pickadate/picker.js"></script>
<script src="./new/vendor/pickadate/picker.time.js"></script>
<script src="./new/vendor/pickadate/picker.date.js"></script>


<!-- Daterangepicker -->
<script src="./new/js/plugins-init/bs-daterange-picker-init.js"></script>
<!-- Clockpicker init -->
<script src="./new/js/plugins-init/clock-picker-init.js"></script>
<!-- asColorPicker init -->
<script src="./new/js/plugins-init/jquery-asColorPicker.init.js"></script>
<!-- Material color picker init -->
<script src="./new/js/plugins-init/material-date-picker-init.js"></script>
<!-- Pickdate -->
<script src="./new/js/plugins-init/pickadate-init.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    jQuery('.default-select').selectpicker();
</script>


@livewireScripts



</body>
