<div class="navbar-default sidebar" role="navigation" style="overflow: visible;">
    <div class="slimScrollDiv" style="position: relative; overflow: visible; width: auto; height: 100%;">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar active" style="overflow: visible hidden; width: auto; height: 100%;">
            <?php $userType = auth()->user()->usertype; ?>
        <ul class="nav in" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="جستجو ...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                    </span> </div>
                <!-- /input-group -->
            </li>
            <li class="user-pro">
                <a href="#" class="waves-effect"><img src="{{ asset('public/logo-300300.png') }}" alt="user-img" class="img-circle"> 
                    <span class="hide-menu"> {{auth()->user()->firstname}} {{auth()->user()->lastname}}<span class="fa arrow"></span></span>
                </a>
            </li>
            <li class="nav-small-cap m-t-10">-----------------</li>
            <li class="active"> 
                <a href="{{ route('admin.dashboard') }}" class="waves-effect active">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> داشبورد {{$userType}}</span>
                </a>
            </li>

            
            <li class="  "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> کاربران <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    {{--  <li> <a href="{{ route('panel.adminer.users.roles') }}"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سطح دسترسی</a> </li>  --}}
                    <li> <a href="{{ route('admin.users') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>لیست کاربران</a> </li>
                    <li> <a href="{{ route('admin.roles') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سطح های دسترسی</a> </li>
                </ul>
            </li>
            

            <li class="nav-small-cap">-------------</li>
            <li><a href="{{ route('log-out') }}" class="waves-effect"><i class="zmdi zmdi-power zmdi-hc-fw fa-fw"></i> <span class="hide-menu">خروج</span></a></li>
        </ul>
    </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; left: 1px; height: 757.763px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div></div>
</div>