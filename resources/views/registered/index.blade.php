
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>  شاعر الراية</title>


<link href="{{asset('multiselect.css')}}" rel="stylesheet"/>
<script src="{{asset('multiselect.min.js')}}"></script>


<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
<script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>
<script src="library/dselect.js"></script>


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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<link rel = "stylesheet" type = "text / css" href = "https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">
<! - تضمين المكون الإضافي ->
<script src = "https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"> </script>
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300&family=Tajawal:wght@200;300;400;500&display=swap');

@import url(https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css);
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


/* background-color: #b79045; */
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
height:100%;
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
font-size: 15px;
font-family: 'Tajawal';
}
#msform{
display:none;
}



label.float-right, label.labelFloatRight {
font-size: 15px;
font-family: 'Tajawal';
font-weight: 600;
color: #201211;
}


#msform input {
border: 1px solid #ccc;
padding: 4px 8px 4px 8px;
border-radius: 15px;
}

select#nationality {
border-radius: 15px;
}
select#city {
border-radius: 15px;
}
select#city1s {
border-radius: 15px;
}
select#gender {
border-radius: 15px;
}
#progressbar .active {
color: #b79045;
font-weight: 600;
}
label.requiredStar {
color: #201211;
font-weight: 600;
}
.conditions {
padding: 2rem;
}

select#job {
border-radius: 15px;
}
select#job:focus {
border-bottom: 2px solid #b79045
}

.form-control:focus {
border-color: #b79045 !important;
box-shadow: 0 0 5px #b79045 !important;
}


select#city.select-items {
position: absolute;
background-color: #b79045;
top: 100%;
left: 0;
right: 0;
z-index: 99;
}

pre {
display: block;
font-size: 87.5%;
color: #ffffff;
background-color: #b79045;
}

#progressbar li:before {
width: 50px;
height: 50px;
line-height: 45px;
display: block;
font-size: 18px;
color: #ffffff;
background: #ebd7b0;
border-radius: 50%;
margin: 0 auto 10px auto;
padding: 2px;
}

#msform , #msform textarea {
padding: 2px 8px 4px 8px;

margin-bottom: 25px;
margin-top: 2px;
width: 100%;
box-sizing: border-box;
color: #201211;
font-size: 15px;
letter-spacing: 1px;
font-family: 'Tajawal';
font-weight: 500;
}

select#study {
border-radius: 15px;
}

</style>
</head>
<body>

<!--
<section class="header" >
<h1 style="font-family: 'Tajawal', sans-serif;">للمشاركة في البرنامج</h1>
</section>
-->
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1" style="background-image:url( 'public/assets/bg7.jpg') ;background-repeat: no-repeat;background-size: cover;height: 100%;">
<div class="row justify-content-center mt-0">
<div class="col-11 col-sm-9 col-md-7 col-lg-9 text-center p-0 " style="margin-top:6rem;margin-bottom: 6rem;">
<div class="card px-0 pb-0 " style="border-left: 3px solid #5e543fbd;
border-right: 3px solid #5e543fbd;">
<!--<img class="img-line" src="public/w-9.png" alt="">-->
<div class="row">
<div class="col-md-12 mx-0">
<img width="90" src="{{ asset('/public/assets/logo.png') }}" title="logo" alt="logo" >
<div class="" style="height:auto;direction:rtl;text-align:right;padding:2rem">

<h4 style="text-align:center;">
شروط المشاركة في مسابقة برنامج شاعر الراية
</h4>
<h4>
<br>
</h4>
<h4>
الشروط الخاصة بآلية ومحتوى المشاركة في مسابقة برنامج شاعر الراية:
</h4>
<ul style="padding:1rem">
<li>
التسجيل فقط عبر (البوابة) الرسمية للبرنامج
</li>
<li>
عمر المتقدم لا يقل عن 18
</li>
<li>
المشاركة(القصيدة) بقصيدة نبطية موزونة ومقفاه تتحدث عن رؤية المملكة 2030
</li>
<li>
المشاركة(القصيدة) لم يسبق لها الظهور الإعلامي في أي وسيلة إعلامية او أي مسابقة أخرى
</li>
<li>
ابيات المشاركة (القصيدة) لا تقل عن 12 بيت ولا تزيد عن 15 بيت
</li>
<li>
يتم رفع المشاركة (القصيدة) عبر (البوابة) بالصيغ التالية:
</li>
<li style="list-style-type: none;">
<ul style="list-style-type: ' - ';">
<li>
نص مكتوب (خالي من الأخطاء المطبعية)
</li>
<li>
فيديو (عالي الجودة) يظهر فيه صاحب المشاركة (القصيدة) وهو يقوم بإلقائها بشكل واضح و مميز لمدة لا تتجاوز (120 ثانية)
</li>
</ul>
</li>
</ul>

