@extends('layouts.admin')

@section('title')
الكراسي الفارغة 
@endsection

@section('content')
<div class="page-content">
   <div class="">
      <!-- page title -->
      @include('admin.includes.page_title', ['title'=>'الفعالية','supTitle' => 'الكراسي الفارغة'])

      <!-- Filter | Excel | Add -->
      <div class="row">
         <div class="col-lg-12">
            <form action="{{ route('export.excel') }}" method="post" id="filter_form" class="form-horizontal" enctype="multipart/form-data">
               @csrf
               {{-- <button type="submit" id="export_excel" class="btn btn-success blueColor waves-effect waves-light" style="margin-bottom: 15px;">
                  <i class="bx bx-upload font-size-16 align-middle mr-1"></i>
                  إكسل
               </button> --}}
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
                           <label for="filter_name" class="col-form-label">المدعو</label>
                           <input type="text" name="name" class="form-control" id="filter_name">
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

                        <!-- days -->
                        @if($days)
                           <div class="col-sm-3 col-lg-3">
                              <label for="filter_day_id" class="col-form-label">الفعالية</label>
                              <select name="day_id" class="form-control" id="filter_day_id" >
                                 <option value="">الكل</option>
                                 @foreach ($days as $day)
                                    <option value="{{$day->id}}"> {{$day->name}} </option>
                                 @endforeach
                              </select>
                           </div>
                        @endif
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
                           <th>رمز الكرسي</th>
                           <th>المدعو</th>
                           <th>فئة الكرسي</th>
                           <th>حالة الكرسي</th>
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
{{-- <div id="editChairModal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="max-width: 45%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body" id="edit_chair">
         </div>
      </div>
   </div>
</div> --}}

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

@endsection

@push('AJAX')

<script type="text/javascript">
$(document).ready(function () {
   $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

   // Show tabel
   load_chairs("{{ route('empty_chairs') }}");

   // View Chairs Chart
   $(document).on('click', '.view_chair_chart', function () {
      var src = $(this).attr('data');
      $('#content_chairs_chart').html(`<img src="${src}" class='img-thumbnail' />`);
      $('#chairChartModal').modal('show');
   }); 

   // View Changes History
   $(document).on('click', '.changes_history', function () {
      var chair_id = $(this).attr('data');
		var url = "{{ route('changes_history') }}";

		var load_url = "{{ route('changes_history_table', [':id', ':model']) }}";
		load_url = load_url.replace(':id', chair_id);
		load_url = load_url.replace(':model', 'chair_id');

      $.ajax({
         url: url,
         success: function (json) {
				$('#changes_history').html(json);
            load_changes_history(load_url);
         }
      })
      $('#changesHistoryModel').modal('show');
   }); 

   // Edit Chair Button
   // $(document).on('click', '.edit_chair', function () {
   //    var id = $(this).attr('data');
	// 	var url = "{{ route('edit_invited', ':id') }}";
	// 	url = url.replace(':id', id);
   //    $.ajax({
   //       url: url,
   //       success: function (json) {
	// 			$('#edit_chair').html(json);
   //       }
   //    })
   //    $('#editChairModal').modal('show');
   // }); 

	// Edit Chair Form
   // $(document).on('submit', '#edit_chair_form', function (event) {
   //    event.preventDefault();
   //    $.ajax({
   //       url: "{{ route('edit_chair.store') }}",
   //       beforeSend: function () {
   //          $('#action_button_chair').hide();
   //          $('#action_spinner_chair').show();
   //       },
   //       method: "POST",
   //       data: new FormData(this),
   //       contentType: false,
   //       cache: false,
   //       processData: false,
   //       dataType: "json",
   //       success: function (data) {
   //          var html = '';
   //          if (data.errors) {
   //             html = '<div class="alert alert-danger">';
   //             for (var count = 0; count < data.errors.length; count++) {
   //                html += '<p><i class="bx bx-error font-size-16 align-middle mr-1"></i>' + data.errors[count] + '</p>';
   //             }
   //             html += '</div>';
   //          }
   //          if (data.success) {
   //             html = '<div class="alert alert-success"><i class="bx bx-check-double font-size-16 align-middle mr-1"></i>' + data.success +
   //                '</div>';
   //             $('#edit_chair_form')[0].reset();
   //             $('#records_table').DataTable().ajax.reload();
   //             setTimeout(function(){$('#editChairModal').modal('hide');}, 1000); 
   //          }

	// 			ClearAlert();
   //          $('#form_result_chair').html(html);
   //       },
   //       error: function(errors){
   //          ClearAlert();
   //          errors_list = print_errors(errors.responseJSON.errors);
   //          // ResultAlert(errors_list);
   //       }
   //    });
   // });
   
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

   // Filter Results
   $('#filter_button').on('click', function (event) {
      event.preventDefault();

      var name = $('#filter_name').val();
      var chair_category_id = $('#filter_chair_category').val();
      var day_id = $('#filter_day_id').val();
      
      var url= "{{ route('empty_chairs') }}";
      var params = `name=${name}&chair_category_id=${chair_category_id}&day_id=${day_id}`;
      url = url + "?" + params;

      $('#records_table').DataTable().destroy();
      load_chairs(url);
   });

   // clear filter inputs
	$('#reset_filter').on('click', function () {
      $('#filter_form')[0].reset();
   });

   function load_chairs(url) {
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
            {data: 'chair_code'},
            {data: 'invited_name'},
            {data: 'chair_category'},
            {data: 'chair_status'},
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

