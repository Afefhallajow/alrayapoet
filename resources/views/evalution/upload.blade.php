<div>
@if($currentStep == 2)
<div class="row setup-content" id="step-2">

<div class="col-xs-12">
<div class="col-md-12">
<div class="form-row">
<div id="" class="" role="">
<div class="row">
<div class="col-lg-12 mb-3">
<div class="form-group">
<label class="text-label">يرجى تحميل صورة شخصية حديثة*</label>
<div class="form-file">
<div x-data="{ isUploading: false, progress: 5 }"
x-on:livewire-upload-start="isUploading = true"
x-on:livewire-upload-finish="isUploading = false; progress = 5"
x-on:livewire-upload-error="isUploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress">
<input wire:model="image" accept="image/png, image/gif, image/jpeg"
type="file" class="form-file-input form-control" id="customFile">
<div x-show.transition="isUploading"
class="progress progress-sm mt-2 rounded">
<div class="progress-bar bg-primary progress-bar-striped"
role="progressbar" aria-valuenow="40" aria-valuemin="0"
aria-valuemax="100" x-bind:style="`width: ${progress}%`">
<span class="sr-only"></span>
</div>
</div>
</div>

</div>
<small>يسمح بكافة انواع الصور</small>
@error('image')
<div class="alert alert-danger">{{ $message }}</div> @enderror


</div>
</div>



<div class="col-lg-12 mb-3">
<div class="form-group">
<label class="text-label"> يرجى تحميل صورة جواز السفر  *</label>
<div class="form-file">
<div x-data="{ isUploading: false, progress: 5 }"
x-on:livewire-upload-start="isUploading = true"
x-on:livewire-upload-finish="isUploading = false; progress = 5"
x-on:livewire-upload-error="isUploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress">
<input wire:model="poem" type="file" accept="application/pdf,image/*"
class="form-file-input form-control" id="customFile">
<div x-show.transition="isUploading"
class="progress progress-sm mt-2 rounded">
<div class="progress-bar bg-primary progress-bar-striped"
role="progressbar" aria-valuenow="40" aria-valuemin="0"
aria-valuemax="100" x-bind:style="`width: ${progress}%`">
<span class="sr-only"></span>
</div>
</div>
</div>
</div>
<small>يسمح بالصور وملف pdf</small>
@error('poem')
<div class="alert alert-danger">{{ $message }}</div> @enderror

<br>
</div>
</div>


</div>
</div>

</div>

<div class="form-row btn1">

<button
style="border: 0 none;border-radius: 12px;ont-weight: bold;color: white;width: 100px;background: #b79045;cursor: pointer;padding: 10px 5px;margin: 10px 5px;"
type="button" wire:click="back(1)">
رجوع
</button>

<button
style="border: 0 none;border-radius: 12px;ont-weight: bold;color: white;width: 100px;background: #b79045;cursor: pointer;padding: 10px 5px;margin: 10px 5px;"
wire:click="secondStepSubmit"
type="button">التالي
</button>
</div>

</div>
</div>
</div>
@endif
</div>
