@extends('layouts.admin')

@section('title')
الفئات
@endsection

@section('content')
<div class="page-content">
   <div class="container-fluid">
      <!-- page title -->
      @include('admin.includes.page_title', ['title'=>'لوحة التحكم','supTitle' => 'الفئات'])

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
                           <th>المعرف</th>
                           <th>الاسم</th>
                           <th>اللون</th>
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
                  <label for="name" class="col-sm-3 col-form-label">الاسم</label>
                  <div class="col-sm-9">
                     <input type="text" name="name" class="form-control" id="name">
                  </div>
               </div>
					
               <!-- Color -->
					<div class="form-group row mb-4">
						<label for="color" class="col-sm-3 col-form-label">اللون</label>
						<div class="col-sm-9" id="cp14">
							<input type="text" class="form-control colorpicker-default"name="color" id="color" />
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
   $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

   // Show tabel
   $('#records_table').DataTable({
      processing: true,
      serverSide: true,
      retrieve: true,
      "order": [[ 0, "asc" ]],
      ajax: {
         url: "{{ route('categories.index') }}",
      },
      columns: [
         {
            data: 'id',
            render: function (data, type, full, meta) {
               return `<strong>${data}</strong>`;
            },
         },
         {data: 'name'},
         {data: 'color', orderable: false, searchable: false},
         {data: 'action', orderable: false, searchable: false}
      ]
   });

   // Add Button
   $('#create_record').click(function () {
      $('#action_button').val("إضافة");
      $('#action').val("Add");
      $('#form_result').html('');
      $('#formModal').modal('show');
      $('#sample_form')[0].reset();
   });

   // Edit Button
   $(document).on('click', '.edit', function () {
      var id = $(this).attr('data');
      $.ajax({
         url: "{{ route('categories.index') }}" + '/' + id + '/edit',
         dataType: "json",
         success: function (json) {
            $('#name').val(json.data.name);
            $('#color').val(json.data.color);
            $('#hidden_id').val(json.data.id);
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
         url: "{{ route('categories.store') }}",
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
         url: "{{ route('categories.index') }}" + '/' + record_id,
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
});
</script> 
@endpush

