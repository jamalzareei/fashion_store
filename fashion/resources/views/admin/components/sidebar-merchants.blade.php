<div class="navbar-default sidebar" role="navigation" style="overflow: visible;">
    <div class="slimScrollDiv" style="position: relative; overflow: visible; width: auto; height: 100%;">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar active" style="overflow: visible hidden; width: auto; height: 100%;">
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
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('bio.merchant') }}"><i class="ti-user"></i> پروفایل من</a></li>
                    {{--  <li><a href="{{ route('suppliers.tickes') }}"><i class="ti-email"></i> لیست پیام ها</a></li>  --}}
                    {{--  <li><a href="javascript:void(0)"><i class="ti-user"></i> پروفایل من</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-wallet"></i> معاملات من</a></li> --}}
                    <li><a href="{{ route('edit.merchant') }}"><i class="ti-settings"></i> تنظیمات حساب</a></li>
                    <li><a href="{{ route('log-out') }}"><i class="fa fa-power-off"></i> خروج</a></li>
                </ul>
            </li>
            <li class="nav-small-cap m-t-10">--- پلان برنزی</li>
            <li class="active"> 
                <a href="{{ route('panel') }}" class="waves-effect active">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> داشبورد </span>
                </a>
            </li>
            <li class=""> 
                <a href="{{ route('bio.merchant') }}" class="waves-effect ">
                    <i class="zmdi zmdi-format-color-fill zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> حساب کاربری <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('bio.merchant') }}" class="active">اطلاعات حساب</a> </li>
                    <li> <a href="{{ route('edit.user', ['step' => 'bio']) }}">ویرایش اطلاعات کاربری</a> </li>
                    <li> <a href="{{ route('edit.user', ['step' => 'card']) }}"> ویرایش کارت بانکی</a> </li>
                    {{--  <li> <a href="{{ route('edit.user', ['step' => 'spesiality']) }}">ویرایش تخصص ها</a> </li>  --}}
                    <li> <a href="{{ route('edit.user', ['step' => 'password']) }}">تغییر رمز عبور</a> </li>
                </ul>
            </li>
            
            <li class=""> 
                <a href="{{ route('bio.merchant') }}" class="waves-effect ">
                    <i class="fa fa-archive zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu">   فروشگاه اصلی <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('edit.merchant') }}">ویرایش اطلاعات فروشگاه</a> </li>
                    <li> <a href="{{ route('connect.suppliers') }}">تولید کنندگان مرتبط</a> </li>
                </ul>
            </li>

            
            <li class="nav-small-cap">--- پلان نقره ای</li>
            
            <li class=" {{ (auth()->user()->plan_id == 2 || auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect ">
                    <i class="fa fa-file-archive-o zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> فروشگاه های من <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('add.merchant.type') }}">اضافه کردن فروشگاه جدید</a> </li>
                    <li> <a href="{{ route('list.merchant.type', ['type'=> 'merchant']) }}">همه فروشگاه های من</a> </li>
                </ul>
            </li>
            <li class=" {{ (auth()->user()->plan_id == 2 || auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect ">
                    <i class="fa fa-map-marker zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu">  نصاب های من <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('add.merchant.type', ['type'=> 'installer']) }}">معرفی نصاب</a> </li>
                    <li> <a href="{{ route('list.merchant.type', ['type'=> 'installer']) }}">همه نصاب های من</a> </li>
                </ul>
            </li>
            
            <li class=" {{ (auth()->user()->plan_id == 2 || auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect ">
                    <i class="fa fa-building zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu">  شرکت های حمل من <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('add.merchant.type', ['type'=> 'transporter']) }}">معرفی شرکت حمل</a> </li>
                    <li> <a href="{{ route('list.merchant.type', ['type'=> 'transporter']) }}">همه شرکت های حمل</a> </li>
                </ul>
            </li>
            <li class=" {{ (auth()->user()->plan_id == 2 || auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="#" class="waves-effect ">
                    <i class="fa fa-bar zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> گزارش های بازار
                    </span>
                </a>
            </li>
            {{--  <li class=""> 
                <a href="{{ route('list.product.merchant') }}" class="waves-effect ">
                    <i class="zmdi zmdi-border-all zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> محصولات <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('list.product.merchant') }}">لیست محصولات</a> </li>
                    <li> <a href="{{ route('add.product.merchant') }}">اضافه کردن محصول جدید</a> </li>
                </ul>
            </li>  --}}
            <li class="nav-small-cap">--- پلان طلایی</li>
            <li class=" {{ (auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="#" class="waves-effect ">
                    <i class="fa fa-newspaper-o zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> گزارش های تخصصی بازار
                    </span>
                </a>
            </li>
            <li class=" {{ (auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="#" class="waves-effect ">
                    <i class="fa fa-list zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> تراکم مصرف و تقاضا
                    </span>
                </a>
            </li>

            <li class="divider" role="separator">-------------------</li>
            {{--  <li><a href="#" class="waves-effect"><i class="zmdi zmdi-power zmdi-hc-fw fa-fw"></i> <span class="hide-menu"></span></a></li>  --}}

            <li><a href="{{ route('log-out') }}" class="waves-effect"><i class="zmdi zmdi-power zmdi-hc-fw fa-fw"></i> <span class="hide-menu">خروج</span></a></li>
        </ul>
    </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; left: 1px; height: 757.763px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div></div>
</div>