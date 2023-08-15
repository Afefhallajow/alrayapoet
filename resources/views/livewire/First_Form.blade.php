<div>
@if($currentStep == 1)
<div class="row setup-content" id="step-1">

<div class="col ">
<div class="col ">
<div id="wizard_Time" class="" role="">
<div class="row">
<div class="col-lg-6 mb-2">
<div class="form-group">
<label class="text-label">الاسم الكامل*</label>
<input type="text" id="name" wire:model="name" name="name" class="form-control"
placeholder="الاسم" required>
@error('name')
<div class="alert alert-danger">{{ $message }}</div> @enderror
</div>
</div>
<div class="col-lg-6 mb-2">
<div class="form-group">
<label class="text-label">البريد الالكتروني *</label>
<input id="email" type="email" wire:model="email" class="form-control" name="email"
placeholder="example@example.com.com" required>
@error('email')
<div class="alert alert-danger">{{ $message }}</div> @enderror
</div>
</div>
<div class="col-lg-6 mb-2">
<div class="form-group">
<label class="text-label">الجنس*</label>
<select id="gender" name="gender" wire:model="gender"
class="default-select form-control wide mb-3" required>
<option value=""> - حدد خيارًا -</option>

<option>ذكر</option>
<option>انثى</option>
</select>
@error('gender')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>
</div>
<div class="col-lg-6 mb-2" dir="ltr">
<div class="form-group" wire:ignore>
<label class="text-label d-block">رقم الجوال*</label>
<input type="tel" wire:model="mobile" id="mobileInput" name="mobile"
class="form-control w-100" style=" width: 100%" maxLength="9"
placeholder="999 999 999" required dir="ltr"
>


</div>
<input type="hidden" id="codecode" value="" wire:model="mobile_code">
@error('mobile')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>


<div class="col-lg-6 mb-2">
<div class="form-group">

<label class="text-label">الجنسية*</label>
<select id="nationality" wire:model="nationality" name="nationality"
class="default-select form-control wide mb-3">
<option value=""> - حدد خيارًا -</option>
    <option value="أردني">
        أردني
    </option>
    <option value="إماراتي">
        إماراتي
    </option>
    <option value="بحريني">
        بحريني
    </option>
    <option value="تونسي">
        تونسي
    </option>

    <option value="جزائري">
        جزائري
    </option>

    <option selected value="سعودي">
        سعودي
    </option>
    <option value="سوداني">
        سوداني
    </option>

    <option value="سوري">
        سوري
    </option>
    <option value="عماني">
        عماني
    </option>

    <option value="عراقي">
        عراقي
    </option>
    <option value="قطري">
        قطري
    </option>



    <option value="فلسطيني">
        فلسطيني
    </option>
    <option value="كويتي">
        كويتي
    </option>
    <option value="لبناني">
        لبناني
    </option>
    <option value="ليبي">
        ليبي
    </option>

    <option value="مصري">
        مصري
    </option>



    <option value="مغربي">
        مغربي
    </option>
    <option value="يمني">
        يمني
    </option>


</select>
@error('nationality')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>
</div>
<div class="col-lg-6 mb-2">
<div class="form-group">

<label class="text-label">تاريخ الميلاد*</label>
<input name="birthdate_type" type="date" wire:model="birthdate_type"
max='{{Carbon\Carbon::now()->subYears(18)->format('Y-m-d')}}'
class="form-control" id="birthdate_type" required>
@error('birthdate_type')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>
</div>


<div class="col-lg-6 mb-2">
<div class="form-group">

<label class="text-label">الدولة المقيم فيها *</label>
<select id="city" wire:model="city" name="city"
class="default-select form-control wide mb-3">
<option value=""> - حدد خيارًا -</option>
<option value="المملكة العربية السعودية">
المملكة العربية السعودية
</option>

@foreach($countries as $c)
<option value="{{$c->name_ar}}">{{$c->name_ar}}</option>
@endforeach


</select>
@error('city')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>
</div>
<div class="col-lg-6 mb-2">
<div class="form-group">
@if($city =="المملكة العربية السعودية")
<label class="text-label"> المنطقة *</label>
<select id="area" name="area" wire:model="area"
class="default-select form-control wide mb-3">

<option value=""> - حدد خيارًا -</option>
<option value="الوسطى">الوسطى</option>
<option value="الجنوبية">الجنوبية</option>
<option value="الشمالية">الشمالية</option>
<option value="الشرقية">الشرقية</option>
<option value="الغربية">الغربية</option>

</select>
@endif
<label class="text-label"> المدينة *</label>

<input id="city1" type="text" wire:model="city1" name="city1"
class="form-control"
placeholder="المدينة" required>

@error('city1')
<div class="alert alert-danger">{{ $message }}</div> @enderror
</div>
</div>


<div class="col-lg-6 mb-2">
<div class="form-group">

<label class="text-label"> المؤهل العلمي *</label>
<select id="study" name="study" wire:model="study"
class="default-select form-control wide mb-3">
<option value=""> - حدد خيارًا -</option>

<option value="دكتوراه">دكتوراه</option>
<option value="ماجستير">ماجستير</option>
<option value="دبلوم">دبلوم</option>

<option value="بكالوريوس">بكالوريوس</option>

<option value="ثانوي">ثانوي</option>

