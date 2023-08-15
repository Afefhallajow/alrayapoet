<div>
@if($currentStep == 1)
<div class="row setup-content" id="step-1">
<div style="text-align: center" class="row">
<h1> المعلومات الشخصية</h1>
</div>
<div class="col ">
<div class="col ">
<div id="wizard_Time" class="" role="">
<div class="row">
<div class="col-lg-6 mb-2">
<div class="form-group">
<label class="text-label">الاسم الكامل*</label>
<input disabled type="text" id="name" wire:model="name" name="name" class="form-control"
placeholder="الاسم" required>
@error('name')
<div class="alert alert-danger">{{ $message }}</div> @enderror
</div>
</div>
<div class="col-lg-6 mb-2">
<div class="form-group">
<label class="text-label">البريد الالكتروني *</label>
<input disabled id="email" type="email" wire:model="email" class="form-control" name="email"
placeholder="example@example.com.com" required>
@error('email')
<div class="alert alert-danger">{{ $message }}</div> @enderror
</div>
</div>
<div class="col-lg-6 mb-2">
<div class="form-group">
<label class="text-label">الجنس*</label>
<input disabled id="gender" name="gender" wire:model="gender"
class="default-select form-control wide mb-3" >
@error('gender')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>
</div>
<div class="col-lg-6 mb-2" dir="rtl">
<div class="form-group" wire:ignore>
<label class="text-label d-block">رقم الجوال*</label>
<input disabled type="tel" wire:model="mobile" id="mobileInput" name="mobile"
class="form-control w-100" style=" width: 100%"
placeholder="999 999 999" required dir="rtl"
>


</div>
@error('mobile')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>


<div class="col-lg-6 mb-2">
<div class="form-group">

<label class="text-label">الجنسية*</label>
<input class="form-control" disabled id="nationality" wire:model="nationality" name="nationality">
@error('nationality')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>
</div>
<div class="col-lg-6 mb-2">
<div class="form-group">

<label class="text-label">تاريخ الميلاد*</label>
<input disabled name="birthdate_type" dir="rtl" type="text" wire:model="birthdate_type"
class="form-control" id="birthdate_type" >
@error('birthdate_type')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>
</div>


<div class="col-lg-6 mb-2">
<div class="form-group">

<label class="text-label">الدولة المقيم فيها *</label>
<input disabled id="city" wire:model="city" name="city"
class="default-select form-control wide mb-3">


</input>
@error('city')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>
</div>
<div class="col-lg-6 mb-2">
<div class="form-group">
@if($city =="المملكة العربية السعودية")
<label class="text-label"> المنطقة *</label>
<select disabled id="area" name="area" wire:model="area"
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

<input disabled id="city1" type="text" wire:model="city1" name="city1"
class="form-control"
placeholder="المدينة" required>

@error('city1')
<div class="alert alert-danger">{{ $message }}</div> @enderror
</div>
</div>


<div class="col-lg-6 mb-2">
<div class="form-group">

<label class="text-label"> المؤهل العلمي *</label>
<input disabled id="study" name="study" wire:model="study"
class="default-select form-control wide mb-3">
@error('study')
<div class="alert alert-danger">{{ $message }}</div> @enderror


</div>
</div>
<div class="col-lg-6 mb-2">
<div class="form-group">

<label class="text-label"> المهنة *</label>
<input disabled  id="job" type="text" wire:model="job" name="job" class="form-control"
placeholder="المهنة" required>

</div>
@error('job')
<div class="alert alert-danger">{{ $message }}</div> @enderror

</div>


<div class="col-lg-6 mb-2" >
<div class="form-group" wire:ignore>
<label class="text-label"> المواهب  *</label>
<input disabled id="anyshare" wire:model="anytalent"  name="anytalent"  title="الرجاء الإختيار"
class="default-select form-control wide mt-3">



</div>


</div>
<div class="col-lg-6 mb-2" >
<div class="form-group" wire:ignore>
<label class="text-label"> المسابقات  *</label>
<input disabled id="anyshare" wire:model="anyshare"  name="anyshare"  title="الرجاء الإختيار"
class="default-select form-control wide mt-3">



</div>
@error('anyshare')
<div class="alert alert-danger">{{ $message }}</div> @enderror


</div>


<div class="col-lg-12 mb-3">
<h5 class="card-title"> حسابات التواصل الاجتماعي </h5>
<div class="form-group">
<label class="text-label"> فيسبوك </label>
<input disabled type="text" wire:model="facbook" id="facebook" name="facebook"
class="form-control">
<label class="text-label"> انستغرام </label>
<input disabled type="text" wire:model="instagram" id='instagram' name="instagram"
class="form-control">
<label class="text-label"> تويتر </label>
<input disabled type="text" wire:model="twitter" id="twitter" name="twitter"
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

@endif

</div>