<div class="form-group" style="margin-right:2.5rem">
<div class="form-check">
<input class="form-check-input" type="checkbox" id="FieldsetCheck" >
<label style="font-family: 'Tajawal', sans-serif;" class="form-check-label" id="myLabelcheck" for="FieldsetCheck">
<a target="_blank" href="https://alrayapoet.com/conditions/" style="color:#b79045">
أوافق على الشروط والاحكام الخاصة بوابة تسجيل المشاركات لمسابقة (برنامج شاعر الراية )
</a>
</label>
</div>

</div>
<div style="text-align:center">
<input style="border: 0 none;border-radius: 12px;ont-weight: bold;color: white;width: 100px;background: #b79045;cursor: pointer;padding: 10px 5px;margin: 10px 5px;" type="button"  o name="next" class="next action-button lastAccept" id="lastAccept" value="التالي" />
<p class="pacceptmsg" style="color:red;visibility:hidden">
يجب الموافقة على الشروط والأحكام</p>
</div>
</div>
<form id="msform" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
@csrf
<!--   <img width="90" src="{{ asset('/public/assets/logo.png') }}" title="logo" alt="logo" > -->
<h1 style="font-family: 'Tajawal', sans-serif;color:#201211;">للمشاركة في البرنامج</h1>

<ul id="progressbar">
<li style="font-family: 'Tajawal', sans-serif;" id="payment"><strong></strong>حدثنا عنك </li>
<li style="font-family: 'Tajawal', sans-serif;" id="account"><strong></strong>تحميل مشاركتك </li>
<li style="font-family: 'Tajawal', sans-serif;" class="active" id="personal">معلوماتك الشخصية </li>

</ul> <!-- fieldsets -->
<fieldset data-set="1">
<div class="form-card">
<!--<h2 style="text-align:end" class="fs-title"> معلوماتك الشخصية</h2>-->
<br>
<div style="direction: rtl;" class="row">
<div style="float:right" class="col-md-6  div1">
<label for="member" class="requiredStar float-right">الاسم الكامل </label>
<input  type="text" id="name" name="name" placeholder="" />
<pre style="display: none;text-align:right"  type="text" id="namem" name="namem" placeholder="" ></pre>

</div>



<div class="col-md-6 pull-left div2 ">
<label for="member" class="requiredStar float-right"> البريد الالكتروني </label>
<input dir="ltr" type="email" required id="email" name="email" placeholder="" />
<span class="invalidEmailMSG" style="position:absolute;color:red">*</span>
<pre dir="ltr" style="display: none;text-align:right" type="text" id="emailm" name="emailm" placeholder="" ></pre>


</div>
</div>
<div class="row">

<div class="col-md-6  mobile-clas">
<label for="mobile" class="requiredStar float-right">رقم الجوال</label>
<br>

<input dir="ltr" type="number" pattern="\d*" maxlength="9" id="mobile" name="mobile" placeholder="55 444 5555" />
<pre style="display: none" type="text" id="mobilem" name="mobilem" placeholder="" ></pre>

</div>


<div class="col-md-6">
<label for="gender" class="requiredStar float-right">الجنس</label>
<select style="font-family: 'Tajawal', sans-serif;" name="gender" id="gender" dir="rtl" class="form-control">
<option value="ذكر">
ذكر </option>
<option value="أنثى ">
أنثى
</option>
</select>

<pre style="display: none;text-align:right" type="text" id="genderm" name="genderm" placeholder="" ></pre>

</div>


</div><br>
<div class="row">

<div class="col-lg-6">
<label for="birthdate_type" class="requiredStar float-right">تاريخ الميلاد </label>
<input type="text" dir="rtl" class="form-control hijri-date-input" name="birthdate_type" id="birthdate_type" />
<pre style="display: none;text-align:right" type="text" id="birthdate_typem" name="birthdate_typem" placeholder="" ></pre>

</div>



<div class="col-lg-6">
<label for="member" class="requiredStar float-right">الجنسية</label><br>

<select id="nationality" name="nationality" dir="rtl" class="form-control">
<option  value = "" disabled> - حدد خيارًا - </option >
<option  value = "جزائري" >
جزائري
</option >
<option  value = "بحريني" >
بحريني
</option >


