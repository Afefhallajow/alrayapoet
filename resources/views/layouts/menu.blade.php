<div id="ttt" class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{url('/home')}}">
                    {{--                    <img src="{{asset('assets/vuexy/images/logo/logo2.png')}}" width="80px;">--}}
                    <span class="brand-logo">
</span>
                    <h2 class="brand-text"> لوحة التحكم</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>

    <div class="main-menu">
        @if(\Illuminate\Support\Facades\Auth::user()->type==1)
            <?php $i = 1; ?>

            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" >
                @foreach($seasons as $se)
                    <input type="hidden"  name="season" value="1">
                    <li class="br-menu-item">
                        <a onclick="send({{$se->id}})">
                            <label>{{$se->name}}</label></a>            <ul class="br-menu-sub"  >

                            @if(Auth::user()->type == 1 || Auth::user()->type == 3)
                                <li class="br-menu-item">
                                    <a href="#" class="br-menu-link with-sub " >
                                        <i data-feather="layers" class="text-primary"></i>
                                        <span class="menu-item-label">شاعر الراية</span>
                                    </a><!-- br-menu-link -->
                                    <ul class="br-menu-sub">
                                        @if(Auth::user()->type == 1 || Auth::user()->type == 3)
                                            <li class="sub-item"><a href="{{ url('/show/all') }}" class="sub-link"><i data-feather="circle" class="text-primary"></i> المتقدمين </a></li>
                                        @endif
                                        @if(Auth::user()->type == 1 || Auth::user()->type == 3)
                                            <li class="sub-item"><a href="{{ url('/show/accept') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> المرشحين </a></li>
                                            <li class="sub-item"><a href="{{ route('participants') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> المشاركين </a></li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->type == 1 || Auth::user()->type == 3)
                                <li class="br-menu-item">
                                    <a href="#" class="br-menu-link with-sub " >
                                        <i data-feather="layers" class="text-primary"></i>
                                        <span class="menu-item-label">لجنة التحكيم</span>
                                    </a><!-- br-menu-link -->
                                    <div style="display: none"> {{$test=\App\Models\User::where('season',$se->id)->where('type',4)->get()}} </div>
                                    <ul class="br-menu-sub">

                                        @foreach($test as $t)
                                            <li class="sub-item"><a href="{{route('qualifiedView',$t->id)}}" class="sub-link"><i data-feather="circle" class="text-primary"></i> {{$t->name}} </a></li>
                                        @endforeach
                                        <li class="sub-item"><a href="{{ route('ref-evaluations') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> المشتركين بين جميع الحكام </a></li>
                                    </ul>
                                    <?php $i++; ?>

                                </li>
                            @endif

                        <!-- br-menu-item -->
                            @if(Auth::user()->type == 2)
                                <li class="sub-item"><a href="{{ url('/evaluator-show/needEvulator') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> متقدمين بحاجة تقييم </a></li>
                                <li class="sub-item"><a href="{{ url('/evaluator-show/done') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> متقدمين تم تقييمهم </a></li>

                            @endif
                            @if(Auth::user()->type == 4)
                                <li class="sub-item"><a href="{{ url('/referee-show/needEvulator') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i>  المرشحين </a></li>
                                <li class="sub-item"><a href="{{ url('/referee-show/done') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> المتأهلين  </a></li>
                            @endif
                            @if(Auth::user()->type == 1)
                                <li class="br-menu-item">
                                    <a href="{{ route('evaluations') }}" class="br-menu-link" >
                                        <i data-feather="link" class="text-primary"></i>
                                        <span class="menu-item-label">تقييمات الفرز</span>
                                    </a>
                                </li>
                                <!--<li class="br-menu-item">-->
                            <!--        <a href="{{ route('ref-evaluations') }}" class="br-menu-link" >-->
                                <!--            <i data-feather="link" class="text-primary"></i>-->
                                <!--            <span class="menu-item-label">تقييمات الحكام</span>-->
                                <!--        </a>-->
                                <!--</li>-->
                            @endif
                            @if(Auth::user()->type == 1 )
                                <li class="br-menu-item">
                                    <a href="{{route('lajna')}}" class="br-menu-link" >
                                        <i data-feather="link" class="text-primary"></i>
                                        <span class="menu-item-label">لجنة الفرز</span>
                                    </a>
                                </li>

                            @endif

                                @if(Auth::user()->type == 1 )
                                    <li class="br-menu-item">
                                        <a href="{{ route('newparticipants')}}" class="br-menu-link" >
                                            <i data-feather="link" class="text-primary"></i>
                                            <span class="menu-item-label">بيانات المتأهلين</span>
                                        </a>
                                    </li>

                                @endif

                        </ul>
                    </li>
                @endforeach




                @if(Auth::user()->type == 1)



                    <li class="br-menu-item">
                        <a href="{{ route('add_new_user') }}" class="br-menu-link" >
                            <i data-feather="user" class="text-primary"></i>
                            <span class="menu-item-label">المستخدمين</span>
                        </a>
                    </li>

                @endif
                @if(1)
                    <li class="br-menu-item">
                        <a href="{{ route('settings') }}" class="br-menu-link" >
                            <i data-feather="setting" class="text-primary"></i>
                            <span class="menu-item-label">الاعدادات</span>
                        </a>
                    </li>

                @endif



            </ul>
        @else
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" >
                @if(Auth::user()->type == 1 )
                    <li class="br-menu-item">
                        <a href="#" class="br-menu-link with-sub " >
                            <i data-feather="layers" class="text-primary"></i>
                            <span class="menu-item-label">شاعر الراية</span>
                        </a><!-- br-menu-link -->
                        <ul class="br-menu-sub">
                            @if(Auth::user()->type == 1 )
                                <li class="sub-item"><a href="{{ url('/show/all') }}" class="sub-link"><i data-feather="circle" class="text-primary"></i> المتقدمين </a></li>
                            @endif
                            @if(Auth::user()->type == 1 )
                                <li class="sub-item"><a href="{{ url('/show/accept') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> المرشحين </a></li>
                                <li class="sub-item"><a href="{{ route('participants') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> المشاركين </a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->type == 1 )
                    <li class="br-menu-item">
                        <a href="#" class="br-menu-link with-sub " >
                            <i data-feather="layers" class="text-primary"></i>
                            <span class="menu-item-label">لجنة التحكيم</span>
                        </a><!-- br-menu-link -->
                        <ul class="br-menu-sub">
                            <li class="sub-item"><a href="{{ url('qualified/khaild') }}" class="sub-link"><i data-feather="circle" class="text-primary"></i> خالد المريخي </a></li>
                            <li class="sub-item"><a href="{{ url('qualified/nasser') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> ناصر السبيعي </a></li>
                            <li class="sub-item"><a href="{{ url('qualified/naif') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> نايف صقر </a></li>
                            <li class="sub-item"><a href="{{ route('ref-evaluations') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> المشتركين بين جميع الحكام </a></li>
                        </ul>
                    </li>
                @endif

            <!-- br-menu-item -->
                @if(Auth::user()->type == 1)
                    <li class="br-menu-item">
                        <a href="{{ route('add_new_user') }}" class="br-menu-link" >
                            <i data-feather="user" class="text-primary"></i>
                            <span class="menu-item-label">المستخدمين</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->type == 2)
                    <li class="sub-item"><a href="{{ url('/evaluator-show/needEvulator') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> متقدمين بحاجة تقييم </a></li>
                    <li class="sub-item"><a href="{{ url('/evaluator-show/done') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> متقدمين تم تقييمهم </a></li>

                        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" >

                        @can('view register')

                            <li class="sub-item"><a href="{{ url('/show/all') }}" class="sub-link"><i data-feather="circle" class="text-primary"></i> المتقدمين </a></li>
                        @endcan
                        @can('view final')
                            <li class="sub-item"><a href="{{ route('participants') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> المشاركين </a></li>


                        @endcan
                        @can('view refree')
                                <li class="sub-item">
                            <a href="#" class="br-menu-link with-sub " >
                                <i data-feather="layers" class="text-primary"></i>
                                <span class="menu-item-label">لجنة التحكيم</span>
                            </a><!-- br-menu-link -->
                            <div style="display: none"> {{$test=\App\Models\User::where('season',\Illuminate\Support\Facades\Auth::user()->season)->where('type',4)->get()}} </div>
                            <ul class="br-menu-sub">

                                @foreach($test as $t)
                                    <li class="sub-item"><a href="{{route('qualifiedView',$t->id)}}" class="sub-link"><i data-feather="circle" class="text-primary"></i> {{$t->name}} </a></li>
                                @endforeach
                                <li class="sub-item"><a href="{{ route('ref-evaluations') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> المشتركين بين جميع الحكام </a></li>
                            </ul>
                                </li>
                        @endcan
                        @can('view user')
                                <li class="sub-item">
                            <a href="{{ route('add_new_user') }}" class="br-menu-link" >
                                <i data-feather="user" class="text-primary"></i>
                                <span class="menu-item-label">المستخدمين</span>
                            </a>
