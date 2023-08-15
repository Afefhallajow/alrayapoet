
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>  KACND </title>
<link rel="stylesheet" href="{{asset('public/assets/all/bootstrap.css')}}">

<!-- <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200&family=Montserrat:wght@100&family=Poppins:wght@400;500;600&family=Roboto+Serif:wght@100&display=swap" rel="stylesheet"> -->




<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}
.iti.iti--allow-dropdown.iti--separate-dial-code{
width: 100%;
margin-top:2px;
}
/* Firefox */
input[type=number] {
-moz-appearance: textfield;
}
* {
margin: 0;
padding: 0
}
.invalidEmailMSG{
visibility: hidden;
}
.footer__heading::after{
content: '';
}
.inBahreenSelect,.passportImageDiv{
display: none;
}
.fit-image{
display: none;
}
.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
width: 100% !important;
margin-right:-2%;
}
.filter-option {
font-size: .9rem;
color: #000;
}
html {
height: 100%
}

#grad1 {
background-color:#f7f7f7;

}

#msform {
text-align: center;
position: relative;
margin-top: 20px
}
.form-control{
padding: 2px;
font-size: 13px;
}

#msform fieldset .form-card {
background: white;
border: 0 none;
border-radius: 0px;
box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
padding: 20px 40px 30px 40px;
box-sizing: border-box;
width: 94%;
margin: 0 3% 20px 3%;
position: relative
}

#msform fieldset {
background: white;
border: 0 none;
border-radius: 0.5rem;
box-sizing: border-box;
width: 100%;
margin: 0;
padding-bottom: 20px;
position: relative
}

#msform fieldset:not(:first-of-type) {
display: none
}

#msform fieldset .form-card {
text-align: left;
color: #9E9E9E
}

#msform input,
#msform textarea,#msform select {
padding: 0px 8px 4px 8px;
border: none;
border-bottom: 1px solid #ccc;
border-radius: 0px;
margin-bottom: 25px;
margin-top: 2px;
width: 100%;
box-sizing: border-box;
color: #2C3E50;
font-size: 12px;
letter-spacing: 1px
}
select{
padding: 10px!important;
color: #9e9e9e!!important;
font-size: 15px!important;
}
#msform input:focus,
#msform textarea:focus,select:focus {
-moz-box-shadow: none !important;
-webkit-box-shadow: none !important;
box-shadow: none !important;
border: none;
font-weight: bold;
border-bottom: 2px solid skyblue;
outline-width: 0
}

#msform .action-button {
width: 100px;
background: #4796b9;
font-weight: bold;
color: white;
border: 0 none;
border-radius: 0px;
cursor: pointer;
padding: 10px 5px;
margin: 10px 5px
}

#msform .action-button:hover,
#msform .action-button:focus {
box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
}
.card {

background-color: #f7f7f7!important;
}
body {

background-color: #f7f7f7!important;
}
.mobileImg{
display: none;
}
.desktopImg{
display: inline-block;
}
@media only screen and (max-width: 600px) {
.desktopImg{
display: none;
}
.mobileImg{
display: inline-block;
}
.img1{
width: unset!important
}
}

/* *{
font-family: 'FrutigerLTArabic-75Black', sans-serif;
font-weight: bold;
} */

@font-face {
font-family: "FrutigerLTArabic-75Black";
src: url({{ asset('/public/assets/fonts/FrutigerLTArabic 75Black.ttf') }});
src: url({{ asset('/public/assets/fonts/FrutigerLTStd-Bold.ttf') }});
src: url({{ asset('/public/assets/fonts/FrutigerLTStd-Bold.woff') }}) format('woff') ;
src: url({{ asset('/public/assets/fonts/FrutigerLTStd-Bold.woff2') }});
font-weight: bold;
}


