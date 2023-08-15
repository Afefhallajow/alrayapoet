@extends('layouts.admin')

@section('title')
جميع الدعوات
@endsection

@section('content')
<div class="page-content">
   <div class="">
      <!-- page title -->
      @include('admin.includes.page_title', ['title'=>'الفعالية','supTitle' => 'جميع الدعوات'])

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

								<!-- chair_categories -->
                        <div class="col-sm-3 col-lg-3">
                           <label for="filter_chair_category"  class="col-form-label">فئة الكرسي</label>
                           <select name="chair_category" class="form-control" id="filter_chair_category">
                              <option value="">الكل</option>
                              @foreach ($chair_categories as $chair_category)
                                 <option value="{{$chair_category->id}}"> {{$chair_category->name}} </option>
                              @endforeach
                           </select>
                        </div>

								<!-- invitation_type -->
                        <div class="col-sm-3 col-lg-3">
                           <label for="filter_invitation_type" class="col-form-label">نوع الدعوة</label>
                           <select name="invitation_type" class="form-control" id="filter_invitation_type">
                              <option value="">الكل</option>
                              <option value="registered">تسجيل</option>
                              <option value="invited">دعوة</option>
                           </select>
                        </div>

                        <!-- mobile -->
                        <div class="col-sm-3 col-lg-3">
                           <label for="filter_mobile" class="col-form-label">رقم الجوال</label>
                           <input type="text" name="mobile" class="form-control" id="filter_mobile">
                        </div>

                        <!-- category -->
                        <div class="col-sm-3 col-lg-3">
                           <label for="filter_category_id" class="col-form-label">الفئة</label>
                           <select name="category_id" class="form-control" id="filter_category_id">
                              <option value="">الكل</option>
                              @foreach ($categories as $category)
                                 <option value="{{$category->id}}"> {{$category->name}} </option>
                              @endforeach
                           </select>
                        </div>

                        <!-- source -->
                        <div class="col-sm-3 col-lg-3">
                           <label for="filter_source" class="col-form-label">داخلي/خارجي</label>
                           <select name="source" class="form-control" id="filter_source">
                              <option value="">الكل</option>
                              <option value="internal">داخلي</option>
                              <option value="external">خارجي</option>
                           </select>
                        </div>

                        <!-- days -->
                        <div class="col-sm-3 col-lg-3">
                           <label for="filter_day_id" class="col-form-label">الفعالية</label>
                           <select name="day_id" class="form-control" id="filter_day_id">
                              <option value="">الكل</option>
                              @foreach ($days as $day)
                                 <option value="{{$day->id}}"> {{$day->name}} </option>
                              @endforeach
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
                           <th>الاسم</th>
                           <th>رقم الجوال</th>
                           <th>البريد الإلكتروني</th>
                           <th>نوع الدعوة</th>
                           <th>رمز المقعد</th>
                           <th>الفئة</th>
                           <th>هل حضر الفعالية</th>
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

<!-- Modal: Edit Chair -->
<div id="editChairModal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="max-width: 45%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body" id="edit_chair">
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

