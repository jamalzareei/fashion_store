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
                <a href="{{ route('panel.adminer') }}" class="waves-effect active">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> داشبورد {{$userType}}</span>
                </a>
            </li>

            
            <li class="active"> 
                <a href="{{ route('panel.adminer.filemanager') }}" class="waves-effect active">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> فایل منیجر</span>
                </a>
            </li>


            <li class=" {{ ($userType == 'A' || $userType == 'P') ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> کاربران <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('panel.adminer.users.roles') }}"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سطح دسترسی</a> </li>
                    <li> <a href="{{ route('panel.adminer.users') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>لیست کاربران</a> </li>
                </ul>
            </li>

            <li class=" {{ ($userType == 'A' || $userType == 'P' || $userType == 'B' || $userType == 'C') ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> دسته بندی ها <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('panel.adminer.category.add') }}"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>اضافه کردن دسته بندی</a> </li>
                    <li> <a href="{{ route('panel.adminer.categories') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>لیست دسته بندی ها</a> </li>
                    <li> <a href="{{ route('panel.adminer.properties') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>لیست ویژگی های محصولات</a> </li>
                </ul>
            </li>

            <li class=" {{ ($userType == 'A' || $userType == 'P' || $userType == 'C') ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> صفحات ایستا <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('panel.adminer.page.add') }}"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>اضافه کردن صفحه جدید</a> </li>
                    <li> <a href="{{ route('panel.adminer.pages') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>لیست صفحات ایستا</a> </li>
                </ul>
            </li>
            
            <li class=" {{ ($userType == 'A' || $userType == 'P' || $userType == 'D') ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> سفارشات <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('panel.adminer.orders.e.g') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>لیست سفارشات در انتظار</a> </li>
                    <li class="nav-small-cap">---</li>
                    <li> <a href="{{ route('panel.adminer.orders', ['status' => 'I']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سفارشات نا معین</a> </li>
                    <li> <a href="{{ route('panel.adminer.orders', ['status' => 'Q']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سفارشات در صف بررسی و ارسال</a> </li>
                    <li> <a href="{{ route('panel.adminer.orders', ['status' => 'R']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سفارشات تایید شده</a> </li>
                    <li> <a href="{{ route('panel.adminer.orders', ['status' => 'S']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سفارشات مرحله آماده سازی</a> </li>
                    <li> <a href="{{ route('panel.adminer.orders', ['status' => 'T']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سفارشات خروج از انبار</a> </li>
                    <li> <a href="{{ route('panel.adminer.orders', ['status' => 'U']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سفارشات توزیع شهری</a> </li>
                    <li> <a href="{{ route('panel.adminer.orders', ['status' => 'W']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سفارشات تحویل مشتری</a> </li>
                    <li> <a href="{{ route('panel.adminer.orders', ['status' => 'B']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سفارشات برگشت خورده</a> </li>
                    <li> <a href="{{ route('panel.adminer.orders', ['status' => 'D']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سفارشات رد شده</a> </li>
                    <li> <a href="{{ route('panel.adminer.orders', ['status' => 'Z']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>سفارشات لغو شده</a> </li>
                </ul>
            </li>
            
            <li class=" {{ ($userType == 'A' || $userType == 'P' || $userType == 'C') ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> کارخانه <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('panel.adminer.manufactor.updateOrInsert', ['manufacturerid' => null]) }}"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>اضافه کردن تولید کننده جدید</a> </li>
                    <li> <a href="{{ route('panel.adminer.suppliers') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>لیست تولید کنندگان</a> </li>
                </ul>
            </li>
            
            <li class=" {{ ($userType == 'A' || $userType == 'P' || $userType == 'B') ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> فروشندگان <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                        <li> <a href="{{ route('panel.adminer.login.factory') }}?factory=989130000000">سرام پخش</a> </li>
                </ul>
            </li>

            <li class=" {{ ($userType == 'A' || $userType == 'P' || $userType == 'B') ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> لیست کارخانه ها <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <?php $factories = App\Models\Manufactory::where('manufacturerid','>',0)->select('manufacturer', 'manufacturerid', 'user_login')->get(); ?>
                    @foreach ($factories as $factory)
                        <li> <a href="{{ route('panel.adminer.login.factory') }}?factory={{$factory->user_login}}">{{$factory->manufacturer}}</a> </li>
                    @endforeach
                </ul>
            </li>

            <li class=" {{ ($userType == 'A' || $userType == 'P' || $userType == 'B') ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> نظرات کاربران <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('panel.adminer.reviews', ['type' => 'poduct']) }}"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>نظرات محصولات</a> </li>
                    <li> <a href="{{ route('panel.adminer.reviews', ['type' => 'decor']) }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>نظرات دکور ها</a> </li>
                </ul>
            </li>
            
            <li class=" {{ ($userType == 'A' || $userType == 'P') ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> کد های تخفیف <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('panel.adminer.discounts') }}" class="small"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>لیست کد های تخفیف</a> </li>
                </ul>
            </li>

            <li class=" {{ ($userType == 'A' || $userType == 'P') ? '' : 'disabled' }} "> 
                <a href="" class="waves-effect " class="small">
                    <i class="fa fa-product-hunt zmdi-hc-fw fa-fw"></i> 
                    <span class="hide-menu"> اطلاع رسانی ها <span class="fa arrow"></span></span>
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