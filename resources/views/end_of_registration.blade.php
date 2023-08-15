
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  شاعر الراية</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200&family=Montserrat:wght@100&family=Poppins:wght@400;500;600&family=Roboto+Serif:wght@100&display=swap" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/593331e50d21b6415d53fc7c416b5b8e?family=FrutigerLTArabic-75Black" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link href="//db.onlinewebfonts.com/c/8e84296a186f1941f28261b7dc98a78b?family=FrutigerLTArabic-45Light" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300&family=Tajawal:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/register/css/style.css">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="public/assets/register/hijri/css/bootstrap-datetimepicker.css" rel="stylesheet" />
    <style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300&family=Tajawal:wght@200;300;400;500&display=swap');
</style>
    <style>
    
        .requiredStar:after {
            content:" *";
            color: red;
            font-size: 1.2rem;
          }
    
        fieldset.filepond--file-wrapper{
            background: #b79045  !important;
        }
        [data-filepond-item-state='processing-complete'] .filepond--action-revert-item-processing svg,.filepond--file-action-button.filepond--file-action-button svg  {
            margin-top: -.5rem !important;
        }
        section.header {
    background: #b79045;
            
        }
        #progressbar li.active:before, #progressbar li.active:after {
    background: #b79045;
}


.justify-content-center {
    
    
    background-color: #b79045;
}

#msform .action-button {
    width: 100px;
    background: #b79045;}
    
    .labelclass {
    float: right;  
  }
  .form-group label:before{
      
      float: right;
  }
  body{
    background-color: #b79045;
    font-family: 'Tajawal', sans-serif;
  }
  
  input[type="file"]{
      direction: rtl;
  }
  
  #msform fieldset .form-card {
    box-shadow: none !important;
}
h5 {
    
    font-family: 'Tajawal';
}
.fs-title {
  
    font-family: 'Tajawal';
}

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #b79045;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  margin-left: -30px;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

#msform input{
   border: 1px solid #ccc; 
   padding: 4px 8px 4px 8px; 
    
}

.filepond--root .filepond--credits[style] {
    visibility: hidden;
}

.form-group label:before {

    border: 2px solid #b79045;
    
}

.form-group input:checked + label:after {
    content: '';
    display: block;
    position: absolute;
    top: 5px;
    right: -22px;
    width: 6px;
    height: 14px;
    border: solid #b79045;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

label.float-right, label.labelFloatRight {
    font-size: 13px;
    font-family: 'Tajawal';
}
#msform{
    display:none;
}
    </style>
</head>
<body>


<section class="header" >
    <h1 style="font-family: 'Tajawal', sans-serif;"> اعزائنا المشاركين </h1>
</section>

    <!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-9 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pb-0 mt-3 mb-3">
                <!--<img class="img-line" src="public/w-9.png" alt="">-->
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <div class="conditions" style="height:auto;direction:rtl;text-align:center;padding:1rem"><br>
                            <h4>
                        تم انتهاء فترة استقبال المشاركات في مسابقة برنامج ( شاعر الراية )
                              </h4>
                              <h4>
                                  
                              </h4>
                              <h4>
                                  وسيتم التواصل مع المرشحين بعد تجاوز مرحلة الفرز
                              </h4>
                                <br><br><br><br>
                                <h4>
                                    بالتوفيق للجميع
                                </h4>
 
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js" integrity="sha512-yrOmjPdp8qH8hgLfWpSFhC/+R9Cj9USL8uJxYIveJZGAiedxyIxwNw4RsLDlcjNlIRR4kkHaDHSmNHAkxFTmgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="public/assets/register/hijri/js/momentjs.js"></script>
    <script src="public/assets/register/hijri/js/moment-with-locales.js"></script>
    <script src="public/assets/register/hijri/js/moment-hijri.js"></script>
</body>
</html>