<option  value = " egyptian " >
مصرية </option >
<option  value = "إماراتي" >
إماراتي </option >

<option  value = "عراقي" >
عراقي </option >
<option  value = "أردني" >
أردني </option >

<option  value = "كويتي" >
كويتي </option >

<option  value = "لبناني" >
لبناني </option >
<option  value = "ليبي" >
ليبي
</option >
<option  value = "مغربي" >
مغربي
</option >

<option  value = "قطري" >
قطري </option >

<option selected  value = "سعودي" >
سعودي </option >

<option  value = "سوداني" >
سوداني </option >

<option  value = "سوري" >
سوري </option >

<option  value = "تونسي" >
تونسي </option >
<option value="عماني">
عماني
</option>
<option value="فلسطيني">
فلسطيني
</option>
</select><br>

<pre style="display: none;text-align:right" type="text" id="nationalitym" name="nationalitym" placeholder="" ></pre>

</div>
</div>


<div  style="direction: rtl;" class="row">



<div class="col-lg-6">


<label for="city" class="requiredStar float-right">الدولة المقيم فيها  </label>
<select onchange="cityhhhh(this.value)" style="  font-family: 'Tajawal', sans-serif;" type="text" id="city" name="city" dir="rtl"  class="form-control" required>
<option value="" disabled>إختر</option>

<option selected value="المملكة العربية السعودية">
المملكة العربية السعودية
</option>

@foreach($countries as $c)
<option value="{{$c->name_ar}}">{{$c->name_ar}}</option>
@endforeach



</select><br>


<pre style="display: none;text-align:right" type="text" id="citym" name="citym" placeholder="" ></pre>


</div>

<div class="col-lg-6">
<div id="sel">
<label for="city1" class="float-right requiredStar">المنطقة</label>

<select  dir="rtl"  class="form-control" name="city1s" id="city1s">
    <option selected value="">.......</option>
    <option  value="جدة">جدة</option>
<option  value="المدينة المنورة">المدينة المنورة</option>
<option value="الدمام">الدمام</option>
<option value="الرياض">الرياض</option>
<option value="مكة">مكة</option>
<option value="بريدة">بريدة</option>
<option value="أبها">أبها</option>
<option value="تبوك">تبوك</option>
<option value="حائل">حائل</option>
<option value="عرعر">عرعر</option>
<option value="جيزان">جيزان</option>
<option value="نجران">نجران</option>
<option value="الباحة">الباحة</option>
<option value="سكاكا">سكاكا</option>

</select>
</div>
<div style="display: block" id="inp">
<label style="display: none" id="lab" for="city1" class="requiredStar float-right">المدينة</label>
<input placeholder="المدينة" dir="rtl" type="text" class="form-control" name="city1" id="city1">
<pre id="city1m"></pre>
</div>


</div>
</div>

<!--<div  dir="rtl" class="row">-->
<!-- <div class="col-lg-6">-->

<!--     <label dir="rtl"  for="birthdate_type" class="float-right">تاريخ الميلاد </label>-->
<!--     <input type="text" class="form-control hijri-date-input" name="birthdate_type" id="birthdate_type" />-->
<!--<select style="" name="birthdate_type" id="birthdate_type" dir="rtl" class="form-control">-->
<!--    <option value="هجري">-->
<!--         هجري </option>-->
<!--    <option value="ميلادي">-->
<!--        ميلادي -->
<!--    </option>-->
<!--</select>-->
<!-- <br>-->
<!--</div>-->

<!--<div class=" col-md-3">-->

<!--   <label class="labelclass float-right" for="inputState">السنة</label>-->
<!--  <input dir="rtl" type="text" id="year" name="year" placeholder=" " />-->
<!--</div>-->
<!--<div class=" col-md-3">-->

<!--  <label class="labelclass float-right" for="inputState">الشهر</label>-->
<!--   <input dir="rtl" type="number" id="month" name="month" placeholder=" " />-->
<!--</div>-->
<!--<div class=" col-md-3">-->

<!--  <label class="labelclass float-right"  for="inputZip">اليوم</label>-->
<!--   <input dir="rtl" type="number" id="day" name="day" placeholder=" " />-->
<!--</div>-->
<!--</div>-->

<div  style="direction: rtl;" class="row">


<div class="col-lg-6">
<label for="study" class="requiredStar float-right">المؤهل العلمي</label>
<select class="form-control" dir="" type="text" class="form-control" name="study" id="study">
<option value="دكتوراه">دكتوراه</option>
<option value="ماجستير">ماجستير</option>
<option value="بكالوريوس">بكالوريوس</option>

