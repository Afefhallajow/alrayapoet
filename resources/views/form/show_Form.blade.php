<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:title" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:description" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <title>شاعر الراية </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Form step -->
    <!-- Custom Stylesheet -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Form step -->
    <meta name="description" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:title" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:description" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <title>شاعر الراية </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Form step -->
    <!-- Custom Stylesheet -->
    <link href="{{asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <!-- Daterange picker -->
    <link href="{{asset('vendor/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- Clockpicker -->
    <link href="{{asset('vendor/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
    <!-- asColorpicker -->
    <link href= "{{asset('vendor/jquery-asColorPicker/css/asColorPicker.min.css')}}" rel="stylesheet">
    <!-- Material color picker -->
    <link href="{{asset('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <!-- Pick date -->
    <link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.date.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <style>
        *{
            font-family: 'Tajawal', sans-serif;
        }

        .form-wizard .nav-wizard li .nav-link::after{
            top: 40%;
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
        table td{
            border: 1px solid black;
            padding: 1%;
        }
        .par{
            font-size: 1.3rem;}

        @media only screen and (max-width: 575px){
            .form-wizard .nav-wizard li .nav-link::after{
                top: 30%;
            }
h4{
    font-size: small;
}
            table td{font-size: 12px}
            table td li {font-size: 12px}

table td p {font-size: 12px}

            .first li{font-size: 12px}
        .par{
    font-size: 1.0rem;}
a{  font-size: x-small;}
        .btn1{
            text-align: center;}
        }



    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');
    </style>
</head>

<body class="vh-100" style="background-image:url( 'images/background/bg8.jpg') ;background-repeat: no-repeat;background-size: cover;height: 100%;">
<div class="authincation h-100" >
    <div class="container h-100" >
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-10" >
                <div class="authincation-content" id="form1">
                    <div class="text-center mb-3">
                        <img src="images/COLOR.png" width="100%" height="100%" alt="">
                    </div>


                    <div class="text-center mb-3">
                        <img src="images/logo-new.png" width="90" height="150" alt="">
                    </div>
                    <div class="text-center mb-3">
                        <img src="images/COLOR.png" width="100%" height="100%" alt="">
                    </div>

                    <div class="card-body">

                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="">

                                <h4 class="card-title" style="text-align: center;">للمشاركة في البرنامج</h4>

                            </div>
                            <div class="">
                                <div id="smartwizard" class="form-wizard order-create">

    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <livewire:reg />
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

                                </div></div>


                        </div>
                        <div  class="text-center mb-3">
                            <img src="images/COLOR.png" width="100%" height="100%" alt="">

                        </div>

                    </div></div></div></div></div></div>

<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<script src="{{asset('vendor/global/global.min.js')}}"></script>

<script src="{{asset('vendor/jquery-steps/build/jquery.steps.min.js')}}"></script>
<script src="{{asset('vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- Form validate init -->
<script src="{{asset('js/plugins-init/jquery.validate-init.js')}}"></script>

<!-- Form Steps -->
<script src="{{asset('vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js')}}"></script>

<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/deznav-init.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>

<!-- Daterangepicker -->
<!-- momment js is must -->
<script src="{{asset('vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- clockpicker -->
<script src="{{asset('vendor/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
<!-- asColorPicker -->
<script src="{{asset('vendor/jquery-asColor/jquery-asColor.min.js')}}"></script>
<script src="{{asset('vendor/jquery-asGradient/jquery-asGradient.min.js')}}"></script>
<script src="{{asset('vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js')}}"></script>
<!-- Material color picker -->
<script src="{{asset('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
<!-- pickdate -->
<script src=".{{asset('vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.date.js')}}"></script>



<!-- Daterangepicker -->
<script src="{{asset('js/plugins-init/bs-daterange-picker-init.js')}}"></script>
<!-- Clockpicker init -->
<script src="{{asset('js/plugins-init/clock-picker-init.js')}}"></script>
<!-- asColorPicker init -->
<script src="{{asset('js/plugins-init/jquery-asColorPicker.init.js')}}"></script>
<!-- Material color picker init -->
<script src="{{asset('js/plugins-init/material-date-picker-init.js')}}"></script>
<!-- Pickdate -->
<script src="{{asset('js/plugins-init/pickadate-init.js')}}"></script>

@stack('script')


@livewireScripts


</body>
