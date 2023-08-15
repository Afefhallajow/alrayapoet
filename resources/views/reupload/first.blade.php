<div dir="rtl" >
@if($currentStep == 1)
<div class="row setup-content" id="step-1">

<div class="col-xs-12">
<div class="col-md-12">
<div class="form-row">
<div id="" class="" role="">
<div class="row">

<div style="" class="col-lg-12 mb-3">
<div class="form-group">
<label class="text-label">يرجى تحميل فيديو القصيدة *</label>
<div class="form-file">
<div x-data="{ isUploading: false, progress: 5 }"
x-on:livewire-upload-start="isUploading = true"
x-on:livewire-upload-finish="isUploading = false; progress = 5"
x-on:livewire-upload-error="isUploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress">
<input wire:model="video" accept="video/mp4,video/x-m4v,video/*"
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
<small>يسمح بهذه الصيغ من الفديو :mp4,mov,ogg</small>
@error('video')
<div class="alert alert-danger">{{ $message }}</div> @enderror
@if($videocheck == 1)
<div class="alert alert-danger"> وقت الفيديو بين 60 و120 ثانية</div>
@endif

</div>
</div>



</div>
</div>

</div>

<div class="form-row btn1">


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