</li>
                        @endcan
                        @can('view setting')
<li>
                            <a href="{{ route('settings') }}" class="br-menu-link" >
                                <i data-feather="setting" class="text-primary"></i>
                                <span class="menu-item-label">الاعدادات</span>
                            </a>
</li>
                        @endcan
                        </ul>

                @endif
                @if(Auth::user()->type == 4)
                    <li class="sub-item"><a href="{{ url('/referee-show/needEvulator') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i>  المرشحين </a></li>
                    <li class="sub-item"><a href="{{ url('/referee-show/done') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> المتأهلين  </a></li>
                @endif
                @if(Auth::user()->type == 1)
                    <li class="br-menu-item">
                        <a href="{{ route('evaluations') }}" class="br-menu-link" >
                            <i data-feather="link" class="text-primary"></i>
                            <span class="menu-item-label">تقييمات الفرز</span>
                        </a>
                    </li>
                    <!--<li class="br-menu-item">-->
                <!--        <a href="{{ route('ref-evaluations') }}" class="br-menu-link" >-->
                    <!--            <i data-feather="link" class="text-primary"></i>-->
                    <!--            <span class="menu-item-label">تقييمات الحكام</span>-->
                    <!--        </a>-->
                    <!--</li>-->
                @endif
                @if(Auth::user()->type == 1 || Auth::user()->type == 5)
                    <li class="br-menu-item">
                        <a href="/lajna" class="br-menu-link" >
                            <i data-feather="link" class="text-primary"></i>
                            <span class="menu-item-label">لجنة الفرز</span>
                        </a>
                    </li>

                @endif
            </ul>
        @endif


            @if(\Illuminate\Support\Facades\Auth::user()->type==5 )
                <?php $i = 1; ?>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" >
                    @foreach($seasons as $se)
                    <?php
                        $temp12=0
                        ?>
                    @foreach(\Illuminate\Support\Facades\Auth::user()->seasons as $userse )
