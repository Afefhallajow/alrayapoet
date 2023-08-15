@extends('layouts.admin')

@section('title')
الكراسي
@endsection

@section('content')
<div class="page-content">
   <div class="container-fluid">
      <!-- page title -->
      @include('admin.includes.page_title', ['title'=>'الفعاليات','supTitle' => 'الكراسي'])

      <div class="row">
         <!-- Generate Chairs -->
         <div class="col-lg-4">
            <div class="card green_back">
               <div class="card-body">
                  <span id="generate_result"></span>

                  <form method="post" id="generate_chairs" class="form-horizontal" enctype="multipart/form-data">

                     <!-- place -->
                     <div class="form-group row mb-3">
                        <label for="place" class="col-sm-3 col-form-label">مكان الفعالية</label>
                        <div class="col-sm-9">
                           <select name="place" class="form-control" id="place">
                              @foreach ($places as $place)
                                 <option value="{{$place->id}}"> {{$place->name}} </option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     
                     <!-- chair category -->
                     <div class="form-group row mb-3">
                        <label for="chair_category" class="col-sm-3 col-form-label">فئة الكرسي</label>
                        <div class="col-sm-9">
                           <select name="chair_category" class="form-control" id="chair_category">
                              @foreach ($chair_categories as $chair_category)
                                 <option value="{{$chair_category->id}}"> {{$chair_category->name}} </option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     
                     <!-- البادئة -->
                     <div class="form-group row mb-3">
                        <label for="letter" class="col-sm-3 col-form-label">البادئة</label>
                        <div class="col-sm-9">
                           <select name="letter" class="form-control" id="letter">
                              @foreach ($letters as $letter)
                                 <option value="{{$letter}}"> {{$letter}} </option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <!-- رقم البداية -->
                     <div class="form-group row mb-3">
                        <label for="start" class="col-sm-3 col-form-label">رقم البداية</label>
                        <div class="col-sm-9">
                           <input min=1 type="number" name="start" class="form-control" id="start">
                        </div>
                     </div>

                     <!-- عدد الكراسي -->
                     <div class="form-group row mb-3">
                        <label for="number" class="col-sm-3 col-form-label">عدد الكراسي</label>
                        <div class="col-sm-9">
                           <input min=1 type="number" name="number" class="form-control" id="number">
                        </div>
                     </div>
      
                     <!-- submit -->
                     <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                           <input type="submit" name="action_button" id="generate_button" class="btn btn-success" value="توليد كراسي"
                              style="padding:8px 40px;" />
                           <div id="generate_spinner" class="spinner-grow text-success m-1" role="status" style="display: none">
                              <span class="sr-only">Loading...</span>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>

         <!-- Contents Table -->
         <div class="col-lg-8">
            <div class="card">
               <div class="card-body">
                  <table id="records_table" class="table dt-responsive nowrap text-center"
                     style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>المعرف</th>
                           <th>الرمز</th>
                           <th>الفئة</th>
                           <th>مكان الفعالية</th>
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
                  <label for="code" class="col-sm-3 col-form-label">الرمز</label>
                  <div class="col-sm-9">
                     <input type="text" name="code" class="form-control" id="edit_code">
                  </div>
               </div>

               <!-- place -->
               <div class="form-group row mb-3">
                  <label for="place" class="col-sm-3 col-form-label">مكان الفعالية</label>
                  <div class="col-sm-9">
                     <select name="place" class="form-control" id="edit_place">
                        @foreach ($places as $place)
                           <option value="{{$place->id}}"> {{$place->name}} </option>
                        @endforeach
                     </select>
                  </div>
               </div>
               
               <!-- chair category -->
               <div class="form-group row mb-3">
                  <label for="chair_category" class="col-sm-3 col-form-label">فئة الكرسي</label>
                  <div class="col-sm-9">
                     <select name="chair_category" class="form-control" id="edit_chair_category">
                        @foreach ($chair_categories as $chair_category)
                           <option value="{{$chair_category->id}}"> {{$chair_category->name}} </option>
                        @endforeach
                     </select>
                  </div>
               </div>
               

               <div id="chart_seats_data">
                  <div class="form-group row mb-3">
                     <label for="code" class="col-sm-3 col-form-label">رقم الصف</label>
                     <div class="col-sm-9">
                        <input type="text" name="row_count" class="form-control" id="edit_row_count">
                     </div>
                  </div>
                  
                  <div class="form-group row mb-3">
                     <label for="code" class="col-sm-3 col-form-label">رقم العمود</label>
                     <div class="col-sm-9">
                        <input type="text" name="column_column" class="form-control" id="edit_column_column">
                     </div>
                  </div>
               </div>

               <!-- submit -->
               <div class="form-group row justify-content-end">
                  <div class="col-sm-9">
                     <input type="hidden" name="hidden_id" id="hidden_id" />
                     <input type="submit" name="action_button" id="action_button" class="blueColor btn btn-light" value="تعديل"
                        style="padding:8px 40px;" />
                     <div id="spinner_grow" class="spinner-grow text-secondary m-1 blueColor" role="status" style="display: none">
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

   var chairs = [];

   // Show tabel
   $('#records_table').DataTable({
      processing: true,
      serverSide: true,
      retrieve: true,
      "order": [[ 0, "asc" ]],
      ajax: {
         url: "{{ route('chairs.index') }}",
      },
      columns: [
         {
            data: 'id',
            render: function (data, type, full, meta) {
               return `<strong>${data}</strong>`;
            },
         },
         {data: 'code'},
         {data: 'chair_category'},
         {data: 'place'},
         {data: 'action', orderable: false, searchable: false}
      ]
   });

   // Edit Button
   $(document).on('click', '.edit', function () {
      var id = $(this).attr('data');
      $.ajax({
         url: "{{ route('chairs.index') }}" + '/' + id + '/edit',
         dataType: "json",
         success: function (json) {
            $('#edit_code').val(json.data.code);
            $('#edit_chair_category').val(json.data.chair_category_id);
            $('#edit_place').val(json.data.place_id);
            
            chairs = json.chairs;

            var table_count = json.data.table_count ? json.data.table_count : 1;
            var chair_count = json.data.chair_count ? json.data.chair_count : 1;

            var row_count = json.data.row_count ? json.data.row_count : 1;
            var column_column = json.data.column_column ? json.data.column_column : 1;
            
            if(json.chart_seats == 'circle') {
               seats_circle();
               $('#table_count').val(table_count);
               $('#chair_count').val(chair_count);

               $('#table_count').attr('max', json.tables);
               $('#chair_count').attr('max', json.chairs[table_count]);
            }
            if(json.chart_seats == 'square'){
               seats_square();
               $('#edit_row_count').val(row_count);
               $('#edit_column_column').val(column_column);
               
               $('#edit_row_count').attr('max', json.rows);
               $('#edit_column_column').attr('max', json.columns);
            } 
            
            $('#hidden_id').val(json.data.id);
         }
      })
      $('#form_result').html('');
      $('#formModal').modal('show');
   }); 

   // Submit Form
   $('#sample_form').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
         url: "{{ route('chairs.store') }}",
         beforeSend: function () {
            $('#action_button').hide();
            $('#spinner_grow').show();
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
            $('#spinner_grow').hide();
            $('#action_button').show();
         }
      });
   });

   // Submit Generate Chairs Form
   $('#generate_chairs').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
         url: "{{ route('chairs.generate') }}",
         beforeSend: function () {
            $('#generate_button').hide();
            $('#generate_spinner').show();
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
               $('#generate_chairs')[0].reset();
               $('#records_table').DataTable().ajax.reload();
               setTimeout(function(){$('#generate_result').html('');}, 4000); 
            }

            $('#generate_result').html(html);
            $('#generate_button').show();
            $('#generate_spinner').hide();
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
         url: "{{ route('chairs.index') }}" + '/' + record_id,
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

   // change number of table
   $(document).on("input",'#table_count' ,function() {
      $('#chair_count').attr('max', chairs[$(this).val()]);
      $('#chair_count').val(1);
   });

});


