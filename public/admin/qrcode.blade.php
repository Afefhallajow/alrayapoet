@extends('layouts.admin')

@section('title')
QR Code
@endsection

@section('content')
<div class="page-content">
   <div class="container-fluid">
      <!-- page title -->
      @include('admin.includes.page_title', ['supTitle'=>'/','title' => 'QR Code'])

      <!-- Content -->
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
						<span id="form_result"></span>

						<!-- qrcode -->
						<label for="qrcode" class="col-sm-3 col-form-label">qrcode</label>
						<div class="row mb-3">
							<div class="col-sm-9">
								<input type="text" name="qrcode" class="form-control" id="qrcode">
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-9">
								<input type="submit" id="action_button" class="blueColor btn btn-light" value="إرسال"
									style="padding:8px 40px;" />
								<div class="spinner-grow text-secondary m-1 blueColor" role="status" style="display: none">
									<span class="sr-only">Loading...</span>
								</div>
							</div>
						</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Modal: invitation info -->
<div id="invitation_info" class="modal fade" role="dialog">
   <div class="modal-dialog" style="max-width: 64%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body" >
         </div>
      </div>
   </div>
</div>
@endsection

@push('AJAX')

<script type="text/javascript">
$(document).ready(function () {
   $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

   // Edit Button
   $(document).on('click', '#action_button', function () {
      var id = $('#qrcode').val();
		var url = "{{ route('print_info2', [':id', ':colorful']) }}";
		url = url.replace(':id', id);
		url = url.replace(':colorful', 1);
		ClearAlert();
		if(id == null || id == ""){
			$('#form_result').html('<div class="alert alert-danger mt-1 alert-validation-msg" role="alert"><div class="alert-body">رمز QR Code مطلوب</div></div>');
		}
		else{
			$.ajax({
				url: url,
				beforeSend: function () {
					$('#action_button').hide();
					$('.spinner-grow').show();
				},
				success: function (result) {
					if(result.errors){
						ClearAlert();
						errors_list = print_errors(['رمز  qrcode غير موجود']);
						var result = ResultAlert(errors_list);
						fadeInResult('#form_result', result);

					}
					else{
						ClearAlert();
						$('#invitation_info .modal-body').html(result);
						// PrintElem();
						$('#invitation_info').modal('show');
					}
				},
				error: function(errors){
					ClearAlert();
					errors_list = print_errors(errors.responseJSON.errors);
					var result = ResultAlert(errors_list);
				}
			});
		}
   }); 
});

</script> 
@endpush