@if($userse->season_id ==$se->id )
                                <?php
                                $temp12=1
                                ?>

                            @endif
                        @endforeach
                    @if($temp12 ==1)
                        <input type="hidden"  name="season" value="1">
                        <li class="br-menu-item">
                            <a onclick="send({{$se->id}})">
                                <label>{{$se->name}}</label></a>            <ul class="br-menu-sub"  >

                                @if(Auth::user()->type == 5)
                                    <li class="br-menu-item">
                                        <a href="#" class="br-menu-link with-sub " >
                                            <i data-feather="layers" class="text-primary"></i>
                                            <span class="menu-item-label">شاعر الراية</span>
                                        </a><!-- br-menu-link -->
                                        <ul class="br-menu-sub">
                                            @if(Auth::user()->type == 5)
                                                <li class="sub-item"><a href="{{ url('/show/all') }}" class="sub-link"><i data-feather="circle" class="text-primary"></i> المتقدمين </a></li>
                                            @endif
                                            @if(Auth::user()->type == 5 )
                                                <li class="sub-item"><a href="{{ url('/show/accept') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> المرشحين </a></li>
                                                <li class="sub-item"><a href="{{ route('participants') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> المشاركين </a></li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->type == 5 )
                                    <li class="br-menu-item">
                                        <a href="#" class="br-menu-link with-sub " >
                                            <i data-feather="layers" class="text-primary"></i>
                                            <span class="menu-item-label">لجنة التحكيم</span>
                                        </a><!-- br-menu-link -->
                                        <div style="display: none"> {{$test=\App\Models\User::where('season',$se->id)->where('type',4)->get()}} </div>
                                        <ul class="br-menu-sub">

                                            @foreach($test as $t)
                                                <li class="sub-item"><a href="{{route('qualifiedView',$t->id)}}" class="sub-link"><i data-feather="circle" class="text-primary"></i> {{$t->name}} </a></li>
                                            @endforeach
                                            <li class="sub-item"><a href="{{ route('ref-evaluations') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> المشتركين بين جميع الحكام </a></li>
                                        </ul>
                                        <?php $i++; ?>

                                    </li>
                                @endif

                            <!-- br-menu-item -->
                                @if(Auth::user()->type == 2)
                                    <li class="sub-item"><a href="{{ url('/evaluator-show/needEvulator') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> متقدمين بحاجة تقييم </a></li>
                                    <li class="sub-item"><a href="{{ url('/evaluator-show/done') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> متقدمين تم تقييمهم </a></li>

                                @endif
                                @if(Auth::user()->type == 4)
                                    <li class="sub-item"><a href="{{ url('/referee-show/needEvulator') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i>  المرشحين </a></li>
                                    <li class="sub-item"><a href="{{ url('/referee-show/done') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> المتأهلين  </a></li>
                                @endif
                                @if(Auth::user()->type == 5)
                                    <li class="br-menu-item">
                                        <a href="{{ route('evaluations') }}" class="br-menu-link" >
                                            <i data-feather="link" class="text-primary"></i>
                                            <span class="menu-item-label">تقييمات الفرز</span>
                                        </a>
                                    </li>
                                    <!--<li class="br-menu-item">-->
                                <!--        <a href="{{ route('ref-evaluations') }}" class="br-menu-link" >-->
                                    <!--            <i data-feather="link" class="text-primary"></i>-->
                                    <!--            <span class="menu-item-label">تقييمات الحكام</span>-->
                                    <!--        </a>-->
                                    <!--</li>-->
                                @endif
                                @if(Auth::user()->type == 1 || Auth::user()->type == 4)
                                    <li class="br-menu-item">
                                        <a href="{{route('lajna')}}" class="br-menu-link" >
                                            <i data-feather="link" class="text-primary"></i>
                                            <span class="menu-item-label">لجنة الفرز</span>
                                        </a>
                                    </li>

                                @endif
                            </ul>
                        </li>
                        @endif
                    @endforeach




                    @if(Auth::user()->type == 5)



                        <li class="br-menu-item">
                            <a href="{{ route('add_new_user') }}" class="br-menu-link" >
                                <i data-feather="user" class="text-primary"></i>
                                <span class="menu-item-label">المستخدمين</span>
                            </a>
                        </li>

                    @endif
                    @if(1)
                        <li class="br-menu-item">
                            <a href="{{ route('settings') }}" class="br-menu-link" >
                                <i data-feather="setting" class="text-primary"></i>
                                <span class="menu-item-label">الاعدادات</span>
                            </a>
                        </li>

                    @endif



                </ul>

            @endif

            @if(\Illuminate\Support\Facades\Auth::user()->type==3 )
                <?php $i = 1; ?>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" >
                    @foreach($seasons as $se)
                        <?php
                        $temp12=0
                        ?>
                            @if(\Illuminate\Support\Facades\Auth::user()->season ==$se->id )
                                <?php
                                $temp12=1
                                ?>

                            @endif
                        @if($temp12 ==1)
                            <input type="hidden"  name="season" value="1">
                            <li class="br-menu-item">
                                <a onclick="send({{$se->id}})">
                                    <label>{{$se->name}}</label></a>            <ul class="br-menu-sub"  >

                                    @if(Auth::user()->type == 3)
                                        <li class="br-menu-item">
                                            <a href="#" class="br-menu-link with-sub " >
                                                <i data-feather="layers" class="text-primary"></i>
                                                <span class="menu-item-label">شاعر الراية</span>
                                            </a><!-- br-menu-link -->
                                            <ul class="br-menu-sub">
                                                @if(Auth::user()->type == 3)
                                                    <li class="sub-item"><a href="{{ url('/show/all') }}" class="sub-link"><i data-feather="circle" class="text-primary"></i> المتقدمين </a></li>
                                                @endif
                                                @if(Auth::user()->type == 3 )
                                                    <li class="sub-item"><a href="{{ url('/show/accept') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> المرشحين </a></li>
                                                    <li class="sub-item"><a href="{{ route('participants') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> المشاركين </a></li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                    @if(Auth::user()->type == 3 )
                                        <li class="br-menu-item">
                                            <a href="#" class="br-menu-link with-sub " >
                                                <i data-feather="layers" class="text-primary"></i>
                                                <span class="menu-item-label">لجنة التحكيم</span>
                                            </a><!-- br-menu-link -->
                                            <div style="display: none"> {{$test=\App\Models\User::where('season',$se->id)->where('type',4)->get()}} </div>
                                            <ul class="br-menu-sub">

                                                @foreach($test as $t)
                                                    <li class="sub-item"><a href="{{route('qualifiedView',$t->id)}}" class="sub-link"><i data-feather="circle" class="text-primary"></i> {{$t->name}} </a></li>
                                                @endforeach
                                                <li class="sub-item"><a href="{{ route('ref-evaluations') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> المشتركين بين جميع الحكام </a></li>
                                            </ul>
                                            <?php $i++; ?>

                                        </li>
                                    @endif

                                <!-- br-menu-item -->
                                    @if(Auth::user()->type == 2)
                                        <li class="sub-item"><a href="{{ url('/evaluator-show/needEvulator') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i> متقدمين بحاجة تقييم </a></li>
                                        <li class="sub-item"><a href="{{ url('/evaluator-show/done') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> متقدمين تم تقييمهم </a></li>

                                    @endif
                                    @if(Auth::user()->type == 4)
                                        <li class="sub-item"><a href="{{ url('/referee-show/needEvulator') }}" class="sub-link2"><i data-feather="circle" class="text-primary"></i>  المرشحين </a></li>
                                        <li class="sub-item"><a href="{{ url('/referee-show/done') }}" class="sub-link1"><i data-feather="circle" class="text-primary"></i> المتأهلين  </a></li>
                                    @endif
                                    @if(Auth::user()->type == 3)
                                        <li class="br-menu-item">
                                            <a href="{{ route('evaluations') }}" class="br-menu-link" >
                                                <i data-feather="link" class="text-primary"></i>
                                                <span class="menu-item-label">تقييمات الفرز</span>
                                            </a>
                                        </li>
                                        <!--<li class="br-menu-item">-->
                                    <!--        <a href="{{ route('ref-evaluations') }}" class="br-menu-link" >-->
                                        <!--            <i data-feather="link" class="text-primary"></i>-->
                                        <!--            <span class="menu-item-label">تقييمات الحكام</span>-->
                                        <!--        </a>-->
                                        <!--</li>-->
                                    @endif
                                    @if(Auth::user()->type == 1 || Auth::user()->type == 4)
                                        <li class="br-menu-item">
                                            <a href="{{route('lajna')}}" class="br-menu-link" >
                                                <i data-feather="link" class="text-primary"></i>
                                                <span class="menu-item-label">لجنة الفرز</span>
                                            </a>
                                        </li>

                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endforeach




                    @can('view user')



                        <li class="br-menu-item">
                            <a href="{{ route('add_new_user') }}" class="br-menu-link" >
                                <i data-feather="user" class="text-primary"></i>
                                <span class="menu-item-label">المستخدمين</span>
                            </a>
                        </li>

                    @endif
                    @can('view setting')
                        <li class="br-menu-item">
                            <a href="{{ route('settings') }}" class="br-menu-link" >
                                <i data-feather="setting" class="text-primary"></i>
                                <span class="menu-item-label">الاعدادات</span>
                            </a>
                        </li>

                    @endif



                </ul>

            @endif



    </div>

</div>
<script>
    function send (id){
        console.log('asdasdasd');
        var xhr = new XMLHttpRequest();

// Making our connection
        var url = '/season/'+id;
        console.log(url);

        xhr.open("GET", url);

// function execute after request is successful
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        }
// Sending our request
        xhr.send();

    }

</script>