</select>
<pre id="studym"></pre>

</div>
<select dir="rtl" id='testSelect1' multiple>
<option value='1'>Item 1</option>
<option value='2' selected>Item 2</option>
<option value='3' selected>Item 3</option>
<option value='4'>Item 4</option>
<option value='5'>Item 5</option>
</select>

<div class="col-lg-6">
<label for="job" class="requiredStar float-right">المهنة</label>
<input  dir="" type="text" class="form-control" name="job" id="job">
<pre id="jobm"></pre>
</div>

</div>
<div class="row">
<div class="col-md-6">
<label for="job" class="requiredStar float-right"> هل لديك اي موهبة</label>
<select   dir="rtl" type="text" onchange="anytalent1(this.value)" class="form-control" name="anytalent" id="anytalent" multiple>
<option value="تقديم">تقديم</option>
<option value="انشاد">انشاد</option>
<option value="تمثيل">تمثيل</option>
<option value="أخرى">أخرى</option>

</select>
<input  dir=""  placeholder="الرجاء الموهبة" style="display: none;text-align:right" type="text" class="form-control" name="anytalenti" id="anytalenti">


</div>
<div class="col-md-6">
<label for="job" class="requiredStar float-right">هل سبق لك المشاركة في مسابقة اخرى</label>
<select  dir="rtl" onchange="anyshare1(this.value)" type="text" class="form-control" name="anyshare" id="anyshare" multiple>
<option value="برامج مسابقات شعرية">برامج مسابقات شعرية</option>
<option value="برامج الواقع">برامج الواقع</option>
<option value="امسيات اخرى">امسيات اخرى</option>

<option value="أخرى">أخرى</option>

</select>

<input placeholder="الرجاء ادخال اسم المسابقة" dir=""  style="display: none;text-align: right" type="text" class="form-control" name="anysharei" id="anysharei">

</div>

</div>
<br>
<div class="row">
<div class="col-lg-12">
<label for="hobbies" class="float-right">حسابات التواصل الاجتماعي</label>
<br>
<div class="form-card" style="text-align: end;width:100%">
<div class="memberSelect" style="text-align: end;">
<label class="float-right" for="member">فيسبوك </label>
<input dir="rtl" type="text" class="form-control" name="facebook" id="facebook_account">
</div>
<div class="memberSelect" style="text-align: end;">
<label class="float-right" for="member">انستغرام </label>
<input dir="rtl" type="text" class="form-control" name="instagram" id="instagram_account">
</div>
<div class="memberSelect" style="text-align: end;">
<label class="float-right" for="member">تويتر </label>
<input dir="rtl" type="text" class="form-control" name="twitter" id="twitter_account">
</div>
</div>
</div>
</div>



</div><input style="font-family: 'Tajawal', sans-serif;border-radius: 12px;" type="button" name="next" class="next action-button nextInfoBtn" value="التالي" />
<p class="errorRquired1" style="color:red"></p>
</fieldset>
<fieldset data-set="2">
<div class="form-card" style="text-align: end;">
<div class="memberSelect">
<label class="requiredStar" style="font-family: 'Tajawal', sans-serif;"  for="member"> يرجى تحميل الصورة الشخصية </label>
<input type="file" class="form-control" name="image" id="image" accept="image/png, image/gif, image/jpeg" required>
<input style="display: none" type="text" class="form-control" name="image_name" id="image_name"  required>
<pre id="infoim"></pre>

</div>
<div class="memberSelect">
<label class="requiredStar" style="font-family: 'Tajawal', sans-serif;"  for="member"> يرجى تحميل فيديو القصيدة   </label>
<input  type="file" name="video" id="video" accept="video/mp4,video/x-m4v,video/*" required>
<label for="member" style="font-family: 'Tajawal', sans-serif;color:#b79045">  بجودة عالية وبوضوح الحجم 500ميغا – المدة لاتزيد عن 120 ثانية  </labe>

<input type="hidden" id="video_name">

</div>
<pre id="infos"></pre>

<br>
<div class="memberSelect">
<label class="requiredStar"  style="font-family: 'Tajawal', sans-serif;" for="member"> حمل القصيدة  </label>
<input style="margin-bottom:12px" type="file" accept="application/pdf,image/*" class="form-control" name="poem" id="poem" required>
<pre id="infop"></pre>
<label for="member" style="font-family: 'Tajawal', sans-serif;color:#b79045">  مكتوبة بوضوح   </label>
<input style="display: none" type="text" class="form-control" name="poem_name" id="poem_name"  required>

