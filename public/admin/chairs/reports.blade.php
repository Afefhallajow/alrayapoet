@extends('layouts.admin')

@section('title')
تقارير الكراسي 
@endsection

@section('content')
<div class="page-content">
   <div class="">
      <!-- page title -->
      @include('admin.includes.page_title', ['title'=>'الفعالية','supTitle' => 'تقارير الكراسي'])

      <!-- choose day -->
		<div class="row" style="display: flex; justify-content:center; margin-bottom: 30px">
			<div class="col-lg-4 text-center mrAuto">

            @if($days)
               <form>
                  <input type="hidden" id="selected_id" name="selected_id" value="{{$day_id}}">
                  <form>
                     <select class="form-control mRL" name="select_day" id="select_day">
                        <option value="">اختر يوم حفل</option>
                        @foreach($days as $day)
                        <option value="{{$day->id}}" <?php echo $day->id == $day_id? 'selected' : '' ?>>
                           {{$day->name}}</option>
                        @endforeach
                     </select>
                  </form>
               </form>
            @endif
         </div>
      </div>

		<div class="row mrB20">
         <!-- invitation_type -->
			<div class="col-lg-6 text-center mrAuto">
				<div class="card">
					<div class="card-body" style="padding-bottom: 40px">
						<h4 class="card-title mb-4" style="float: left">نوع الدعوة</h4>
						<div id="invitation_type" class="apex-charts" dir="ltr"></div>
					</div>
				</div>
			</div>

         <!-- attendance_party -->
			<div class="col-lg-6 text-center mrAuto">
				<div class="card">
					<div class="card-body" style="padding-bottom: 40px">
						<h4 class="card-title mb-4" style="float: left">لم يحضر الفعالية وعنده كرسي</h4>
						<div id="attendance_party" class="apex-charts" dir="ltr"></div>
					</div>
				</div>
			</div>
		</div>

      <!-- chairs_categories -->
      @foreach($chairs_categories as $key => $chair_cat)
         @php $cat_name = array_keys($chair_cat); @endphp
         <!-- open row -->
         @if($key %2 == 0)
            <div class="row mrB20">
         @endif

			<div class="col-lg-6 text-center mrAuto">
				<div class="card">
					<div class="card-body" style="padding-bottom: 40px">
                  
						<h4 class="card-title mb-4" style="float: left">{{ $cat_name[0] }} كراسي  </h4>
						<div id="cat_{{$key}}" class="apex-charts" dir="ltr"></div>
					</div>
				</div>
			</div>

         <!-- close row -->
         @if($key %2 == 1)
            </div >
         @endif
         
         <!-- close row -->
         @if($key == count($chairs_categories)-1 && $key %2 == 0)
            </div >
         @endif
      @endforeach
   </div>
</div>
@endsection


@push('AJAX')
<!-- apexcharts -->
<script src="{{ asset('admin') }}/libs/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('admin') }}/js/pages/dashboard.init.js"></script>
<script src="{{ asset('admin') }}/libs/echarts/echarts.min.js"></script>
<script src="{{ asset('admin') }}/js/pages/echarts.init.js"></script>

<script type="text/javascript">
$(document).ready(function () {
   $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
   
   // on change in day name
   $(document).on('change', '#select_day', function() {
      var day_id = $(this).val();
      var url= "{{ route('report_chairs',':day_id') }}";
      url = url.replace(':day_id', day_id);
      window.location.href = url;
   });

   //------------ invitation_type ------------
   var invitation_type = {!! json_encode($invitation_type) !!},
   options_type = {
      chart: {
         height: 250,
         type: "pie"
      },
      series: invitation_type,
      labels: ["دعوة", "تسجيل"],
      colors: ["#93268f", "#50a5f1"],
      legend: {
         show: !0,
         position: "right",
         horizontalAlign: "center",
         verticalAlign: "middle",
         floating: !1,
         fontSize: "14px",
         offsetX: 0,
         offsetY: 0
      },
      responsive: [{
         breakpoint: 600,
         options: {
            chart: {
               height: 240
            },
            legend: {
               show: !1
            }
         }
      }]
   },
   type_chart = new ApexCharts(document.querySelector("#invitation_type"), options_type);
   type_chart.render();

   //------------ attendance_party ------------
   var attendance_party = {!! json_encode($attendance_party) !!},
   options_party = {
      chart: {
         height: 250,
         type: "pie"
      },
      series: attendance_party,
      labels: ["دعوة", "تسجيل"],
      colors: ["#f46a6a", "#556ee6"],
      legend: {
         show: !0,
         position: "right",
         horizontalAlign: "center",
         verticalAlign: "middle",
         floating: !1,
         fontSize: "14px",
         offsetX: 0,
         offsetY: 0
      },
      responsive: [{
         breakpoint: 600,
         options: {
            chart: {
               height: 240
            },
            legend: {
               show: !1
            }
         }
      }]
   },
   party_chart = new ApexCharts(document.querySelector("#attendance_party"), options_party);
   party_chart.render();

   //------------ chairs_categories ------------
   var chairs_categories = {!! json_encode($chairs_categories) !!};
   for (let index = 0; index < chairs_categories.length; index++) {
      var element = chairs_categories[index];
      var data = Object.values(element)[0];

      var options_chair_cat = {
         chart: {
            height: 250,
            type: "pie"
         },
         series: data,
         labels: ["فارغ", "محجوز"],
         colors: ["#ff9900", "#51a767"],
         legend: {
            show: !0,
            position: "right",
            horizontalAlign: "center",
            verticalAlign: "middle",
            floating: !1,
            fontSize: "14px",
            offsetX: 0,
            offsetY: 0
         },
         responsive: [{
            breakpoint: 600,
            options: {
               chart: {
                  height: 240
               },
               legend: {
                  show: !1
               }
            }
         }]
      },
      chair_cat_chart = new ApexCharts(document.querySelector("#cat_" + index), options_chair_cat);
      chair_cat_chart.render();

   }
});

</script>
@endpush
