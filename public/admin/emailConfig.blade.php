@extends('layouts.admin')

@section('title')
إعدادات الإيميل
@endsection

@section('content')
<div class="page-content">
   <div class="container-fluid">
      <!-- page title -->
      @include('admin.includes.page_title', ['title'=>'الفعاليات','supTitle' => 'إعدادات الإيميل'])
      <h4>{{ $day->name }}</h4>
      <!-- Content -->
      <form action="{{ url()->current() }}" method="post">
          @csrf
          <label>نوع الإيميل</label>
          <select name="emailType" class="form-control">
              <option value="1">تأكيد</option>
              <option value="2">دعوة شخصية</option>
              <option value="3">قيد الدراسة</option>
              <option value="4">اعتذار</option>
          </select>
          <br>
          <label>عنوان الإيميل</label>
          <input type="text" class="form-control" name="subject" id="subject" value="{{ $config->confirm_subject }}"/>
          <label>عنوان الإيميل الأجنبي</label>
          <input type="text" class="form-control" name="subjectEn" id="subjectEn" value="{{ $config->confirm_subject_en }}"/>
          <label>محتوى الإيميل</label>
          <textarea name="content">{!! $config->confirm_content !!}</textarea>
          <!--<input type="text" class="form-control" name="content" id="content" value="{{ $config->confirm_content }}"/>-->
          <label>محتوى الإيميل الأجنبي</label>
          <textarea name="contentEn">{!! $config->confirm_content_en !!}</textarea>
          <!--<input type="text" class="form-control" name="contentEn" id="contentEn" value="{{ $config->confirm_content_en }}" /><br>--><br>
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