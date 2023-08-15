<script type="text/javascript">
$(document).ready(function () {

   //------------ invitation_type ------------
   var invitation_type = {!! json_encode($invitation_type) !!},
   options_type = {
      chart: {
         height: 250,
         type: "pie"
      },
      series: invitation_type,
      labels: [invitation_type[0]+" دعوة",
      invitation_type[1]+" تسجيل"],
      colors: ["#3366cc", "#dc3912"],
      legend: {
         show: !0,
         position: "right",
         horizontalAlign: "center",
         verticalAlign: "middle",
         floating: !1,
         fontSize: "14px",
         offsetX: 0,
         offsetY: 0
      } ,tooltip: {
      y: {
         title: {
         formatter: function (seriesName) {
            return ''
         }
         }
      }
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

   //------------ registered ------------
   var registrations = {!! json_encode($registrations) !!},
   options_registrations = {
      chart: {
         height: 250,
         type: "pie"
      },
      series: registrations,
      labels: ["مقبول", "مرفوض", "بانتظار الموافقة"],
      colors: ["#51a767", "#dc3912", "#ff9900"],
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
   registrations_chart = new ApexCharts(document.querySelector("#registrations"), options_registrations);
   registrations_chart.render();
   
   //------------ send invitation ------------
   var sendInvitations = {!! json_encode($sendInvitations) !!},
   options_send_type = {
      chart: {
         height: 250,
         type: "pie"
      },
      series: sendInvitations,
      labels: [sendInvitations[0]+" تم التأكيد",
      sendInvitations[1]+" قيد الانتظار"],
      colors: ["#3366cc", "#dc3912"],
      legend: {
         show: !0,
         position: "right",
         horizontalAlign: "center",
         verticalAlign: "middle",
         floating: !1,
         fontSize: "14px",
         offsetX: 0,
         offsetY: 0
      } ,tooltip: {
   y: {
      title: {
      formatter: function (seriesName) {
         return ''
      }
      }
   }
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
   type_send_chart = new ApexCharts(document.querySelector("#sendInvitaions"), options_send_type);
   type_send_chart.render();

});
</script>
