@extends('layouts.admin')

@section('title')
إرسال الدعوات
@endsection

@section('content')
<div class="page-content">
   <div class="container-fluid">
      <!-- page title -->
      @include('admin.includes.page_title', ['title'=>'لوحة اتحكم','supTitle' => 'إرسال الدعوات'])

      <!-- Filter | Excel | Add -->
      <div class="row">
         <div class="col-lg-12">
            <form action="{{ route('export.excel') }}" method="post" id="filter_form" class="form-horizontal" enctype="multipart/form-data">
               @csrf
               
               <button type="button" name="create_record" id="create_record" class="btn btn-success blueColor waves-effect waves-light" style="margin-bottom: 15px;">
                  <i class="bx bx-plus font-size-16 align-middle mr-1"></i>
                  إضافة
               </button>
               
               <button type="submit" id="export_excel" class="btn btn-success blueColor waves-effect waves-light" style="margin-bottom: 15px;">
                  <i class="bx bx-upload font-size-16 align-middle mr-1"></i>
                  إكسل
               </button>
               <div class="card">
                  <div class="card-body green_back">
                     
                     <div class="form-group row mb-3">
                        <div class="col-sm-6 col-lg-6">
                           بحث:
                        </div>
                        <div class="col-sm-6 col-lg-6">
                           <span style="cursor: pointer; color: #66c;" id="reset_filter">
                              <i class="fas fa-undo font-size-20 align-middle mr-1"></i>
                              تفريغ حقول التصفية
                           </span>
                        </div>
                     </div>

                     <div class="form-group row mb-3">
                        <!-- name -->
                        <div class="col-sm-3 col-lg-3">
                           <label for="filter_name" class="col-form-label">الاسم</label>
                           <input type="text" name="name" class="form-control" id="filter_name">
                        </div>
                        
                        <!-- email -->
                        <div class="col-sm-3 col-lg-3">
                           <label for="filter_email" class="col-form-label">البريد الإلكتروني</label>
                           <input type="email" name="email" class="form-control" id="filter_email">
                        </div>

                        <!-- mobile -->
                        <div class="col-sm-3 col-lg-3">
                           <label for="filter_mobile" class="col-form-label">رقم الواتساب</label>
                           <input type="text" name="mobile" class="form-control" id="filter_mobile">
                        </div>

                        <!-- attendance_confirm -->
                        <div class="col-sm-3 col-lg-3">
                           <label for="filter_attendance_confirm" class="col-form-label">تأكيد الحضور</label>
                           <select name="attendance_confirm" class="form-control" id="filter_attendance_confirm">
                              <option value="">الكل</option>
                              <option value=0>لا</option>
                              <option value=1>نعم</option>
                           </select>
                        </div>
                     </div>

                     <!-- submit -->
                     <div class="form-group row justify-content-end">
                        <div class="col-sm-12">
                           <input type="button" id="filter_button" class="btn btn-success" value="اذهب" style="padding:8px 40px;" />
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>

      <!-- Content -->
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <table id="records_table" class="table dt-responsive table-bordered table-striped table-hover nowrap text-center"
                     style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>المعرف</th>
                           <th>تاريخ الارسال</th>
                           <th>الاسم</th>
                           <th>رقم الواتس آب</th>
                           <th>البريد الإلكتروني</th>
                           <th>تأكيد الحضور</th>
                           <th></th>
                        </tr>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Modal: View -->
<div id="viewModal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="max-width: 45%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body" id="view_info">
         </div>
      </div>
   </div>
</div>

