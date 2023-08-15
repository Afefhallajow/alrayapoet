<!-- charts -->
<div class="col-md-12">
   <div class="row" style="margin: 0 auto 20px auto">
      <span>عدد الدعوات: </span>
      <span>{{ $num_invited }}</span>
   </div>
</div>

<div class="row mrB20">
      <!-- invitation_type -->
   <div class="col-lg-6 text-center mrAuto">
      <div class="card">
         <div class="card-body" style="padding-bottom: 40px">
            <h4 class="card-title mb-4" style="float: left">جميع السجلات</h4>
            <div id="invitation_type" class="apex-charts" dir="ltr"></div>
         </div>
      </div>
   </div>
   
      <!-- invitation_type -->
   <div class="col-lg-6 text-center mrAuto">
      <div class="card" style="height:19.5rem">
         <div class="card-body" style="padding-bottom: 40px">
            <table class="table dt-responsive table-bordered table-striped table-hover nowrap text-center">
               <thead>
                  <tr>
                     <th  class="gray_font bold_font">الاسم</th>
                     <th  class="gray_font bold_font">تحميل إكسل</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="gray_font">دعوة</td>
                     <td>
                        <form action="{{ route('export.excel') }}" method="post" id="invitation_type_invited" class="form-horizontal">
                           @csrf
                           @if($day_id)
                              <input type="hidden" name="day_id" value="{{ $day_id }}">
                           @endif
                           <input type="hidden" name="invitation_type" value="invited">

                           <span class="span_submit" onclick="document.getElementById('invitation_type_invited').submit();">تحميل</span>
                        </form>
                     </td>
                  </tr>

                  <tr>
                     <td  class="gray_font">تسجيل</td>
                     <td>
                        <form action="{{ route('export.excel') }}" method="post" id="invitation_type_registered" class="form-horizontal">
                           @csrf
                           @if($day_id)
                              <input type="hidden" name="day_id" value="{{ $day_id }}">
                           @endif
                           <input type="hidden" name="invitation_type" value="registered">

                           <span class="span_submit" onclick="document.getElementById('invitation_type_registered').submit();">تحميل</span>
                        </form>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

      <!-- Send Invitaions -->
   <div class="col-lg-6 text-center mrAuto">
      <div class="card">
         <div class="card-body" style="padding-bottom: 40px">
            <h4 class="card-title mb-4" style="float: left">الدعوات المرسلة</h4>
            <div id="sendInvitaions" class="apex-charts" dir="ltr"></div>
         </div>
      </div>
   </div>
   
      <!-- Send Invitaions -->
   <div class="col-lg-6 text-center mrAuto">
      <div class="card" style="height:19.5rem">
         <div class="card-body" style="padding-bottom: 40px">
            <table class="table dt-responsive table-bordered table-striped table-hover nowrap text-center">
               <thead>
                  <tr>
                     <th  class="gray_font bold_font">الاسم</th>
                     <th  class="gray_font bold_font">تحميل إكسل</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="gray_font">تم التأكيد</td>
                     <td>
                        <form action="{{ route('export.excel') }}" method="post" id="confirm_send_invited" class="form-horizontal">
                           @csrf

                           @if($day_id)
                              <input type="hidden" name="day_id" value="{{ $day_id }}">
                           @endif
                           <input type="hidden" name="invitation_type" value="invited">
                           <input type="hidden" name="order_status" value="confirmed">

                           <span class="span_submit" onclick="document.getElementById('confirm_send_invited').submit();">تحميل</span>
                        </form>
                     </td>
                  </tr>

                  <tr>
                     <td  class="gray_font">قيد الانتظار</td>
                     <td>
                        <form action="{{ route('export.excel') }}" method="post" id="waiting_send_invited" class="form-horizontal">
                           @csrf
                           @if($day_id)
                              <input type="hidden" name="day_id" value="{{ $day_id }}">
                           @endif
                           <input type="hidden" name="invitation_type" value="invited">
                           <input type="hidden" name="order_status" value="waiting">

                           <span class="span_submit" onclick="document.getElementById('waiting_send_invited').submit();">تحميل</span>
                        </form>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<!-- export excel -->
<div class="row mrB20">
   <!-- registered -->
   <div class="col-lg-6 text-center mrAuto">
      <div class="card">
         <div class="card-body" style="padding-bottom: 40px">
            <h4 class="card-title mb-4" style="float: left">تسجيل</h4>
            <div id="registrations" class="apex-charts" dir="ltr"></div>
         </div>
      </div>
   </div>

   <!-- registrations -->
   <div class="col-lg-6 text-center mrAuto">
      <div class="card" style="height:19.5rem">
         <div class="card-body" style="padding-bottom: 40px">
            <table class="table dt-responsive table-bordered table-striped table-hover nowrap text-center">
               <thead>
                  <tr>
                     <th  class="gray_font bold_font">الاسم</th>
                     <th  class="gray_font bold_font">تحميل إكسل</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="gray_font">انتظار</td>
                     <td>
                        <form action="{{ route('export.excel') }}" method="post" id="order_status_under_study" class="form-horizontal">
                           @csrf
                           @if($day_id)
                              <input type="hidden" name="day_id" value="{{ $day_id }}">
                           @endif
                           <input type="hidden" name="invitation_type" value="registered">
                           <input type="hidden" name="order_status" value="under_study">

                           <span class="span_submit" onclick="document.getElementById('order_status_under_study').submit();">تحميل</span>
                        </form>
                     </td>
                  </tr>

                  <tr>
                     <td class="gray_font">مقبول</td>
                     <td>
                        <form action="{{ route('export.excel') }}" method="post" id="order_status_confirmed" class="form-horizontal">
                           @csrf
                           @if($day_id)
                              <input type="hidden" name="day_id" value="{{ $day_id }}">
                           @endif
                           <input type="hidden" name="invitation_type" value="registered">
                           <input type="hidden" name="order_status" value="confirmed">

                           <span class="span_submit" onclick="document.getElementById('order_status_confirmed').submit();">تحميل</span>
                        </form>
                     </td>
                  </tr>

                  <tr>
                     <td class="gray_font">مرفوض</td>
                     <td>
                        <form action="{{ route('export.excel') }}" method="post" id="order_status_apology" class="form-horizontal">
                           @csrf
                           @if($day_id)
                              <input type="hidden" name="day_id" value="{{ $day_id }}">
                           @endif
                           <input type="hidden" name="invitation_type" value="registered">
                           <input type="hidden" name="order_status" value="apology">

                           <span class="span_submit" onclick="document.getElementById('order_status_apology').submit();">تحميل</span>
                        </form>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@include('admin.includes.home_charts_init')