</div>
<br>
</div> <input style="border-radius: 12px;" type="button" name="previous" class="previous action-button-previous preVisaBtn" value="السابق"  > <input style="border-radius: 12px;" type="button"  name="next" class="next action-button nextVisaBtn passportBtn" value="التالي" />
<p class="errorRquired2" style="color:red"></p>
</fieldset>
<fieldset data-set="3">
<div class="form-card" style="text-align: end;">
<h2 style="font-family: 'Tajawal', sans-serif;text-align: end;" class="fs-title">حدثنا عنك </h2>
<textarea style="font-family: 'Tajawal', sans-serif;border: 1px solid #ccc;resize:none" name="description" id="description" cols="30" rows="10" class="from-control">

</textarea>
</div>







<input  style="font-family: 'Tajawal', sans-serif;border-radius:12px" type="submit" name="make_payment" id="confirmBtn" class="next action-button confirmBtn nextpayBtn" value="تأكيد" />
<p class="errorRquired3" style="color:red"></p>
</fieldset>

<fieldset>
<div class="form-card">
<div class="row justify-content-center" style="background: #fff;">
<div class="col-3 col-sm-1 img-error">
<!--<div class="dots-bars-2"></div>-->
<div class="loader"></div>
<img width="90px" src="public/ok-img.png" class="fit-image">
<img width="60px" src="https://www.freeiconspng.com/thumbs/error-icon/round-error-icon-16.jpg" class="fit-image error">
</div>
</div> <br>
<h2 style="font-family: 'Tajawal', sans-serif;" class="fs-title text-center msg-header"></h2> <br><br>
<div style="font-family: 'Tajawal', sans-serif;margin-top:-1rem;background: #fff;" class="row justify-content-center">
<div class="col-12 text-center msg-content">
<h5 style="font-family: 'Tajawal', sans-serif;"></h5>
</div>
</div>
</div>
</fieldset>
</form>
</div>
</div>

<!--<img src="public/web-03.png" alt="">-->
</div>









</div>
</div>
</div>

<script>
document.multiselect('#testSelect1')
.setCheckBoxClick("checkboxAll", function(target, args) {
console.log("Checkbox 'Select All' was clicked and got value ", args.checked);
})
.setCheckBoxClick("1", function(target, args) {
console.log("Checkbox for item with value '1' was clicked and got value ", args.checked);
});

function enable() {
document.multiselect('#testSelect1').setIsEnabled(true);
}

function disable() {
document.multiselect('#testSelect1').setIsEnabled(false);
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
crossorigin="anonymous"
referrerpolicy="no-referrer"
></script>
<script>
const handleImageUpload = event => {
const files = event.target.files
const formData = new FormData()
var info=document.getElementById("infop");

info.style.backgroundColor='#b79045';
info.style.color='white';


formData.append('myFile', files[0])
$('#infop').text('الرجاء الانتظار ريثما يتم التحميل')

fetch('{{route('uploadpoem')}}', {
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},

method: 'POST',

body: formData
})
.then(response => response.json())
.then(data => {
var poemname1=document.getElementById('poem_name');

poemname1.value=data.data;
info.style.backgroundColor='green';
$('#infop').text('تم التحميل بنجاح')

console.log(data.data);
})
.catch(error => {
console.error(error)
})
}

document.querySelector('#poem').addEventListener('change', event => {
handleImageUpload(event)
})


</script>



<script>
const handleImageUpload1 = event => {
const files = event.target.files
const formData = new FormData()
var info=document.getElementById("infoim");

formData.append('myFile', files[0])
info.style.backgroundColor='#b79045';
info.style.color='white';


$('#infoim').text('الرجاء الانتظار ريثما يتم التحميل')
fetch('{{route('uploadimage')}}', {
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},

method: 'POST',

body: formData
})
.then(response => response.json())
.then(data => {

var poemname=document.getElementById('image_name');
poemname.value=data.data;
console.log(data.data)
info.style.backgroundColor='green';
$('#infoim').text('تم التحميل بنجاح')


})
.catch(error => {
console.error(error)
})
}

document.querySelector('#image').addEventListener('change', event => {
handleImageUpload1(event)
})