<!-- Modal: Add | Edit -->
<div id="formModal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="max-width: 60%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <span id="form_result"></span>
            <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
               <input type="hidden" name="invitation_type" id="invitation_type" value="invited">
               <input type="hidden" name="source" id="source" value="internal">
               <input type="hidden" name="sent" id="sent" value=1>
               <input type="hidden" name="order_status" id="order_status" value="waiting">
            
               @if($days)
                  <div class="form-group row mb-3">
                     <div class="col-sm-6">
                        <label for="day_id" class="col-sm-3 col-form-label">الفعالية</label>
                        <select name="day_id" class="form-control" id="day_id">
                           <option value="">الرجاء الاختيار</option>
                           @foreach ($days as $day)
                              <option value="{{$day->id}}"> {{$day->name}} </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               @endif
               <!--<input type="hidden" name="day_id" class="form-control" value="1"/>-->

               <!-- first surname | second surname -->
               <div class="form-group row mb-3">
                  <!-- first surname -->
                  <div class="col-sm-6">
                     <label for="first_surname_id" class="col-form-label">اللقب 1</label>
                     <select name="first_surname_id" class="form-control" id="first_surname_id">
                        <option value="">الرجاء الاختيار</option>
                        @foreach ($first_surnames as $f_surname)
                           <option value="{{$f_surname->id}}"> {{$f_surname->name}} </option>
                        @endforeach
                     </select>
                  </div>
               
                  <!-- second surname -->
                  <div class="col-sm-6">
                     <label for="second_surname_id" class="col-form-label">اللقب 2</label>
                     <select name="second_surname_id" class="form-control" id="second_surname_id">
                        <option value="">الرجاء الاختيار</option>
                        @foreach ($second_surnames as $s_surname)
                           <option value="{{$s_surname->id}}"> {{$s_surname->name}} </option>
                        @endforeach
                     </select>
                  </div>
               </div>
               
               <!-- name | email -->
               <div class="form-group row mb-3">
                  <!-- name -->
                  <div class="col-sm-6">
                     <label for="name" class="col-form-label">الاسم</label>
                     <input type="text" name="name" class="form-control" id="name">
                  </div>

						<!-- email -->
						<div class="col-sm-6">
							<label for="email" class="col-form-label">البريد الإلكتروني</label>
							<input type="email" name="email" class="form-control" id="email">
						</div>
               </div>

               <!-- extra_email | organization -->
               <div class="form-group row mb-3">
						<!-- extra_email -->
                  <div class="col-sm-6">
							<label for="extra_email" class="col-form-label">بريد إلكتروني إضافي</label>
							<input type="email" name="extra_email" class="form-control" id="extra_email">
						</div>
						
						<!-- organization -->
						<div class="col-sm-6">
							<label for="organization" class="col-form-label">الجهة</label>
							<input type="text" name="organization" class="form-control" id="organization">
						</div>
               </div>

               <!-- mobile | position -->
               <div class="form-group row mb-3">
						<!-- mobile -->
						<div class="col-sm-6">
							<label for="mobile" class="col-form-label">رقم الواتساب</label>
							<input type="text" name="mobile" dir="ltr" class="form-control" id="mobile" value="+966">
						</div>
						
						<!-- position -->
						<div class="col-sm-6">
							<label for="position" class="col-sm-3 col-form-label">المنصب</label>
							<input type="text" name="position" class="form-control" id="position">
						</div>
               </div>
					
               <!-- category | invitation_lang -->
               <div class="form-group row mb-3">
                  <!-- category -->
                  <div class="col-sm-6">
                     <label for="category_id" class="col-sm-3 col-form-label">الفئة</label>
                     <select name="category_id" class="form-control" id="category_id">
                        <option value="">الرجاء الاختيار</option>
                        @foreach ($categories as $category)
                           <option value="{{$category->id}}"> {{$category->name}} </option>
                        @endforeach
                     </select>
                  </div>

                  <!-- invitation_lang -->
                  <div class="col-sm-6">
                     <label for="invitation_lang" class="col-form-label">لغة الدعوة</label>
                     <div class="custome_blue_radio">
                        <fieldset class="radio btn-radio btn-group" data-toggle="buttons">
                           <label for="invitation_lang_ar" id="invitation_lang_for_ar" class="for_radio_1 btn-default btn active">
                              <input type="radio" class="input_radio_1" name="invitation_lang" id="invitation_lang_ar" value="ar" checked="checked">
                              <span>عربي</span>
                           </label>
                           
                           <label for="invitation_lang_en" id="invitation_lang_for_en" class="btn-default btn">
                              <input type="radio" name="invitation_lang" id="invitation_lang_en" value="en">
                              <span>إنكليزي</span>
                           </label>
                        </fieldset>
                     </div>
                  </div>
               </div>

               <!-- send_email | whatsapp -->
               <div class="form-group row mb-3">
                  <!-- send_email -->
                  <div class="col-sm-6">
                     <label for="send_email" class="col-form-label">إرسال بريد</label>
                     <div class="custome_blue_radio">
                        <fieldset class="radio btn-radio btn-group" data-toggle="buttons">
                           <label for="send_email_1" id="send_email_for_1" class="for_radio_1 btn-default btn active">
                              <input type="radio" class="input_radio_1" name="send_email" id="send_email_1" value=1 checked="checked">
                              <span>نعم</span>
                           </label>
                           
                           <label for="send_email_0" id="send_email_for_0" class="btn-default btn">
                              <input type="radio" name="send_email" id="send_email_0" value=0>
                              <span>لا</span>
                           </label>
                        </fieldset>
                     </div>
                  </div>

                  <!-- whatsapp -->
                  <div class="col-sm-6">
                     <label for="whatsapp" class="col-form-label">إرسال Whatsapp</label>
                     <div class="custome_blue_radio">
                        <fieldset class="radio btn-radio btn-group" data-toggle="buttons">
                           <label for="whatsapp_1" id="whatsapp_for_1" class="for_radio_1 btn-default btn active">
                              <input type="radio" class="input_radio_1" name="whatsapp" id="whatsapp_1" value=1 checked="checked">
                              <span>نعم</span>
                           </label>
                           
                           <label for="whatsapp_0" id="whatsapp_for_0" class="btn-default btn">
                              <input type="radio" name="whatsapp" id="whatsapp_0" value=0>
                              <span>لا</span>
                           </label>
                        </fieldset>
                     </div>
                  </div>
               </div>

					<!-- attendance_confirm -->
               <div class="form-group row mb-3">
                  <div class="col-sm-6">
                     <label for="attendance_confirm" class="col-form-label">تأكيد الحضور</label>
                     <div class="custome_blue_radio">
                        <fieldset class="radio btn-radio btn-group" data-toggle="buttons">
                           <label for="attendance_confirm_1" id="attendance_confirm_for_1" class="for_radio_1 btn-default btn">
                              <input type="radio" class="input_radio_1" name="attendance_confirm" id="attendance_confirm_1" value=1 >
                              <span>نعم</span>
                           </label>
                           
                           <label for="attendance_confirm_0" id="attendance_confirm_for_0" class="btn-default btn active">
                              <input type="radio" name="attendance_confirm" id="attendance_confirm_0" value=0 checked="checked">
                              <span>لا</span>
                           </label>
                        </fieldset>
                     </div>
                  </div>
					</div>

               <!-- submit -->
               <div class="form-group row justify-content-end">
                  <div class="col-sm-9">
                     <input type="hidden" name="hidden_id" id="hidden_id" />
                     <input type="submit" name="action_button" id="action_button" class="blueColor btn btn-light" value="Add"
                        style="padding:8px 40px;" />
                     <div id="action_spinner" class="spinner-grow text-secondary m-1 blueColor" role="status" style="display: none">
                        <span class="sr-only">Loading...</span>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<!-- Modal: Confirm Delete -->
