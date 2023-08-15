<form method="post" id="edit_chair_form" class="form-horizontal" enctype="multipart/form-data">
	<span id="form_result_chair"></span>

	@csrf

    <div class="form-group row mb-3">
		<!-- code -->
		<div class="col-sm-8">
			<label for="chair_id" class="col-form-label">رمز الكرسي</label>
			{{$chair->code}}
		</div>
	</div>

	<div class="form-group row mb-3">
		<!-- category -->
		<div class="col-sm-8">
			<label for="invited_id" class="col-form-label">المدعو</label>
			<select name="invited_id" class="form-control" id="invited_id">
				<option value="">الرجاء الاختيار</option>
				@foreach ($inviteds as $invited)
					<option value="{{$invited->id}}"> {{$invited->name}} </option>
				@endforeach
			</select>
		</div>
	</div>

    <div class="form-group row mb-3">
		<!-- chair_category -->
		<div class="col-sm-8">
			<label for="chair_id" class="col-form-label">فئة الكرسي</label>
			{{$chair->chair_category->name}}
		</div>
	</div>

	<!-- submit -->
	<div class="form-group row justify-content-end">
		<div class="col-sm-6">
			<input type="hidden" name="chair_id" id="chair_id" value="{{ $chair->id }}"/>
			<input type="submit" name="action_button_chair" id="action_button_chair" class="blueColor btn btn-light" value="حفظ"
				style="padding:8px 40px;" />
			<div id="action_spinner_chair" class="spinner-grow text-secondary m-1 blueColor" role="status" style="display: none">
				<span class="sr-only">Loading...</span>
			</div>
		</div>

		<div class="col-sm-6">
			<input type="button" data="{{$chairs_image}}" id="view_chair_chart" class="view_chair_chart btn btn-light" value="مخطط الكراسي"
				style="padding:8px 40px;" />
			<div id="spinner_view_chair_chart" class="spinner-grow text-secondary m-1 blueColor" role="status" style="display: none">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
	</div>
</form>