</script>
<script>
function anyshare1(val)
{var a=document.getElementById('anyshare');
var b=document.getElementById('anysharei');

console.log(val);
if(val== "أخرى") {
console.log("zxvzvzvz");

a.style.display = 'block';
b.style.display = "block";
}
else {
a.style.display = "block";
b.style.display = "none";
}
}
</script>

<script>
function anytalent1(val)
{var a=document.getElementById('anytalent');
var b=document.getElementById('anytalenti');

console.log("asdasdas");
if(val== 'أخرى') {
console.log("zxvzvzvz");

a.style.display = 'block';
b.style.display = "block";
}
else {
a.style.display = "block";
b.style.display = "none";
}
}
</script>




<script>
function cityhhhh(val)
{var a=document.getElementById('sel');
var b=document.getElementById('inp');
var c=document.getElementById('lab');

console.log("asdasdas");
if(val== 'المملكة العربية السعودية')
{
console.log("zxvzvzvz");

a.style.display='block';
b.style.display="block";

c.style.display='none'        }
else {a.style.display="none";
b.style.display="block";
c.style.display='block'}
}
</script>
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
<script src="public/assets/register/hijri/js/bootstrap-hijri-datetimepicker.js"></script>
<script>
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
FilePond.registerPlugin(FilePondPluginFileValidateSize,FilePondPluginFileValidateType);
const inputElement = document.querySelector('#video');
console.log(inputElement.duration);
const pond = FilePond.create(inputElement,{
maxFileSize: '500MB',
acceptedFileTypes: ['video/*'],
fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {

// Do custom type detection here and resolve promise

resolve(type);
})
});
FilePond.setOptions({
server: {
url: "{{route('upload')}}",
process:{
headers: {
'X-CSRF-TOKEN': '{{ csrf_token() }}'
},
onload: (response) => { document.getElementById('video_name').value  = response; },
onerror: (response) => { alert('please try after one minute'); }
}
}
});
</script>
<script>
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){





current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
// $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

function validateEmail(email) {
var re = /^(([a-zA-Z0-9]+)|([a-zA-Z0-9]+((?:\_[a-zA-Z0-9]+)|(?:\.[a-zA-Z0-9]+))*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-zA-Z]{2,6}(?:\.[a-zA-Z]{2})?)$)/;
return re.test(email);
}

if(current_fs.data('set') == 1){
var selectpickerCheck  = $('#selectpicker').val();
if($('#job').val() == '' ||$('#study').val() == '' || $('#name').val() == '' || $('#email').val() == '' ||  $('#mobile').val().length < 8 || $('#age').val() == ''|| $('#city').val() == '' || $('#nationality').val() == '' || $('#birthdate_type').val() == ''){
$('.errorRquired1').text('جميع الحقول مطلوبة');
}else{
var email = $("#email").val();
if (validateEmail(email)) {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
'url': 'checkEmail/'+email,
'type': 'GET',
'dataType': 'json',
data: email,
cache:false,
contentType: false,
processData: false,
success: function (response) {
$('.errorRquired1').text('');
$('.invalidEmailMSG').css('visibility','hidden');
//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
},
error: function (xhr) {
$("#progressbar li#account").removeClass("active");
$('.errorRquired1').text('هذا البريد الالكتروني مستخدم من قبل شخص آخر');
}
});

}else{
$('.invalidEmailMSG').css('visibility','visible');
$('.errorRquired1').text('يجب إدخال بريد إلكتروني صالح');
}

}
}
if(current_fs.data('set') == 2){
var file1 = document.getElementById("image");
var file2 = document.getElementById("video_name");
var file3 = document.getElementById("poem");




if(file1.files.length == 0  || file2.value.length == 0  || file3.files.length == 0 || file2.value =='fff' ){
if(file2.value =='fff'){
var info=document.getElementById('infos');
info.style.backgroundColor='red';
info.style.color='white';

$('#infos').text('وقت الفيديو يجب ان يكون بين 30 ثانية و120 ثانية');
}else{


$('.errorRquired2').text('جميع الحقول مطلوبة');
}}else{
$('.errorRquired2').text('');
//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
}
}

if(current_fs.data('set') == 3){
if($('#badgeName').val() == '' || $('#badgeSide').val() == '' || $('#badgeJob').val() == ''){
$('.errorRquired3').text('جميع الحقول مطلوبة');
}else{
$('.errorRquired3').text('');
//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
}
}


});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
// $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 600
});
});

$('.radio-group .radio').click(function(){
$(this).parent().find('.radio').removeClass('selected');
$(this).addClass('selected');
});