<!-- Modal: Changes History -->
<div id="changesHistoryModel" class="modal fade" role="dialog">
   <div class="modal-dialog" style="max-width: 80%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body" id="changes_history">
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
               <!-- day_id -->
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

               <!-- name | mobile -->
               <div class="form-group row mb-3">
                  <!-- name -->
                  <div class="col-sm-6">
                     <label for="name" class="col-form-label">الاسم</label>
                     <input type="text" name="name" class="form-control" id="name">
                  </div>

                  <!-- mobile -->
                  <div class="col-sm-6">
                     <label for="mobile" class="col-form-label">رقم االجوال</label>
                     <input type="text" name="mobile" class="form-control" id="mobile">
                  </div>
               </div>

               <!-- email | organization -->
               <div class="form-group row mb-3">
                  <!-- email -->
                  <div class="col-sm-6">
                     <label for="email" class="col-form-label">البريد الإلكتروني</label>
                     <input type="email" name="email" class="form-control" id="email">
                  </div>

                  <!-- organization -->
                  <div class="col-sm-6">
                     <label for="organization" class="col-form-label">الجهة</label>
                     <input type="text" name="organization" class="form-control" id="organization">
                  </div>
               </div>

               <!-- position -->
               <div class="form-group row mb-3">
                  <!-- position -->
                  <div class="col-sm-6">
                     <label for="position" class="col-sm-3 col-form-label">المنصب</label>
                     <input type="text" name="position" class="form-control" id="position">
                  </div>
               </div>

               <!-- category | send_email -->
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

                  <!-- send_email -->
                  <div class="col-sm-6">
                     <label for="send_email" class="col-form-label">إرسال بريد مع تغيير حالة الطلب</label>
                     <div class="custome_blue_radio">
                        <fieldset class="radio btn-radio btn-group" data-toggle="buttons">
                           <label for="send_email_1" id="send_email_for_1" class="for_radio_1 btn-default btn active">
                              <input class="input_radio_1" type="radio" name="send_email" id="send_email_1" value=1 checked="checked">
                              <span>نعم</span>
                           </label>

                           <label for="send_email_0" id="send_email_for_0" class="btn-default btn">
                              <input type="radio" name="send_email" id="send_email_0" value=0>
                              <span>لا</span>
                           </label>
                        </fieldset>
                     </div>
                  </div>
               </div>

               <!-- attendance_party | order_status -->
               <div class="form-group row mb-3">
                  <!-- attendance_party -->
                  <div class="col-sm-6">
                     <label for="attendance_party" class="col-form-label">هل حضر الفعالية</label>
                     <div class="custome_blue_radio">
                        <fieldset class="radio btn-radio btn-group" data-toggle="buttons">
                           <label for="attendance_party_1" id="attendance_party_for_1" class="for_radio_1 btn-default btn active">
                              <input type="radio" class="input_radio_1" name="attendance_party" id="attendance_party_1" value=1 checked="checked">
                              <span>نعم</span>
                           </label>

                           <label for="attendance_party_0" id="attendance_party_for_0" class="btn-default btn">
                              <input type="radio" name="attendance_party" id="attendance_party_0" value=0>
                              <span>لا</span>
                           </label>
                        </fieldset>
                     </div>
                  </div>

                  <!-- order_status -->
                  <div class="col-sm-6">
                     <label for="order_status" class="col-form-label">حالة الطلب</label>
                     <select name="order_status" class="form-control" id="order_status">
                        <option value="">الرجاء الاختيار</option>
                        <option value="under_study">قيد الدراسة</option>
                        <option value="confirmed">تم التأكيد</option>
                        <option value="apology">تم الاعتذار</option>
                     </select>
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

<!-- Modal: View Chairs Chart -->
<div id="chairChartModal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="max-width: 90%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body" id="content_chairs_chart">
         </div>
      </div>
   </div>
</div>

@endsection

@push('AJAX')

