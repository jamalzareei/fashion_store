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
                    <span class="hide-menu"> {{(auth()->user()->manufactory->manufacturer)}} <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('panel.suppliers') }}"><i class="ti-user"></i> پروفایل من</a></li>
                    <li><a href="{{ route('suppliers.tickes') }}"><i class="ti-email"></i> لیست پیام ها</a></li>
                    {{--  <li><a href="javascript:void(0)"><i class="ti-user"></i> پروفایل من</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-wallet"></i> معاملات من</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-email"></i> لیست پیام ها</a></li>  --}}
                    <li><a href="{{ route('panel.suppliers.edit') }}"><i class="ti-settings"></i> تنظیمات حساب</a></li>
                    <li><a href="{{ route('log-out') }}"><i class="fa fa-power-off"></i> خروج</a></li>
                </ul>
            </li>
            <li class="nav-small-cap m-t-10">--- پلان برنزی</li>
            <li class="active"> 
                <a href="{{ route('panel.suppliers') }}" class="waves-effect active">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> داشبورد </span>
                </a>
            </li>
            
            {{-- <li class=""> 
                <a href="" class="waves-effect "><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>
                     <span class="hide-menu"> کارخانه </span><span class="fa arrow"></span>
                </a>
                    
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('panel.suppliers.edit') }}">ویرایش اطلاعات اولیه</a> </li>
                    <li> <a href="{{ route('panel.suppliers.sale.edit',['step' => 'sale']) }}">اطلاعات فروش</a> </li>
                    <li> <a href="{{ route('panel.suppliers.sale.edit',['step' => 'office']) }}">دفتر مرکزی</a> </li>
                    <li> <a href="{{ route('panel.suppliers.sale.edit',['step' => 'storehouse']) }}">انبار مرکزی</a> </li>
                    <li> <a href="{{ route('panel.suppliers.gallery') }}">گالری تصاویر</a> </li>
                </ul>
            </li> --}}
            <li> <a href="{{ route('panel.suppliers.edit') }}"><i class="zmdi zmdi-format-color-fill zmdi-hc-fw fa-fw"></i> <span class="hide-menu">ویرایش اطلاعات اولیه</a> </li>
            <li> <a href="{{ route('panel.suppliers.sale.edit',['step' => 'sale']) }}"><i class="fa fa-buysellads zmdi-hc-fw fa-fw"></i>اطلاعات فروش</a> </li>
            <li> <a href="{{ route('panel.suppliers.sale.edit',['step' => 'office']) }}"><i class="fa fa-building zmdi-hc-fw fa-fw"></i>دفتر مرکزی</a> </li>
            <li> <a href="{{ route('panel.suppliers.sale.edit',['step' => 'storehouse']) }}"><i class="zmdi zmdi-home zmdi-hc-fw fa-fw"></i>انبار مرکزی</a> </li>
            <li> <a href="{{ route('panel.suppliers.gallery') }}"><i class="fa fa-picture-o zmdi-hc-fw fa-fw"></i>گالری تصاویر</a> </li>

            
            <li class="nav-small-cap">--- پلان نقره ای</li>

            {{--  <li> <a href="{{ route('add.product.supplier') }}"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>اضافه کردن محصول</a> </li>
            <li> <a href="{{ route('list.product.supplier') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>لیست محصولات کارخانه من</a> </li>
            <li> <a href="{{ route('add.decor.supplier') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>اضافه کردن دکور</a> </li>
            <li> <a href="{{ route('list.decor.supplier') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>لیست دکور های کارخانه من</a> </li>  --}}
            
            <li class=" {{ (auth()->user()->plan_id == 2 || auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> محصولات <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('add.product.supplier') }}">اضافه کردن محصول</a> </li>
                    <li> <a href="{{ route('list.product.supplier') }}" class="small">لیست محصولات کارخانه من</a> </li>
                </ul>
            </li>
            <li class=" {{ (auth()->user()->plan_id == 2 || auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-podcast zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> دکور <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('add.decor.supplier') }}" class="small">اضافه کردن دکور</a> </li>
                    <li> <a href="{{ route('list.decor.supplier') }}" class="small">لیست دکور های کارخانه من</a> </li>
                </ul>
            </li>
            
            <li class=" {{ (auth()->user()->plan_id == 2 || auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-file-archive-o zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> مراکز فروش <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('add.merchant.type.suppliers', ['type' => 'merchant']) }}" class="small">اضافه کردن مرکز فروش</a> </li>
                    <li> <a href="{{ route('list.merchant.type.suppliers', ['type' => 'merchant']) }}" class="small">لیست مراکز فورش کارخانه من</a> </li>
                </ul>
            </li>


            <li class="nav-small-cap">--- پلان طلایی</li>
            <li class=" {{ (auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> <a href="{{ route('update.price.avail.poducts') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>بروزرسانی محصولات کارخانه</a> </li>
            <li class=" {{ (auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-sellsy zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> گزارش های فروش <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('suppliers.reports.sales', [ 'type' => 'I-Q' ]) }}">محصولات رزرو شده</a> </li>
                    <li> <a href="{{ route('suppliers.reports.sales', [ 'type' => 'R' ]) }}">محصولات تایید شده</a> </li>
                    <li> <a href="{{ route('suppliers.reports.sales', [ 'type' => 'W' ]) }}">محصولات تحویل داده شده</a> </li>
                    <li> <a href="{{ route('suppliers.reports.sales', [ 'type' => 'B-D-F-C' ]) }}">محصولات برگشت خورده</a> </li>
                </ul>
            </li>
            <li class=" {{ (auth()->user()->plan_id == 3) ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-bell zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> اطلاع رسانی های سیستم <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('suppliers.tickes') }}">اخرین اطلاعیه های های من</a> </li>
                </ul>
            </li>
            <li class="nav-small-cap">-------------</li>
            <li><a href="{{ route('log-out') }}" class="waves-effect"><i class="zmdi zmdi-power zmdi-hc-fw fa-fw"></i> <span class="hide-menu">خروج</span></a></li>
        </ul>
    </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; left: 1px; height: 757.763px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div></div>
</div>