<!DOCTYPE html>
<html lang="ar" class="h-100">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:title" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:description" content="Zenix - Crypto Admin Dashboard" />
    <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <title>Zenix -  Crypto Admin Dashboard </title>



    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Form step -->
    <link href="./vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <!-- Daterange picker -->
    <link href="./vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Clockpicker -->
    <link href="./vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    <!-- asColorpicker -->
    <link href="./vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">
    <!-- Material color picker -->
    <link href="./vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Pick date -->
    <link rel="stylesheet" href="./vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="./vendor/pickadate/themes/default.date.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    @livewireStyles
    <style>
        *{
            font-family: 'Tajawal', sans-serif;
        }
        fieldset.filepond--file-wrapper{
            background: #b79045  !important;
        }
        [data-filepond-item-state='processing-complete'] .filepond--action-revert-item-processing svg,.filepond--file-action-button.filepond--file-action-button svg  {
            margin-top: -.5rem !important;
        }

        .form-wizard .nav-wizard li .nav-link::after{
            top: 40%;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 16px;
        }
        body{
            background-color: #dbad3e;
        }

        @media only screen and (max-width: 575px){
            .form-wizard .nav-wizard li .nav-link::after{
                top: 30%;
            }
        }



    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');
    </style>
</head>
<body>
<div class="authincation h-100" >
    <div class="container h-100" >
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-10" >
                <div class="authincation-content" id="form1">
                    <br>
                    <div class="text-center mb-3">
                        <img src="images/logo-new.png" width="90" height="150" alt="">

                    </div>
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="">

                                <h4 class="card-title" style="text-align: center;">للمشاركة في البرنامج</h4>

                            </div>
                            <div class="card-body">
                                <div id="smartwizard" class="form-wizard order-create">
                                    <ul class="nav nav-wizard">

                                        <li><a class="nav-link" href="#wizard_Service">
                                                <span>1</span>
                                            </a><span style="font-weight: 600;font-size: 16px;color:#b79045;">معلوماتك الشخصية </span> </li>

                                        <li><a class="nav-link" href="#wizard_Time">
                                                <span>2</span>
                                            </a><span style="font-weight: 600;font-size: 16px;color:#b79045;">تحميل مشاركتك</span></li>
                                        <li><a class="nav-link" href="#wizard_Details">
                                                <span>3</span>
                                            </a><span style="font-weight: 600;font-size: 16px;color:#b79045;">حدثنا عنك </span></li>

                                    </ul>
                                    <br> <br>
                                    <div class="tab-content">


                                    @include('form.First_Form')
                                    @include('form.Second_Form')
                                    @include('form.Third_Form')



</div>
                                </div></div>
                        </div></div></div>
            </div>
        </div>
    </div></div>
@livewireScripts
<script src="./vendor/global/global.min.js"></script>
<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<script src="./vendor/jquery-steps/build/jquery.steps.min.js"></script>
<script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
<!-- Form validate init -->
<script src="./js/plugins-init/jquery.validate-init.js"></script>

<!-- Form Steps -->
<script src="./vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>

<script src="./js/custom.js"></script>
<script src="./js/deznav-init.js"></script>
<script src="./js/demo.js"></script>

<!-- Daterangepicker -->
<!-- momment js is must -->
<script src="./vendor/moment/moment.min.js"></script>
<script src="./vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- clockpicker -->
<script src="./vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<!-- asColorPicker -->
<script src="./vendor/jquery-asColor/jquery-asColor.min.js"></script>
<script src="./vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
<script src="./vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
<!-- Material color picker -->
<script src="./vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- pickdate -->
<script src="./vendor/pickadate/picker.js"></script>
<script src="./vendor/pickadate/picker.time.js"></script>
<script src="./vendor/pickadate/picker.date.js"></script>



<!-- Daterangepicker -->
<script src="./js/plugins-init/bs-daterange-picker-init.js"></script>
<!-- Clockpicker init -->
<script src="./js/plugins-init/clock-picker-init.js"></script>
<!-- asColorPicker init -->
<script src="./js/plugins-init/jquery-asColorPicker.init.js"></script>
<!-- Material color picker init -->
<script src="./js/plugins-init/material-date-picker-init.js"></script>
<!-- Pickdate -->
<script src="./js/plugins-init/pickadate-init.js"></script>


</body>