@font-face {font-family: "FrutigerLTArabic-45Light"; src: url({{ asset('/public/assets/fonts/Frutiger LT Arabic 45 Light.ttf') }});


.new {
padding: 20px;
text-align: right;
}

.form-group {
display: block;
margin-bottom: 15px;
}

.form-group input {
padding: 0;
height: initial;
width: initial;
margin-bottom: 0;
display: none;
cursor: pointer;
}

.form-group label {
position: relative;
cursor: pointer;
}

.form-group label:before {
content:'';
-webkit-appearance: none;
background-color: transparent;
border: 2px solid #4796b9;
box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
padding: 10px;
display: inline-block;
position: relative;
vertical-align: middle;
cursor: pointer;
margin-left: 5px;
margin-right: -2rem !important;
}

.form-group input:checked + label:after {
content: '';
display: block;
position: absolute;
top: 5px;
right: -22px;
width: 6px;
height: 14px;
border: solid #4796b9;
border-width: 0 2px 2px 0;
transform: rotate(45deg);
}
.error{
text-align: right;
float: right;
margin-bottom: 20px;
color: red;
}




label.float-right,label.labelFloatRight {
font-size: 13px;
}

</style>
</head>
<body>

<!-- MultiStep Form -->
<div class="container" id="grad1">
<div class="row justify-content-center mt-0">
<div class="col-11 col-sm-9 col-md-7 col-lg-9 text-center p-0 mt-3 mb-2">

<div class="card px-0 pb-0 mt-3 mb-3" style="margin-top:-3rem;border:none">
<div class="row justify-content-center">
<div class="col-md-12 col-sm-12">
<img class="img img1 desktopImg" src="{{ asset('/public/images/logo1.jpeg') }}" alt="" style="max-width:100%;margin-bottom:30px;width: 50%;">
<img class="img desktopImg" src="{{ asset('/public/images/logo2.jpeg') }}" alt="" style="height:200px;margin-bottom:30px">
<img class="img mobileImg" src="{{ asset('/public/images/logo2.jpeg') }}" alt="" style="height:200px;margin-bottom:30px">
<img class="img img1 mobileImg" src="{{ asset('/public/images/logo1.jpeg') }}" alt="" style="max-width:100%;margin-bottom:30px;width: 50%;">


</div>
<div class="col-md-6 col-sm-12">
</div>

</div>

<div class="row">
<!--    <div class="col-md-12 mx-0" id="textbody">-->
<!--        <p style="font-size: 1.2rem;">-->
<!--          التسجيل في ندوة (رؤية الشباب والشابات حول مؤسسة الأسرة والزواج) مساء يوم الإربعاء الموافق ٨ فبراير  2023م عند الساعة السابعة مساءً وحتى التاسعة مساءً والمقامة في أكاديمية الحوار بالدور الثالث في مقر مركز الملك عبدالعزيز للحوار الوطني في مدينة الرياض-->
<!--        </p>-->
<!--        <p style="font-size: 1.2rem;">-->
<!--          شروط التسجيل:-->
<!--- سعودي الجنسية-->
<!--- في سن الزواج-->
<!--- أن يكون من سكان مدينة الرياض-->
<!--        </p>-->
<!--        <p style="font-size: 1.2rem;">-->
<!--          *سيتم التواصل مع المقبولين-->

<!--        </p>-->
<!--        <p>-->
<!--            *سيتم اغلاق التسجيل في حال تم اكتمال العدد-->
<!--        </p>-->
<!--    </div>-->

<div class="row">
<div class="col-md-12 mx-0" >
</div>
</div>

<div class="col-md-12 mx-0">
<form id="msform" action="{{ url('/complete') }}" method="POST" enctype="multipart/form-data">
@csrf
<fieldset style="margin-top: 1%" data-set="1">
<div style="text-align: center; padding: 10%" class="form-card">
<h4>
    انتهت فترة التسجيل شكراً لاهتمامكن نلقاكم قريباً بفعاليات أخرى
</h4>

</div>

</fieldset>
</form>
</div>
</div>

</div>

</div>
</div>
</div>
<script src="{{asset('public/assets/all/jquery.min.js')}}"></script>
<script src="{{asset('public/assets/all/jquery.js')}}"></script>
<script src="{{asset('public/assets/all/jquery.form.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" ></script>
<script src="{{asset('public/assets/all/additional-methods.min.js')}}"></script>
<script src="{{asset('public/assets/all/bootstrap.js')}}"></script>
<script src="{{ asset('public/js/messages_ar.min.js') }}"></script>
<script type="text/javascript">
// var regx=/[\u0600-\u06FF]/;
// var en_regex=/^[A-Za-z][A-Za-z0-9]*$/;
// $("#msform").validate({

//     rules: {

//         name: {
//             required: true,
//         },
//         phone: {
//             required: true,
//         },
//         email: {
//             required: true,
//         }
//         age: {
//             required: true,
//         },
//         gender: {
//             required: true,
//         }


//     },
//     messages: {

//     }
//   });

$(function () {

$(document).ready(function() {



$('#msform').submit(function (e) {
e.preventDefault();
$('.errorRquired1').text('')  ;
$('.successMSG').text('')  ;

var fd = new FormData($('form')[0]);


$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$.ajax({
'url': "{{ url('/complete') }}",
'type': 'POST',
data: fd,
cache:false,
contentType: false,
processData: false,
success: function (response) {
if (response.error==false) {
$('form').html('<h2 style="direction:rtl;">تم تسجيلكم بنجاح..</h2><h2>سيتم إرسال البادج على البريد الالكتروني الخاص بكم</h2>' +
"<h2>نأمل منكم حفظ الرمز  لاتمام عملية التحضير أثناء الفعالية </h2>"+
'<br>'+
' <p  style="background:#629e20;text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">اضغط هنا</p></a>'

);

$('#textbody').text('');

}else {
if (response.count>=1){
$('input[type="email"]').val('');
$('.errorRquired1').text('البريد الالكتروني مستخدم من قبل شخص آخر')  ;
}else {
$('.errorRquired1').text('هناك خطأ ما يرجى المحاولة لاحقا')  ;
}
}
}
});
});
});
});

</script>









<script>

$('#mobile').keypress(function(e) {
var mobile = $(this).val();
if(mobile.length == 10){
e.preventDefault();
}
});
</script>
</body>
</html>