<script type="text/javascript">
$(document).ready(function () {
   $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

   // Show tabel
   load_invitation("{{ route('day_invitations') }}");

   // Add Button
   $('#create_record').click(function () {
      FormReset();

      $('#action_button').val("إضافة");

      $('#formModal').modal('show');
   });

   // View Chairs Chart
   $(document).on('click', '#view_chair_chart', function () {
      var src = $(this).attr('data');
      $('#content_chairs_chart').html(`<img src="${src}" class='img-thumbnail' />`);
      $('#chairChartModal').modal('show');
   });

   // View Changes History
   $(document).on('click', '.changes_history', function () {
      var invited_id = $(this).attr('data');
		var url = "{{ route('changes_history') }}";

		var load_url = "{{ route('changes_history_table', [':id', ':model']) }}";
		load_url = load_url.replace(':id', invited_id);
		load_url = load_url.replace(':model', 'invited_id');

      $.ajax({
         url: url,
         success: function (json) {
				$('#changes_history').html(json);
            load_changes_history(load_url);
         }
      })
      $('#changesHistoryModel').modal('show');
   });

   // Edit Button
   $(document).on('click', '.edit', function () {
      var id = $(this).attr('data');
      $.ajax({
         url: "{{ route('invitations.index') }}" + '/' + id + '/edit',
         dataType: "json",
         success: function (json) {
            $('#name').val(json.data.name);
            $('#mobile').val(json.data.mobile);
            $('#email').val(json.data.email);
            $('#organization').val(json.data.organization);
            $('#position').val(json.data.position);
            $('#second_surname_id').val(json.data.second_surname_id);
            $('#day_id').val(json.data.day_id);
            $('#first_surname_id').val(json.data.first_surname_id);
            $('#category_id').val(json.data.category_id);
            $('#source').val(json.data.source);
            $('#invitation_type').val(json.data.invitation_type);
            $('#order_status').val(json.data.order_status);
            $('#send_email').val(json.data.send_email);
            $('#hidden_id').val(json.data.id);

            $('.custome_blue_radio label').removeClass('active');
            $('#attendance_party_for_' + json.data.attendance_party).addClass('active');
            $('#send_email_for_' + json.data.send_email).addClass('active');

            $('#attendance_party_' + json.data.attendance_party).prop('checked', true);
            $('#send_email_' + json.data.send_email).prop('checked', true);
         }
      })
      $('#action_button').val("تعديل");
      $('#formModal').modal('show');
      ClearAlert();
   });

   // Edit Chair Button
   $(document).on('click', '.edit_chair', function () {
      var id = $(this).attr('data');
		var url = "{{ route('edit_chair', ':id') }}";
		url = url.replace(':id', id);
      $.ajax({
         url: url,
         success: function (json) {
				$('#edit_chair').html(json);
         }
      })
      $('#editChairModal').modal('show');
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
            ClearAlert();
            $('#form_result').html(html);
         },
         error: function(errors){
            ClearAlert();
            errors_list = print_errors(errors.responseJSON.errors);
            // ResultAlert(errors_list);
         }
      });
   });

	// Edit Chair Form
   $(document).on('submit', '#edit_chair_form', function (event) {
      event.preventDefault();
      $.ajax({
         url: "{{ route('edit_chair.store') }}",
         beforeSend: function () {
            $('#action_button_chair').hide();
            $('#action_spinner_chair').show();
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
               $('#edit_chair_form')[0].reset();
               $('#records_table').DataTable().ajax.reload();
               setTimeout(function(){$('#editChairModal').modal('hide');}, 1000);
            }

				ClearAlert();
            $('#form_result_chair').html(html);
         },
         error: function(errors){
            ClearAlert();
            errors_list = print_errors(errors.responseJSON.errors);
            // ResultAlert(errors_list);
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
      var category_id = $('#filter_category_id').val();
      var source = $('#filter_source').val();
      var invitation_type = $('#filter_invitation_type').val();
      var chair_category_id = $('#filter_chair_category').val();
      var day_id = $('#filter_day_id').val();

      var url= "{{ route('day_invitations') }}";
      var params = `name=${name}&email=${email}&mobile=${mobile}&category_id=${category_id}&source=${source}&invitation_type=${invitation_type}&chair_category_id=${chair_category_id}&day_id=${day_id}`;
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
            {data: 'name'},
            {data: 'mobile'},
            {data: 'email'},
            {data: 'invitation_type'},
            {data: 'chair_code'},
            {data: 'category'},
            {data: 'attendance_party'},
            {data: 'action', orderable: false, searchable: false}
         ]
      });
   }

   function load_changes_history(url) {
      $('#changes_history_table').DataTable({
         processing: true,
         serverSide: true,
         retrieve: true,
         "order": [[ 0, "asc" ]],
         ajax: {
            url: url,
         },
         columns: [
            {data: 'created_at'},
            {data: 'chair'},
            {data: 'invited'},
            {data: 'user'},
         ]
      });
   }
});
</script>
@endpush