$(".submit").click(function(){
return false;
})

});


const checkbox = document.getElementById('FieldsetCheck');
const acccccs = document.getElementById('lastAccept');

// checkbox.addEventListener('change', (event) => {
//   if (event.currentTarget.checked) {
//     $(".conditions").css('display','none');
//     $("#msform").css('display','block');
//   } else {

//   }
// })

acccccs.addEventListener('click', (event) => {
if (checkbox.checked) {

$('p.pacceptmsg').css('visibility','hidden');
$(".conditions").css('display','none');
$("#msform").css('display','block');
} else {
$('p.pacceptmsg').css('visibility','visible');
}
})



</script>
<script>

$('.nextInfoBtn').click(function(){
if(  $('#city1').val() == ''||$('#job').val() == '' ||$('#study').val() == '' || $('#name').val() == '' || $('#email').val() == '' ||  $('#mobile').val().length < 8 || $('#age').val() == ''|| $('#city').val() == '' || $('#nationality').val() == '' || $('#birthdate_type').val() == '' ){
var name1=document.getElementById("namem");
var email1=document.getElementById("emailm");
var mobile1=document.getElementById("mobilem");
var city11=document.getElementById("citym");
var city1m=document.getElementById("city1m");

var jopm=document.getElementById("jobm");
var studym=document.getElementById("studym");

var nat1=document.getElementById("nationalitym");
var brith1=document.getElementById("birthdate_typem");

if(            $('#city1').val() == '')
{city1m.style.display="block";
city1m.style.backgroundColor="red";
city1m.style.color="white";
city1m.style.textAlign='right';

$('#city1m').text('هذا الحقل مطلوب');

}


if(            $('#job').val() == '')
{jopm.style.display="block";
jopm.style.backgroundColor="red";
jopm.style.color="white";
jopm.style.textAlign='right';

$('#jobm').text('هذا الحقل مطلوب');

}
if(            $('#study').val() == '')
{studym.style.display="block";
studym.style.backgroundColor="red";
studym.style.color="white";
studym.style.textAlign='right';

$('#studym').text('هذا الحقل مطلوب');

}


if(            $('#city1').val() == '.')
{city1m.style.display="block";
city1m.style.backgroundColor="red";
city1m.style.color="white";
city1m.style.textAlign='right';

$('#city1m').text('هذا الحقل مطلوب');

}


if(            $('#name').val() == '')
{name1.style.display="block";
name1.style.backgroundColor="red";
name1.style.color="white";

$('#namem').text('هذا الحقل مطلوب');

}
if(            $('#mobile').val() == '')
{mobile1.style.display="block";
mobile1.style.backgroundColor="red";
mobile1.style.color="white";

$('#mobilem').text('هذا الحقل مطلوب');

}
if(            $('#email').val() == '')
{email1.style.display="block";
email1.style.backgroundColor="red";
email1.style.color="white";

$('#emailm').text('هذا الحقل مطلوب');

}
if(            $('#city').val() == '')
{city11.style.display="block";
city11.style.backgroundColor="red";
city11.style.color="white";

$('#citym').text('هذا الحقل مطلوب');

}
if(            $('#birthdate_type').val() == '')
{brith1.style.display="block";
brith1.style.backgroundColor="red";
brith1.style.color="white";

$('#birthdate_typem').text('هذا الحقل مطلوب');

}
if(            $('#nationality').val() == '')
{nat1.style.display="block";
nat1.style.backgroundColor="red";
nat1.style.color="white";

$('#nationalitym').text('هذا الحقل مطلوب');

}

}else{
$("#progressbar li#account").addClass("active");
}

});

$('.nextVisaBtn').click(function(){
var file11 = document.getElementById("image");
var file22 = document.getElementById("video_name");
var file33 = document.getElementById("poem");
if(file11.files.length == 0  || file22.value.length == 0  || file33.files.length == 0 ){
}else{
$("#progressbar li#payment").addClass("active");
}
});

$('.preVisaBtn').click(function(){
$("#progressbar li#account").removeClass("active");
});

$('.prepayBtn').click(function(){
$("#progressbar li#payment").removeClass("active");
});



$('.nextpayBtn').click(function(){


});

$('.preConfirmBtn').click(function(){
$("#progressbar li#services").removeClass("active");
});


$('.nextservicesBtn').click(function(){

if($('#inBahreen').val() == 'No' && $('#member').val() == 'No' && file.files.length == 0 ){

}else{
$("#progressbar li#confirm").addClass("active");
}
});

