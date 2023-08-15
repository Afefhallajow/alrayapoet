<!--- SIDEMENU -->
<div class="topnav">
   <div class="container-fluid">
      <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
         <div class="collapse navbar-collapse" id="topnav-menu-content">
            <ul class="navbar-nav">
               {{-- لوحة التحكم --}}
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="bx bx-home-circle ml-2"></i><span key="t-dashboards">لوحة التحكم</span> <div class="arrow-down mr-2"></div>
                  </a>
                  <div class="dropdown-menu <?php echo \Lang::locale() == 'ar' ? 'arabic' : 'english'; ?>" aria-labelledby="topnav-dashboard">
                     <a href="{{ route('invitations.sent') }}" class="dropdown-item">إرسال الدعوات</a>
                     <a href="{{ route('invitations.index') }}" class="dropdown-item">الدعوات العامة</a>
                     @role('Admin|Employee')
                        <a href="{{ route('first-surname.index') }}" class="dropdown-item">الألقاب 1</a>
                        <a href="{{ route('second-surname.index') }}" class="dropdown-item">الألقاب 2</a>
                        <a href="{{ route('categories.index') }}" class="dropdown-item">الفئات</a>
                        <a href="{{ route('employees.index') }}" class="dropdown-item">الموظفين</a>
                     @endrole
                  </div>
               </li>

               {{-- الفعاليات --}}
               @role('Admin|Employee')
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-event" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-calendar-check ml-2"></i><span key="t-events">الفعاليات</span> <div class="arrow-down mr-2"></div>
                     </a>
                     <div class="dropdown-menu <?php echo \Lang::locale() == 'ar' ? 'arabic' : 'english'; ?>" aria-labelledby="topnav-event">
                        <a href="{{ route('days.index') }}"class="dropdown-item">الفعاليات</a>
                        <a href="{{ route('places.index') }}" class="dropdown-item">أماكن الفعالية</a>
                        <a href="{{ route('chairs-categories.index') }}" class="dropdown-item">فئات الكراسي</a>
                        <a href="{{ route('chairs.index') }}" class="dropdown-item">الكراسي</a>
                        <a href="{{ route('day_invitations') }}" class="dropdown-item">جميع الدعوات</a>
                     </div>
                  </li>
               @endrole

               {{-- الفعاليات --}}
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-party" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="bx bx-calendar-event ml-2"></i><span key="t-partys">الكراسي</span> <div class="arrow-down mr-2"></div>
                  </a>
                  <div class="dropdown-menu <?php echo \Lang::locale() == 'ar' ? 'arabic' : 'english'; ?>" aria-labelledby="topnav-party">
                     <a href="{{ route('all_chairs') }}" class="dropdown-item">جميع الكراسي</a>
                     <a href="{{ route('empty_chairs') }}" class="dropdown-item">الكراسي الفارغة</a>
                     <a href="{{ route('report_chairs',1) }}" class="dropdown-item">تقرير الكراسي</a>
                  </div>
               </li>

               {{-- Qr Code --}}
               <li class="nav-item dropdown">
                  <a href="{{ route('qrcode') }}" class="nav-link dropdown-toggle arrow-none">
                     <i class="fas fa-qrcode ml-2"></i><span>QR Code</span>
                  </a>
               </li>

               @role('Party')
                  <li class="nav-item dropdown">
                     <a href="{{ route('load_place_chart', App\Helpers\DayConfig::getDay()->place->id) }}" class="nav-link dropdown-toggle arrow-none">
                        <i class="fas fa-chair ml-2"></i><span>مخطط الكراسي</span>
                     </a>
                  </li>
               @endrole
            </ul>
         </div>
      </nav>
   </div>
</div>