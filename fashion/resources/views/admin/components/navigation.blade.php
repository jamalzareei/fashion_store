<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part text-center">
            <a class="logo" href="{{ route('home') }}"><img src="{{ asset('public/logo-300300.png') }}" width="85" height="60" alt="home"></a>
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs active">
            <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="ti-menu"></i></a></li>
            <li class="in">
                <form role="search" class="app-search hidden-xs">
                    <input type="text" placeholder="جستجو ..." class="form-control">
                    <a href="" class="active"><i class="fa fa-search"></i></a>
                </form>
            </li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-left">
            <li class="dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-envelope"></i>
                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                </a>
                <ul class="dropdown-menu mailbox scale-up">
                    <?php 
                    $login = auth()->user()->login;
                    $messages = \App\Models\Message::where(function($query_1){
                        $query_1->where('type_user', null)->orWhere('type_user','manufacturer');
                    })
                    ->where(function($query_2) use($login){
                        $query_2->where('recive_login', null)->orWhere('recive_login',$login);
                    })
                    ->select('kimiagar_message_user.message_id','kimiagar_messages.*')
                    // ->with('user')
                    ->leftJoin('kimiagar_message_user','kimiagar_message_user.message_id','kimiagar_messages.id')
                    ->with('sender')
                    ->where('message_id', null)
                    ->groupBy('kimiagar_messages.id')
                    // ->toSql();
                    ->get();
                
                    

                    ?>
                    <li>
                        <div class="drop-title">شما {{$messages->count()}} پیام جدید دارید</div>
                    </li>
                    <li>
                        <div class="message-center">
                            @forelse ($messages as $key => $ticket)
                                @if ($key <= 5)
                                    <a href="{{ route('suppliers.tickes') }}">
                                        <div class="mail-content">
                                            <h5>@if($ticket->sender){{$ticket->sender->firstname}} {{$ticket->sender->lastname}}@endif</h5>
                                            <span class="mail-desc">{{$ticket->title}}</span> <span class="time">{{$ticket->date}}</span> </div>
                                    </a>
                                @endif
                            @empty
                                شما هیچ پیغامی ندارید
                            @endforelse
                            
                        </div>
                    </li>
                    <li>
                        <a class="text-center" href="{{ route('suppliers.tickes') }}"> <strong>مشاهده همه پیام ها</strong> <i class="fa fa-angle-left"></i> </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> 
                    <img src="{{ asset('public/logo-300300.png') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">
                        {{(auth()->user()) ? auth()->user()->firstname : ''}} {{(auth()->user()) ? auth()->user()->lastname : ''}}
                </b> </a>
                <ul class="dropdown-menu dropdown-user scale-up">
                    {{--  <li><a href="#"><i class="ti-user"></i> پروفایل من</a></li>  --}}
                    {{--  <li><a href="#"><i class="ti-email"></i> لیست پیام ها</a></li>  --}}
                    {{--  <li role="separator" class="divider"> </li>  --}}
                    {{--  <li><a href="#"><i class="ti-settings"></i> تنظیمات حساب</a></li>  --}}
                    <li role="separator" class="divider"> </li>
                    <li><a href="{{ route('log-out') }}"><i class="fa fa-power-off"></i> خروج</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- .Megamenu -->
                <!-- /.Megamenu -->
                {{--  <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>  --}}
                <!-- /.dropdown -->
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>