$('.preservicesBtn').click(function(){
$("#progressbar li#confirm").removeClass("active");
});

</script>
<script>
$(function () {

$('#msform').submit(function (e) {
e.preventDefault();

var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
$("input[name='mobile').attr('type','text');
$("input[name='mobile').val(full_number);
var name = $('#name').val();
var mobile = $('#mobile').val();
var email = $('#email').val();

var birthdate_type = $('#birthdate_type').val();
// var day = $('#day').val();
// var month = $('#month').val();
// var year = $('#year').val();

var hobbies = $('#hobbies').val();
var nationality = $('#nationality').val();
var city = $('#city').val();

var city1 = $('#city1').val();
var city1s = $('#city1s').val();
var job = $('#job').val();
var study = $('#study').val();
var anytalent = $('#anytalent').val();
var anytalenti = $('#anytalenti').val();
var anyshare = $('#anyshare').val();
var anysharei = $('#anysharei').val();

var gender = $('#gender').val();
var description = $('#description').val();
var facbook = $('#facebook_account').val();
var instagram = $('#instagram_account').val();
var twitter = $('#twitter_account').val();


var fd = new FormData();

var url = $(this).attr('action');
fd.append('name',name);
fd.append('mobile',mobile);
fd.append('email',email);

fd.append('birthdate_type',birthdate_type);
// fd.append('day',day);
// fd.append('month',month);
// fd.append('year',year);

fd.append('nationality',nationality);
fd.append('city',city);
fd.append('city1',city1);
fd.append('city1s',city1s);
fd.append('job',job);

fd.append('gender',gender);
fd.append('hobbies','');
fd.append('facbook',facbook);
fd.append('instagram',instagram);
fd.append('study',study);
fd.append('anytalent',anytalent);
fd.append('anytalenti',anysharei);
fd.append('anyshare',anyshare);
fd.append('anysharei',anysharei);

fd.append('twitter',twitter);
fd.append('description',description);
fd.append('image', $('#image_name').val());
fd.append('video', $('#video_name').val());
fd.append('poem', $('#poem_name').val());

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
'url': url,
'type': 'POST',
'dataType': 'json',
data: fd,
cache:false,
contentType: false,
processData: false,
success: function (response) {
$('.loader').css('display','none');
$('h2.msg-header').text('تسجيلك تم بنجاح');
$('.msg-content h5').text('شكرا لتسجيل مشاركتكم في برنامج شاعر الراية');
},
error:function(err){
alert('هناك خطأ في عملية التسجيل');
console.log(err);
}
});

// setTimeout(
// function() {
//             $('.loader').css('display','none');
//             $('h2.msg-header').text('تسجيلك تم بنجاح');
//             $('.msg-content h5').text('شكرا لتسجيل مشاركتكم في برنامج شاعر الراية');
//     }, 2000);

});

});
</script>


<script>
var phone_number = window.intlTelInput(document.querySelector("#mobile"), {
separateDialCode: true,
preferredCountries:["sa"],
hiddenInput: "full",
utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});
$('#selectpicker').selectpicker();
$('.filter-option-inner-inner').text('قم باختيار واحدة أو أكثر');

$('#mobile').keypress(function(e) {
var mobile = $(this).val();
if(mobile.length == 9){
e.preventDefault();
}
});
</script>
<script type="text/javascript">


$(function () {

initHijrDatePicker();

//initHijrDatePickerDefault();

$('.disable-date').hijriDatePicker({

minDate:"2020-01-01",
maxDate:"2021-01-01",
viewMode:"years",
hijri:true,
debug:true
});

});

function initHijrDatePicker() {

$(".hijri-date-input").hijriDatePicker({
locale: "ar-sa",
format: "DD-MM-YYYY",
hijriFormat:"iYYYY-iMM-iDD",
dayViewHeaderFormat: "MMMM YYYY",
hijriDayViewHeaderFormat: "iMMMM iYYYY",
showSwitcher: true,
allowInputToggle: true,
showTodayButton: false,
useCurrent: false,
viewDate:'1980-01-15',
isRTL: false,
viewMode:'months',
keepOpen: false,
hijri: false,
debug: true,
showClear: true,
showTodayButton: true,
showClose: true,
minDate:'1900-01-01',
maxDate:'2004-12-31'
});
}

function initHijrDatePickerDefault() {

$(".hijri-date-input").hijriDatePicker();

$('#birthdate_type').val('');
$(".hijri-date-input").val('');
}



</script>
</body>
</html>
