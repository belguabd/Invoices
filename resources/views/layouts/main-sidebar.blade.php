<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar" ></div>
<aside class="app-sidebar sidebar-scroll  text-white" style="background-color: #242526">
    <div class="main-sidebar-header active ">
        {{-- <a href="{{ url('/' . ($page = 'index')) }}"
            class="d-flex justify-content-center align-items-center text-success"><img
                src="{{ URL::asset('assets/img/media/logo.png') }}" class="main-logo" alt="logo">
            <h2><b>الفواتير</b></h2>
        </a> --}}
        {{-- <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a> --}}
    </div>
    <div class="main-sidemenu">
        {{-- <div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
							<span class="mb-0 text-muted"> {{Auth::user()->email}}</span>
						</div>
					</div>
				</div> --}}
        <ul class="side-menu">
            {{-- <li class="side-item side-item-category">برنامج الفواتير</li> --}}
            <li class="slide mt-3">
                <a class="side-menu__item  tx-medium " href="{{ url('/' . ($page = 'home')) }}">
                    <i class="fas fa-home tx-white tx-15"></i> &nbsp;&nbsp;
                    <span class="tx-white  side-menu__label"><span
                            class="tx-white tx-15 tx-normal">الرئيسية</span></span>
                </a>
            </li>
            <li class="slide">
                <a class="side-menu__item invoices" data-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-file-invoice tx-white tx-15"></i>&nbsp;&nbsp;
                    <span class="tx-white  side-menu__label"><span
                            class="tx-white tx-15 tx-normal">الفواتير</span></span>
                    <i class= "angle fas fa-angle-left"></i>
                </a>
                <ul class="collapse list-unstyled  " id="collapseExample">
                    <li><a class="tx-15 tx-normal tx-white " href="{{ url('/' . ($page = 'invoices')) }}">قائمة
                            الفواتير</a></li>
                    <li><a class="tx-15 tx-white tx-normal"
                            href="{{ url('/' . ($page = 'payments/invoices')) }}">الفواتير المدفوعة</a></li>
                    <li><a class="tx-15 tx-white tx-normal" href="{{ url('/' . ($page = 'Invoice_UnPaid')) }}">الفواتير
                            غير المدفوعة</a></li>
                    <li><a class="tx-15 tx-white tx-normal" href="{{ url('/' . ($page = 'Invoice_Partial')) }}">الفواتير
                            المدفوعة جزئيا</a></li>
                    <li><a class="tx-15 tx-white tx-normal" href="{{ url('/' . ($page = 'invoices/archive')) }}">ارشيف
                            الفواتير</a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item reports" data-toggle="collapse" href="#collapsereports" role="button"
                    aria-expanded="false" aria-controls="collapsereports">
                    <i class="fas fa-file-alt tx-white tx-15"></i>
                    &nbsp;
                    &nbsp;
                    <span class="tx-white  side-menu__label">
                        <span class="tx-white tx-15 tx-normal">التقارير</span> </span>
                    <i class="angle  fas fa-angle-left" ></i>
                </a>
                <ul class="collapse list-unstyled  " id="collapsereports">
                    <li><a class="tx-15 tx-white tx-normal" href="{{ url('/' . ($page = 'cards')) }}">التقارير
                            الفواتير</a></li>
                    <li><a class="tx-15 tx-white tx-normal" href="{{ url('/' . ($page = 'cards')) }}">التقارير
                            العملاء</a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item users" data-toggle="collapse" href="#collapseusers" role="button"
                    aria-expanded="false" aria-controls="collapseusers">
                    <i class="fas fa-users tx-white tx-15"></i>
                    &nbsp;
                    &nbsp;
                    <span class="tx-white  side-menu__label">
                        <span class="tx-white tx-15 tx-normal">المستخدمين</span> </span>
                    <i class="angle  fas fa-angle-left" ></i>
                </a>
                <ul class="collapse list-unstyled  " id="collapseusers">
                    <li><a class="tx-15 tx-white tx-normal" href="{{ url('/' . ($page = 'users')) }}">قائمة المستخدمين
                        </a></li>
                    <li><a class="tx-15 tx-white tx-normal" href="{{ url('/' . ($page = 'roles')) }}">
                            صلاحيات المستخدمين</a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item settings" data-toggle="collapse" href="#collapsesettings" role="button"
                    aria-expanded="false" aria-controls="collapsesettings">
                    <i class="fas fa-cog tx-white tx-15"></i>
                    &nbsp;
                    &nbsp;
                    <span class="tx-white  side-menu__label">
                        <span class="tx-white tx-15 tx-normal">الاعدادات</span> </span>
                    <i class="angle  fas fa-angle-left" ></i>
                </a>
                <ul class="collapse list-unstyled  " id="collapsesettings">
                    <li><a class="tx-15 tx-white tx-normal" href="{{ url('/' . ($page = 'sections')) }}">الأقسام
                        </a></li>
                    <li><a class="tx-15 tx-white tx-normal" href="{{ url('/' . ($page = 'products')) }}">
                            المنتجات</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
<!-- main-sidebar -->


