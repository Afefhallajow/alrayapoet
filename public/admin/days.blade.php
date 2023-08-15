@extends('layouts.admin')

@section('title')
الفعاليات 
@endsection

@section('content')
<div class="page-content">
   <div class="container-fluid">
      <!-- page title -->
      @include('admin.includes.page_title', ['title'=>'الفعاليات','supTitle' => 'الفعاليات'])

      <!-- Content -->
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <button type="button" name="create_record" id="create_record" class="btn btn-success waves-effect waves-light" style="margin-bottom: 15px;">
                     <i class="bx bx-plus font-size-16 align-middle mr-1"></i>
                     إضافة
                  </button>
                  <table id="records_table" class="table dt-responsive nowrap text-center"
                     style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th width="10%">المعرف</th>
                           <th width="20%">الاسم</th>
                           <th width="10%">التاريخ</th>
                           <th width="10%">الوقت</th>
                           <th width="30%">الوصف</th>
                           <th width="10%">مكان الفعالية</th>
                           <th width="10%">عدد الدعوات المرسلة</th>
                           <th width="10%">عدد الدعوات العامة</th>
                           <th width="10%">عدد الدعوات المرسلة</th>
                           <th width="10%">عدد الدعوات العامة</th>
                           <th width="10%"></th>
                        </tr>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Modal: Add | Edit -->