</select>
@error('study')
<div class="alert alert-danger">{{ $message }}</div> @enderror


</div>
</div>
<div class="col-lg-6 mb-2">
<div class="form-group">

<label class="text-label"> المهنة *</label>
<input pattern="[\u0600-\u06FF\u0750-\u077F]" id="job" type="text" wire:model="job" name="job" class="form-control"
placeholder="المهنة" required>

</div>
@error('job')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>

<div class="col-lg-6 mb-2">
<div class="form-group">
<label class="text-label d-block"> هل سبق لك المشاركة في مسابقات اخرى *</label>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="share" wire:model="is_share"
id="inlineRadio1" value="no">
<label class="form-check-label" for="inlineRadio1">لا</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="share" wire:model="is_share"
id="inlineRadio1" value="yes">
<label class="form-check-label" for="inlineRadio1">نعم</label>
</div>
</div>
</div>
    @error('is_share')
    <div class="alert alert-danger">{{ $message }}</div> @enderror


<div class="col-lg-6 mb-2" style="display: {{ $is_share == 'yes' ? 'block':'none'}}">
<div class="form-group" wire:ignore>
<label class="text-label"> مسابقات اخرى *</label>
<select id="anyshare" wire:model="anyshare" multiple name="anyshare"  title="الرجاء الإختيار"
class="default-select form-control wide mt-3">


<option value="برامج مسابقات شعرية">برامج مسابقات شعرية</option>
<option value="برامج الواقع">برامج الواقع</option>
<option value="امسيات اخرى">امسيات اخرى</option>
<option value="أخرى">أخرى</option>

</select>


</div>
@error('anyshare')
<div class="alert alert-danger">{{ $message }}</div> @enderror

@if($anyShareOther)
<input placeholder="الرجاء ادخال اسم المسابقة" dir="" style="text-align: right"
type="text" wire:model="anysharei" class="form-control" name="anysharei" id="anysharei">
@error('anysharei')
<div class="alert alert-danger">{{ $message }}</div> @enderror

@endif
</div>

@if($is_talent !='yes')
<div class="col-lg-6 mb-2">
<div class="form-group">
<label class="text-label d-block"> هل لديك أي موهبة *</label>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="is_talent"
wire:model="is_talent"
id="inlineRadio1" value="no">
<label class="form-check-label" for="inlineRadio1">لا</label>
</div>
    @error('is_talent')
    <div class="alert alert-danger">{{ $message }}</div> @enderror

    <div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="is_talent"
wire:model="is_talent"
id="inlineRadio1" value="yes">
<label class="form-check-label" for="inlineRadio1">نعم</label>
</div>
</div>
</div>
    @endif
<div class="col-lg-6 mb-2" style="display: {{ $is_talent == 'yes' ? 'block':'none'}}">
<div class="form-group" wire:ignore>

<label class="text-label"> هل لديك أي موهبة *</label>
<select id="anytalent" wire:model="anytalent" multiple name="anytalent" title="الرجاء الإختيار"
class="default-select form-control wide mt-3">
<option value="تقديم">تقديم</option>
<option value="انشاد">انشاد</option>

<option value="تمثيل">تمثيل</option>
<option value="غناء">غناء</option>

<option value="أخرى">أخرى</option>

</select>

</div>
@error('anytalent')
<div class="alert alert-danger">{{ $message }}</div> @enderror

@if($anyTalentOther)

<input wire:model="anytalenti"  dir="" placeholder="الرجاء ادخال الموهبة" style="text-align:right"
type="text" class="form-control" name="anytalenti" id="anytalenti">
@error('anytalenti')
<div class="alert alert-danger">{{ $message }}</div> @enderror

@endif
</div>

<div class="col-lg-12 mb-3">
<h5 class="card-title"> حسابات التواصل الاجتماعي </h5>
<div class="form-group">
<label class="text-label"> فيسبوك </label>
<input type="text" wire:model="facebook" id="facebook" name="facebook"
class="form-control">
<label class="text-label"> انستغرام </label>
<input type="text" wire:model="instagram" id='instagram' name="instagram"
class="form-control">
<label class="text-label"> تويتر </label>
<input type="text" wire:model="twitter" id="twitter" name="twitter"
class="form-control">
</div>
</div>
</div>
</div>


<br>
<div class="form-row btn1">

<button
style="border: 0 none;border-radius: 12px;ont-weight: bold;color: white;width: 100px;background: #b79045;cursor: pointer;padding: 10px 5px;margin: 10px 5px;"
class="next action-button lastAccept" id="lastAccept" wire:click="firstStepSubmit"
type="button">التالي
</button>

</div>

</div>
</div>

</div>


<script>
var mobile = document.getElementById("mobileInput");
var iti = intlTelInput(mobile, {
initialCountry: "sa"
});
$('#codecode').val(iti.getSelectedCountryData().dialCode);
@this.set('mobile_code', iti.getSelectedCountryData().dialCode);
mobile.addEventListener("countrychange", function () {
@this.set('mobile_code', iti.getSelectedCountryData().dialCode);
$('#codecode').val(iti.getSelectedCountryData().dialCode);
});

$('#mobileInput').on('change', function () {

var extension = iti.getExtension();

});
</script>
<script>
window.addEventListener('first', event => {
jQuery('.default-select').selectpicker();


})

</script>
@endif

</div>