<div id="confirmModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title mrAuto" align="center">تأكيد الحذف</h4>
         </div>
         <div class="modal-body">
            <h5 align="center" style="margin:0;">هل تريد بالتأكيد حذف البيانات؟</h5>
         </div>
         <div class="modal-footer">
            <button type="button" name="ok_button" id="ok_button" class="btn btn-danger mrAR">نعم</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">إلغاء</button>
         </div>
      </div>
   </div>
</div>
@endsection

@push('AJAX')

<script type="text/javascript">
$(document).ready(function () {
    document.getElementById('mobile').value = '+966';
   $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

   // Show tabel
   load_invitation("{{ route('invitations.sent') }}");

   // Add Button
   $('#create_record').click(function () {
        FormReset();

		$('#action_button').val("إضافة");

		$('#order_status').val('waiting');

		$('#formModal').modal('show');
   });

   // Edit Button
   $(document).on('click', '.edit', function () {
      var id = $(this).attr('data');
      $.ajax({
         url: "{{ route('invitations.index') }}" + '/' + id + '/edit',
         dataType: "json",
         success: function (json) {
            $('#day_id').val(json.data.day_id);
            $('#first_surname_id').val(json.data.first_surname_id);
            $('#second_surname_id').val(json.data.second_surname_id);
            $('#name').val(json.data.name);
            $('#email').val(json.data.email);
            $('#organization').val(json.data.organization);
            $('#extra_email').val(json.data.extra_email);
            $('#mobile').val(json.data.mobile);
            $('#position').val(json.data.position);
            $('#category_id').val(json.data.category_id);
            $('#order_status').val(json.data.order_status);
				
				$('#invitation_type').val(json.data.invitation_type);
            $('#source').val(json.data.source);
            $('#sent').val(json.data.sent);
            $('#hidden_id').val(json.data.id);

            $('.custome_blue_radio label').removeClass('active');
            $('#invitation_lang_for_' + json.data.invitation_lang).addClass('active');
            $('#send_email_for_' + json.data.send_email).addClass('active');
            $('#whatsapp_for_' + json.data.whatsapp).addClass('active');
            $('#attendance_confirm_for_' + json.data.attendance_confirm).addClass('active');

            $('#invitation_lang_' + json.data.invitation_lang).prop('checked', true);
            $('#send_email_' + json.data.send_email).prop('checked', true);
            $('#whatsapp_' + json.data.whatsapp).prop('checked', true);
            $('#attendance_confirm_' + json.data.attendance_confirm).prop('checked', true);
         }
      })
      $('#action_button').val("تعديل");
      $('#formModal').modal('show');
      ClearAlert();
   }); 

   // View Button
   $(document).on('click', '.view', function () {
      var id = $(this).attr('data');
		var url = "{{ route('view_info', ':id') }}";
		url = url.replace(':id', id);
      $.ajax({
         url: url,
         success: function (json) {
				$('#view_info').html(json);
				FormReset();
         }
      })
      $('#viewModal').modal('show');
   }); 

   // Print Button without background
   $(document).on('click', '.print', function () {
      var id = $(this).attr('data');
		var url = "{{ route('print_info', ':id') }}";
		url = url.replace(':id', id);
		// window.location.href = url;
		window.open(url, '_blank');
   }); 

	// Print Button  with background
   $(document).on('click', '.print_back', function () {
      var id = $(this).attr('data');
		var url = "{{ route('print_info', [':id', ':colorful']) }}";
		url = url.replace(':id', id);
		url = url.replace(':colorful', 1);
		window.open(url, '_blank');
   }); 

   // Submit Form
   $('#sample_form').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
         url: "{{ route('invitations.store') }}",
         beforeSend: function () {
            $('#action_button').hide();
            $('#action_spinner').show();
         },
         method: "POST",
         data: new FormData(this),
         contentType: false,
         cache: false,
         processData: false,
         dataType: "json",
         success: function (data) {
            var html = '';
            if (data.errors) {
               html = '<div class="alert alert-danger">';
               for (var count = 0; count < data.errors.length; count++) {
                  html += '<p><i class="bx bx-error font-size-16 align-middle mr-1"></i>' + data.errors[count] + '</p>';
               }
               html += '</div>';
            }
            if (data.success) {
               html = '<div class="alert alert-success"><i class="bx bx-check-double font-size-16 align-middle mr-1"></i>' + data.success +
                  '</div>';
               $('#sample_form')[0].reset();
               $('#records_table').DataTable().ajax.reload();
               setTimeout(function(){$('#formModal').modal('hide');}, 1000); 
            }
            
            if(data.warning){
                 html = '<div class="alert alert-danger">';
                 html += '<p><i class="bx bx-error font-size-16 align-middle mr-1"></i>' + data.warning + '</p>';
                 html += '</div>';
            }
            ClearAlert();
            $('#form_result').html(html);
         },
         error: function(errors){
            ClearAlert();
            errors_list = print_errors(errors.responseJSON.errors);
         }
      });
   });
   
   var record_id;
   // Button Delete
   $(document).on('click', '.delete', function () {
      record_id = $(this).attr('data');
      $('.modal-title').text('حذف: ' + record_id);
      $('#confirmModal').modal('show');
   });
   // Delete Confirmation 
   $('#ok_button').click(function () {
      $.ajax({
         url: "{{ route('invitations.index') }}" + '/' + record_id,
         beforeSend: function () {
            $('#ok_button').text('جاري الحذف');
         },
         method : "DELETE",
         success: function (data) {
            setTimeout(function () {
               $('#confirmModal').modal('hide');
               $('#records_table').DataTable().ajax.reload();
            }, 1000);
            $('#ok_button').text('نعم');
         }
      })
   });

   // Filter Results
   $('#filter_button').on('click', function (event) {
      event.preventDefault();

      var name = $('#filter_name').val();
      var email = $('#filter_email').val();
      var mobile = $('#filter_mobile').val();
      var confirm = $('#filter_attendance_confirm').val();
      
      var url= "{{ route('invitations.sent') }}";
      var params = `name=${name}&email=${email}&mobile=${mobile}&confirm=${confirm}`;
      url = url + "?" + params;

      $('#records_table').DataTable().destroy();
      load_invitation(url);
   });

   // clear filter inputs
   $('#reset_filter').on('click', function () {
      $('#filter_form')[0].reset();
   });
   
   function load_invitation(url) {
      $('#records_table').DataTable({
         processing: true,
         serverSide: true,
         retrieve: true,
         "order": [[ 0, "asc" ]],
         ajax: {
            url: url,
         },
         columns: [
            {
               data: 'id',
               render: function (data, type, full, meta) {
                  return `<strong>${data}</strong>`;
               },
            },
            {data: 'sent_at'},
            {data: 'name'},
            {data: 'mobile'},
            {data: 'email'},
            {data: 'attendance_confirm', orderable: false, searchable: false},
            {data: 'action', orderable: false, searchable: false}
         ]
      });
   }

});
</script> 
@endpush

