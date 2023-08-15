@extends('layouts.admin')

@section('title')
لوحة التحكم
@endsection

@section('content')
<div class="page-content">
   <div class="">
      <!-- page title -->
      @include('admin.includes.page_title', ['title'=>'لوحة التحكم'])

      @if($num_days)
         <div class="row" style="margin: 0 auto 20px auto">
            <div class="col-md-12">
               <span>عدد الفعاليات: </span>
               <span>{{ $num_days }}</span>
            </div>
         </div>
      @endif
      
      @if($days)
         <div class="row" style="margin: 0 auto 30px auto">
            <div class="col-md-4 m-auto">
               <select class="form-control" id="change_day">
                  <option value="0">الكل</option>
                  @foreach ($days as $day)
                     <option value="{{ $day->id }}">{{ $day->name }}</option>   
                  @endforeach
               </select>
            </div>
         </div>
      @endif

      <div id="home_charts">
         @include('admin.includes.home_charts')
      </div>
      
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

   //------------ Change Day ------------
   $(document).on('change', '#change_day', function () {
      var day_id = $(this).val();
      var url_loadCharts = "{{ route('home') }}";

      // Before Send
      $('#home_charts').css({'filter': 'blur(8px)'});

      // load filtered results
      $.get(url_loadCharts, {'day_id': day_id}, function( data ) {
         $( "#home_charts" ).html( data );
         $('#home_charts').css({'filter': 'none'});
      });
   });
});
</script>


@include('admin.includes.home_charts_init')

@endpush