function seats_square(){
   var square_chart = `
      <div class="form-group row mb-3">
         <label for="code" class="col-sm-3 col-form-label"></label>
         <div class="col-sm-9">
            <span class="text-muted font-size-14">خطة التجليس لمكان الفعالية: صفوف وأعمدة</span>
         </div>
      </div>

      <div class="form-group row mb-3">
         <label for="code" class="col-sm-3 col-form-label">رقم الصف</label>
         <div class="col-sm-9">
            <input type="number" name="row_count" class="form-control" id="edit_row_count"  min=1  value=1 required>
         </div>
      </div>
      <div class="form-group row mb-3">
         <label for="code" class="col-sm-3 col-form-label">رقم العمود</label>
         <div class="col-sm-9">
            <input type="number" name="column_column" class="form-control" id="edit_column_column"  min=1  value=1 required>
         </div>
      </div>
   `;

   $('#chart_seats_data').html(square_chart);
}

function seats_circle(){
   var circle_chart = `
      <div class="form-group row mb-3">
         <label for="code" class="col-sm-3 col-form-label"></label>
         <div class="col-sm-9">
            <span class="text-muted font-size-14">خطة التجليس لمكان الفعالية: دائرية</span>
         </div>
      </div>رس

      <div class="form-group row mb-3">
         <label for="name" class="col-sm-3 col-form-label">رقم الطاولة</label>
         <div class="col-sm-9">
            <input type="number" name="table_count" class="form-control" id="table_count" min=1  value=1 required>
         </div>
      </div>

      <div class="form-group row mb-3">
         <label for="name" class="col-sm-3 col-form-label">رقم الكرسي</label>
         <div class="col-sm-9">
            <input type="number" name="chair_count" class="form-control" id="chair_count"   min=1  value=1 required>
         </div>
      </div>
   `;

   $('#chart_seats_data').html(circle_chart);
}

</script> 
@endpush

