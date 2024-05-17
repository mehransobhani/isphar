<nav class="navbar navbar-default navbar-static-top m-b-0">
  <div class="navbar-header">
    <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
      <i class="zmdi zmdi-menu"></i>
    </a>
    <div class="top-left-part text-center">
      <a class="logo" href="javascript:void(0)">
        <b id="expanded-logo"><img src="{{ asset('assets/img/sm-Logo.png') }}" alt="home" class="w-75"></b>
        <b id="collapsed-logo"><img src="{{ asset('assets/img/Logo-white.png') }}" alt="home" class="w-75"></b>
      </a>
    </div>
    <ul class="nav navbar-top-links navbar-left hidden-xs open-close">
      <li>
        <a href="javascript:void(0)" class="hidden-xs waves-effect waves-light">
          <i class="zmdi zmdi-menu"></i>
        </a>
      </li>
    </ul>
    <ul class="nav navbar-top-links navbar-right pull-left">
       <li class="dropdown">
        <a class="dropdown-toggle  zmdi zmdi-account-box" data-toggle="dropdown" href="#">
          <b class="hidden-xs">mehran</b>
        </a>
        <ul class="dropdown-menu dropdown-user scale-up">
          <li><a href=" "><i class=" zmdi zmdi-account-o"></i> پروفایل من</a></li>
          <li role="separator" class="divider"></li>
          <li><a href=" "><i class="fa fa-power-off"></i> خروج</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse slimscrollsidebar">
    <ul class="nav" id="side-menu">
      <li class="sidebar-search hidden-sm hidden-md hidden-lg">
        <div class="input-group custom-search-form">
          <input type="text" class="form-control" placeholder="جستجو ...">
          <span class="input-group-btn">
                <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                </span>
        </div>
      </li>
      <li>
        <a href="#" class="waves-effect">
          <span class="hide-menu"> mehran<span class="fa arrow"></span></span>
        </a>
        <ul class="nav nav-second-level">
          <li><a href=" "><i class="ti-user"></i> پروفایل من</a></li>
          <li><a href=" "><i class="fa fa-power-off"></i> خروج</a></li>
        </ul>
      </li>
      <li>

      </li>
      <li>
        <a href="" class="waves-effect">
          <i class="fa fa-users zmdi-hc-fw fa-fw"></i>
          <span class="hide-menu"> کاربران
                <span class="fa arrow"></span>
              </span>
        </a>
      </li>
      <li>
        <a href= "{{route("patient.index")}}" class="waves-effect">
          <i class="fa fa-ticket zmdi-hc-fw fa-fw"></i>
          <span class="hide-menu">  بیماران
              <span class="fa arrow"></span>
            </span>
        </a>
      </li>
      <li class="nav-small-cap">--- مالی</li>
        @if(0)
          <li>
            <a href="{{ route('admin.card.index') }}" class="waves-effect">
              <i class="fa fa-credit-card zmdi-hc-fw fa-fw"></i>
              <span class="hide-menu"> کارت های بانکی
                  <span class="fa arrow"></span>
                </span>
            </a>
          </li>
        @endif
        @if(0)
          <li>
            <a href="{{ route('admin.index-invoice-irr') }}" class="waves-effect">
              <i class="fa fa-money zmdi-hc-fw fa-fw"></i>
              <span class="hide-menu"> فاکتور های ریالی
                <span class="fa arrow"></span>
              </span>
            </a>
          </li>

          <li>
            <a href="{{ route('admin.index-invoice-crypto') }}" class="waves-effect">
              <i class="fa fa-dollar zmdi-hc-fw fa-fw"></i>
              <span class="hide-menu"> فاکتور های دلاری
                <span class="fa arrow"></span>
              </span>
            </a>
          </li>
        @endif
        @if(0)
          <li>
            <a href="{{ route('admin.checkout') }}" class="waves-effect">
              <i class="fa fa-check zmdi-hc-fw fa-fw"></i>
              <span class="hide-menu"> درخواست تسویه
              <span class="fa arrow"></span>
            </span>
            </a>
          </li>
        @endif

      <li class="nav-small-cap">--- تنظیمات</li>


    </ul>
  </div>
</div>