<div id="formModal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="max-width: 45%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <span id="form_result"></span>
            <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">

               <!-- name -->
					<div class="form-group row mb-3">
						<label for="name" class="col-sm-3 col-form-label">الاسم (*)</label>
						<div class="col-sm-9">
							<input type="text" name="name" class="form-control" id="name">
						</div>
					</div>
				<!-- en name -->
				<div class="form-group row mb-3">
					<label for="name" class="col-sm-3 col-form-label">الاسم الأجنبي (*)</label>
					<div class="col-sm-9">
						<input type="text" name="name_en" class="form-control" id="name_en">
					</div>
				</div>
				<!-- en name -->
				<div class="form-group row mb-3">
					<label for="name" class="col-sm-3 col-form-label"> الموقع (URL)</label>
					<div class="col-sm-9">
						<input type="text" name="map_url" class="form-control" id="map_url">
					</div>
				</div>
               
					<!-- date -->
               <div class="form-group row mb-3">
                  <label for="date" class="col-sm-3 col-form-label">التاريخ (*)</label>
                  <div class="col-sm-9">
                     <input type="date" name="date" class="form-control" id="date">
                  </div>
               </div>
               
					<!-- time -->
               <div class="form-group row mb-3">
                  <label for="time" class="col-sm-3 col-form-label">الوقت (*)</label>
                  <div class="col-sm-9">
                        <div class="input-group">
                            <input class="form-control" type="time" id="time" name="time">
                        </div>
                  </div>
               </div>

               <!-- description -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label">الوصف (*)</label>
                  <div class="col-sm-9">
                     <input type="text" name="description" class="form-control" id="description">
                  </div>
               </div>
              <!-- en description -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label">الوصف الأجنبي (*)</label>
                  <div class="col-sm-9">
                     <input type="text" name="description_en" class="form-control" id="description_en">
                  </div>
               </div>
                <!-- en description -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label">رابط الواتساب </label>
                  <div class="col-sm-9">
                     <input type="text" name="whats_social" class="form-control" id="whats_social">
                  </div>
               </div>
               <!-- en description -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label">رابط التلغرام </label>
                  <div class="col-sm-9">
                     <input type="text" name="telegram_social" class="form-control" id="telegram_social">
                  </div>
               </div>
               <!-- en description -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label">رابط الجيميل </label>
                  <div class="col-sm-9">
                     <input type="text" name="gmail_social" class="form-control" id="gmail_social">
                  </div>
               </div>
               <!-- en description -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label">رابط الإيميل </label>
                  <div class="col-sm-9">
                     <input type="text" name="mail_social" class="form-control" id="mail_social">
                  </div>
               </div>
              <!-- Thanks MSF -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label">رسالة الشكر</label>
                  <div class="col-sm-9">
                     <input type="text" name="thanksMSG" class="form-control" id="thanksMSG">
                  </div>
               </div>
                <!-- En Thanks MSF -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label">رسالة الشكر الأجبينة </label>
                  <div class="col-sm-9">
                     <input type="text" name="thanksMSG_en" class="form-control" id="thanksMSG_en">
                  </div>
               </div>

               <!-- place -->
               <div class="form-group row mb-3">
                  <label for="place_id" class="col-sm-3 col-form-label">مكان الفعالية (*)</label>
                  <div class="col-sm-9">
                     <select name="place_id" class="form-control" id="place_id">
                        @foreach ($places as $place)
                           <option value="{{$place->id}}"> {{$place->name}} </option>
                        @endforeach
                     </select>
                  </div>
               </div>
                 <!-- Image -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label"> الصورة التي تظهر عند التسجيل (*)</label>
                  <div class="col-sm-9">
                     <input type="file" name="image" class="form-control" id="image"><br>
                     <p class="text-muted">يفضل اختيار صورة أبعادها 624*200</p>
                     <span id="store_image"></span>
                  </div>
               </div>

                <!-- BG Image -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label"> الصورة الخاصة بالطباعة (*) </label>
                  <div class="col-sm-9">
                     <input type="file" name="bg_image" class="form-control" id="bg_image"><br>
                     <p class="text-muted">يفضل اختيار صورة أبعادها 916*381</p>
                     <span id="store_bg_image"></span>
                  </div>
                   
               </div>
               <!-- Email Image -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label"> الصورة الخاصة بالبريد الالكتروني (*) </label>
                  <div class="col-sm-9">
                     <input type="file" name="emailImage" class="form-control" id="emailImage"><br>
                     <p class="text-muted">يفضل اختيار صورة أبعادها 624*200</p>
                     <span id="store_emailImage"></span>
                  </div>
               </div>

               <!-- Footer print Image -->
               <div class="form-group row mb-3">
                  <label for="image_footer_print" class="col-sm-3 col-form-label"> الصورة الخاصة بفوتر الطباعة (*) </label>
                  <div class="col-sm-9">
                     <input type="file" name="image_footer_print" class="form-control" id="image_footer_print"><br>
                     <p class="text-muted">يفضل اختيار صورة أبعادها 1045*326</p>
                     <span id="store_image_footer_print"></span>
                  </div>
               </div>

               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-12 col-form-label">تخصيص الداشبورد</label>
               </div>
               
               <!-- Color -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label"> لون الثيم</label>
                  <div class="col-sm-9">
                     <input id="Color-add" name="color" type="text" class="colorpicker-default form-control colorpicker-element"  data-colorpicker-id="1" data-original-title="" title="">
                  </div>
               </div>

               <!-- Image -->
               <div class="form-group row mb-3">
                  <label for="description" class="col-sm-3 col-form-label"> صورة الخلفية (*)</label>
                  <div class="col-sm-9">
                     <input type="file" name="image_loader" class="form-control" id="image_loader"><br>
                     <p class="text-muted">يفضل اختيار صورة أبعادها 900*700</p>
                     <span id="store_image_loader"></span>
                  </div>
               </div>

               <!-- submit -->
               <div class="form-group row justify-content-end">
                  <div class="col-sm-9">
                     <input type="hidden" name="action" id="action" />
                     <input type="hidden" name="hidden_id" id="hidden_id" />
                     <input type="submit" name="action_button" id="action_button" class="blueColor btn btn-light" value="Add"
                        style="padding:8px 40px;" />
                     <div class="spinner-grow text-secondary m-1 blueColor" role="status" style="display: none">
                        <span class="sr-only">Loading...</span>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<!-- Modal: authentication -->
