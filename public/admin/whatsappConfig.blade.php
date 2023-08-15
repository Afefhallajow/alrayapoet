@extends('layouts.admin')

@section('title')
إعدادات رسالة الواتس
@endsection

@section('content')
<div class="page-content">
   <div class="container-fluid">
      <!-- page title -->
      @include('admin.includes.page_title', ['title'=>'الفعاليات','supTitle' => 'إعدادات رسالة الواتس'])
      <h4>{{ $day->name }}</h4><br>
      <!-- Content -->
      <form action="{{ url()->current() }}" method="post">
          @csrf
          <label> السطر الأول من الرسالة</label>
          <input type="text" class="form-control" name="whatsappMSGContent" id="whatsappMSGContent" value="{{ $day->whatsappMSGContent }}"/>
          <label> السطر الثاني من الرسالة</label>
          <input type="text" class="form-control" name="whatsappMSGlink" id="whatsappMSGlink" value="{{ $day->whatsappMSGlink }}"/>
          <label>Instance </label>
          <input type="text" class="form-control" dir="ltr" name="whatsInstance" id="whatsInstance" value="{{ $day->whatsInstance }}"/>
          <label>Token</label>
          <input type="text" class="form-control" dir="ltr" name="whatsToken" id="whatsToken" value="{{ $day->whatsToken }}"/><br>
          <button class="btn btn-primary" type="submit">حفظ</button>
      </form>
        
   </div>
</div>


@endsection

@push('AJAX')
 <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function () {
   $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
   
   $(document).on('change', 'select', function () {
       let id = {{$day->id }};
       let url = "/events/getEmailConfig/"+id
        $.ajax({
         url: url,
         method : "GET",
         success: function (data) {
             
            if($('select').val() == 1){
                document.getElementById('subject').value = data.confirm_subject;
                document.getElementById('subjectEn').value = data.confirm_subject_en;
                CKEDITOR.instances['content'].setData(data.confirm_content);
                CKEDITOR.instances['contentEn'].setData(data.confirm_content_en);
            }
            if($('select').val() == 2){
                document.getElementById('subject').value = data.waiting_subject;
                document.getElementById('subjectEn').value = data.waiting_subject_en;
                CKEDITOR.instances['content'].setData(data.waiting_content);
                CKEDITOR.instances['contentEn'].setData(data.waiting_content_en);
            }
            if($('select').val() == 3){
                document.getElementById('subject').value = data.under_study_subject;
                document.getElementById('subjectEn').value = data.under_study_subject_en;
                CKEDITOR.instances['content'].setData(data.under_study_content);
                CKEDITOR.instances['contentEn'].setData(data.under_study_content_en);
            }
            if($('select').val() == 4){
                document.getElementById('subject').value = data.apology_subject;
                document.getElementById('subjectEn').value = data.apology_subject_en;
                CKEDITOR.instances['content'].setData(data.apology_content);
                CKEDITOR.instances['contentEn'].setData(data.apology_content_en);
            }
         }
        });
   });
   
});
</script>
<script>
    CKEDITOR.replace( 'content' );
    CKEDITOR.replace( 'contentEn' );
</script>
@endpush