<div id="authModal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="max-width: 45%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <span class="form_result"></span>
            <form method="post" id="auth_form" class="form-horizontal" enctype="multipart/form-data">

               <!-- name -->
               <div class="form-group row mb-3">
                  <label for="auth_name" class="col-sm-3 col-form-label">الاسم</label>
                  <div class="col-sm-9">
                     <input type="text" name="name" class="form-control" id="auth_name">
                  </div>
               </div>

               <!-- username -->
               <div class="form-group row mb-3">
                  <label for="auth_username" class="col-sm-3 col-form-label">اسم المستخدم</label>
                  <div class="col-sm-9">
                     <input type="text" name="username" class="form-control" id="auth_username">
                  </div>
               </div>

               <!-- email -->
               <div class="form-group row mb-3">
                  <label for="auth_email" class="col-sm-3 col-form-label">البريد الإلكتروني</label>
                  <div class="col-sm-9">
                     <input type="email" name="email" class="form-control" id="auth_email">
                  </div>
               </div>
               
               <!-- password -->
               <div class="form-group row mb-3">
                  <label for="auth_password" class="col-sm-3 col-form-label">كلمة السر</label>
                  <div class="col-sm-9">
                     <input type="password" name="password" class="form-control" id="auth_password">
                  </div>
               </div>

               <!-- password_confirmation -->
               <div class="form-group row mb-3">
                  <label for="auth_password_confirmation" class="col-sm-3 col-form-label">تأكيد كلمة السر</label>
                  <div class="col-sm-9">
                     <input type="password" name="password_confirmation" class="form-control" id="auth_password_confirmation">
                  </div>
               </div>

               <!-- submit -->
               <div class="form-group row justify-content-end">
                  <div class="col-sm-9">
                     <input type="hidden" name="hidden_id" class="hidden_id" />
                     <input type="submit" name="action_button" class="action_button blueColor btn btn-light" value="حفظ" style="padding:8px 40px;" />
                     <div class="action_spinner spinner-grow text-secondary m-1 blueColor" role="status" style="display: none">
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

<!-- Modal: For Update Images -->
<div id="updateImagesModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title mrAuto" align="center">تعديل الصور الخاصة بالفعالية </h4>
         </div>
         <form action="#" method="post" id="updateDayImage">
         <div class="modal-body">
             <input type="hidden" id="day_img_id" name="day_id"/>
            <label>نوع الصورة</label>
            <select class="form-control" name="img_type">
                <option value="1">
                    الصورة التي تظهر عند التسجيل
                </option>
                <option value="2">
                    الصورة الخاصة بالطباعة
                </option>
                <option value="3">
                    الصورة الخاصة بالبريد الالكتروني
                </option>
                <option value="4">صورة الخلفية</option>
                <option value="5">صورة فوتر الطباعة</option>
            </select>
            <label>الصورة</label>
            <input type="file" class="form-control" name="newImage" required/>
         </div>
         <div class="modal-footer">
            <button type="submit" name="ok_button" id="ok_button" class="btn btn-primary mrAR">حفظ</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">إلغاء</button>
         </div>
         </form>
      </div>
   </div>
</div>
@endsection

@push('AJAX')

<script type="text/javascript">
$(document).ready(function () {
   $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

   // Show tabel
   $('#records_table').DataTable({
      processing: true,
      serverSide: true,
      retrieve: true,
      "order": [[ 0, "asc" ]],
      ajax: {
         url: "{{ route('days.index') }}",
      },
      columns: [
         {
            data: 'id',
            render: function (data, type, full, meta) {
               return `<strong>${data}</strong>`;
            },
         },
         {data: 'name'},
         {data: 'date'},
         {data: 'time'},
         {data: 'description'},
         {data: 'place'},
         {data: 'sent_invit_details'},
         {data: 'general_invit_details'},
         {data: 'sent_invit'},
         {data: 'general_invit'},
         {data: 'action', orderable: false, searchable: false}
      ],
      columnDefs: [
        { responsivePriority: 1, targets: 8 },
        { responsivePriority: 2, targets: 9 },
        ]
   });

   // Add Button
   $('#create_record').click(function () {
      $('#action_button').val("إضافة");
      $('#action').val("Add");
      $('#form_result').html('');
      $('#formModal').modal('show');
      $('#sample_form')[0].reset();

      emptyStoredImg()
   });

   // click on authentication buttom 
   $(document).on('click', '.auth', function () {
      var day_id_auth = $(this).attr('data');

      var authModal = $('#authModal');
      authModal.find('.form_result').html('');
      $('#auth_form')[0].reset();

      authModal.find('.hidden_id').val(day_id_auth);

      var url_auth= "{{ route('get_day_auth',[':day_id']) }}";
      url_auth = url_auth.replace(':day_id', day_id_auth);

      $.ajax({
         url: url_auth,
         dataType: "json",
         success: function (json) {
            $.each(json.success, function(index, element){
               $('#auth_' + index).val(element)
            })
            authModal.modal('show');
         }
      })
   });

   // Submit Auth Form
   $('#auth_form').on('submit', function (event) {
      event.preventDefault();
      var authModal = $('#authModal');
      
      $.ajax({
         url: "{{ route('post_day_auth') }}",
         beforeSend: function () {
            authModal.find('.action_button').hide();
            authModal.find('.spinner-grow').show();
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
               setTimeout(function(){authModal.modal('hide');}, 1000); 
            }
            authModal.find('.form_result').html(html);
            authModal.find('.action_button').show();
            authModal.find('.spinner-grow').hide();
         }
      });
   });

   // Edit Button
   $(document).on('click', '.edit', function () {
      $('#sample_form')[0].reset();
      emptyStoredImg()

      var id = $(this).attr('data');
      $.ajax({
         url: "{{ route('days.index') }}" + '/' + id + '/edit',
         dataType: "json",
         success: function (json) {
            $('#name').val(json.data.name);
            $('#name_en').val(json.data.name_en);
            $('#map_url').val(json.data.map_url);
            $('#date').val(json.data.date);
            $('#time').val(json.data.time);
            $('#description').val(json.data.description);
            $('#description_en').val(json.data.description_en);
            $('#whats_social').val(json.data.whats_social);
            $('#gmail_social').val(json.data.gmail_social);
            $('#telegram_social').val(json.data.telegram_social);
            $('#mail_social').val(json.data.mail_social);
            $('#thanksMSG').val(json.data.thanksMSG);
            $('#thanksMSG_en').val(json.data.thanksMSG_en);
            $('#place_id').val(json.data.place_id);
            $('#Color-add').val(json.data.color);
            $('#hidden_id').val(json.data.id);

            if(json.data.image != null){
               $('#store_image').html(`<img src="images/${json.data.image}" width='80' class='img-thumbnail' />`);
            }else{
               $('#store_image').html("");
            }
            
            if(json.data.bg_image != null){
               $('#store_bg_image').html(`<img src="images/${json.data.bg_image}" width='80' class='img-thumbnail' />`);
            }else{
               $('#store_bg_image').html("");
            }
            
            if(json.data.emailImage != null){
               $('#store_emailImage').html(`<img src="images/${json.data.emailImage}" width='80' class='img-thumbnail' />`);
            }else{
               $('#store_emailImage').html("");
            }

            if(json.data.image_loader != null){
               $('#store_image_loader').html(`<img src="images/${json.data.image_loader}" width='80' class='img-thumbnail' />`);
            }else{
               $('#store_image_loader').html("");
            }

            if(json.data.image_footer_print != null){
               $('#store_image_footer_print').html(`<img src="images/${json.data.image_footer_print}" width='80' class='img-thumbnail' />`);
            }else{
               $('#store_image_footer_print').html("");
            }
         }
      })
      $('#action').val("Edit");
      $('#action_button').val("تعديل");
      $('#form_result').html('');
      $('#formModal').modal('show');
   });

   // Submit Form
   $('#sample_form').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
         url: "{{ route('days.store') }}",
         beforeSend: function () {
            $('#action_button').hide();
            $('.spinner-grow').show();
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
            $('#form_result').html(html);
            $('#action_button').show();
            $('.spinner-grow').hide();
         },
         error: function(jqXHR, textStatus, errorThrown){
            $('#form_result').html(errorThrown);
            $('#action_button').show();
            $('.spinner-grow').hide();
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
         url: "{{ route('days.index') }}" + '/' + record_id,
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
   
     // Submit Update Images Form
   $('#updateDayImage').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
         url: "{{ route('changeImagesOfDay') }}",
         beforeSend: function () {
            $('#action_button').hide();
            $('.spinner-grow').show();
         },
         method: "POST",
         data: new FormData(this),
         contentType: false,
         cache: false,
         processData: false,
         dataType: "json",
         success: function (data) {
            $('#updateImagesModal').modal('hide');
            $('#updateDayImage input').val('');
            $('#action_button').show();
            $('.spinner-grow').hide();
         }
      });
   });
   
});
</script> 
<script>

   function updateImages(id){
      document.getElementById('day_img_id').value = id;
      $('#updateImagesModal').modal('show');
   }

   function emptyStoredImg(){
      $('#store_image').html("");
      $('#store_bg_image').html("");
      $('#store_emailImage').html("");
      $('#store_image_loader').html("");
   }
</script>
@endpush
