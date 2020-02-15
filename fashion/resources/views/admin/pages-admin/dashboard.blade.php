@extends('admin.layouts.master')

@section('title')
    پنل
@endsection

@section('css')
    
@endsection

@section('content')


<div class="row">
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="white-box bg-info">
            <h3 class="box-title">کاربران</h3>
            <ul class="list-inline two-part">
                <li><i class="icon-people text-info"></i></li>
                <li class="text-left"><span class="counter">{{number_format($data['usersCount'])}}</span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="white-box bg-danger">
            <h3 class="box-title">محصولات</h3>
            <ul class="list-inline two-part">
                <li><i class="icon-folder text-purple"></i></li>
                <li class="text-left"><span class="counter">{{number_format($data['productsCount'])}}</span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="white-box bg-success">
            <h3 class="box-title">تولید کنندگان</h3>
            <ul class="list-inline two-part">
                <li><i class="icon-folder-alt text-danger"></i></li>
                <li class="text-left"><span class="counter">{{number_format($data['suppliersCount'])}}</span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="white-box bg-warning">
            <h3 class="box-title">  نمایندگان (فروشندگان و  نصابان)</h3>
            <ul class="list-inline two-part">
                <li><i class="ti-wallet text-success"></i></li>
                <li class="text-left"><span class="counter">{{number_format($data['merchantsCount'])}}</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="panel panel-danger">
            <div class="panel-heading">آخرین کاربران</div>
            <div class="panel-body pt-5 row">
                <table class="table color-bordered-table inverse-bordered-table">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">#</th>
                            <th class="text-center">کاربر</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['usersConfirm'] as $key => $user)
                            <tr id="row-{{ $user->login }}">
                                <th class="text-center">
                                    {{$key+1}}
                                </th>
                                <th class="text-center">{{$user->login}}</th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-danger text-center">
                                        هیچ کاربری وجود ندارد.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-success">
            <div class="panel-heading">نظرات تایید نشده محصولات</div>
            <div class="panel-body pt-5 row">
                <table class="table color-bordered-table inverse-bordered-table">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">#</th>
                            <th class="text-center">IP</th>
                            <th class="text-center">نام</th>
                            <th class="text-center">ایمیل</th>
                            <th class="text-center">لینک صفحه</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['reviewsPoductsActive'] as $key => $review)
                            <tr id="row-{{$review->review_id}}">
                                <th class="text-center">
                                    {{$review->review_id}}
                                </th>
                                <th class="text-center">
                                    {{$review->remote_ip}}
                                </th>
                                <th class="text-center">
                                    {{$review->name}}
                                </th>
                                <th class="text-center">
                                    {{$review->email}}
                                </th>
                                <th class="text-center">
                                    <a href="https://cerampakhsh.com/product/{{($review['product']) ? $review['product']->slug : ''}}" target="_blank">لینک صفحه</a>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-danger text-center">
                                        نظری ثبت نشده است
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-5">
        <div class="panel panel-success">
            <div class="panel-heading">نظرات تایید نشده دکور ها</div>
            <div class="panel-body pt-5 row">
                <table class="table color-bordered-table inverse-bordered-table">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">#</th>
                            <th class="text-center">IP</th>
                            <th class="text-center">نام</th>
                            <th class="text-center">ایمیل</th>
                            <th class="text-center">لینک صفحه</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['reviesDecorsActive'] as $key => $review)
                            <tr id="row-{{$review->id}}">
                                <th class="text-center">
                                    {{$review->id}}
                                </th>
                                <th class="text-center">
                                    {{$review->remote_ip}}
                                </th>
                                <th class="text-center">
                                    {{$review->name}}
                                </th>
                                <th class="text-center">
                                    {{$review->email}}
                                </th>
                                <th class="text-center">
                                    <a href="https://cerampakhsh.com/decor/{{($review['decor']) ? $review['decor']->slug : ''}}" target="_blank">لینک صفحه</a>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-danger text-center">
                                        نظری ثبت نشده است
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row row-in">
    <div class="col-lg-3 col-sm-6 row-in-br">
        <div class="col-in row white-box">
            <div class="col-md-6 col-sm-6 col-6"> <i class="ti-user"></i>
                <h5 class="text-muted vb">جمع کل سفارشات</h5> </div>
            <div class="col-md-6 col-sm-6 col-6">
                <h5 class="counter text-left m-t-15 text-danger">{{number_format($data['ordersSubtotal'])}} ریال</h5>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-sm-6 row-in-br  b-l-none">
        <div class="col-in row white-box">
            <div class="col-md-6 col-sm-6 col-6"> <i class="ti-pencil-alt"></i>
                <h5 class="text-muted vb">تعداد کل سفارشات</h5> </div>
            <div class="col-md-6 col-sm-6 col-6">
                <h3 class="counter text-left m-t-15 text-info">{{number_format($data['ordersCount'])}}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 row-in-br">
        <div class="col-in row white-box">
            <div class="col-md-6 col-sm-6 col-6"> <i class="ti-mouse-alt"></i>
                <h5 class="text-muted vb">سبد های در انتظار موجودی</h5> </div>
            <div class="col-md-6 col-sm-6 col-6">
                <h3 class="counter text-left m-t-15 text-success">{{number_format($data['ordersEGCount'])}}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6  b-0">
        <div class="col-in row white-box">
            <div class="col-md-6 col-sm-6 col-6"> <i class="ti-receipt"></i>
                <h5 class="text-muted vb">سفارشات در انتظار</h5> </div>
            <div class="col-md-6 col-sm-6 col-6">
                <h3 class="counter text-left m-t-15 text-warning">{{number_format($data['ordersQCount'])}}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">سبد خریدها در انتظار موجودی</div>
            <div class="panel-body pt-5 row">
                <table class="table color-bordered-table inverse-bordered-table">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">شماره سفارش</th>
                            <th class="text-center">کاربر</th>
                            <th class="text-center">تاریخ سفارش</th>
                            <th class="text-center">تعداد محصول</th>
                            <th class="text-center">مبلغ سفارش (با 9% مالیات)</th>
                            <th class="text-center">وضعیت</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['ordersEG'] as $key => $order)
                            <tr id="delete-{{ $order->orderid }}">
                                <td>{{$order->orderid}}</td>
                                <td>{{$order->login}}</td>
                                <td class="text-center">{{Verta($order->date)}}</td>
                                <td>{{$order->orderdetails_count}}</td>
                                <td>{{$order->subtotal+$order->tax}} ريال</td>
                                <td class="text-center">{{$order->status}}</td>
                                <td>
                                    <button onclick="delete_('{{ route('panel.adminer.order.delete', ['orderid'=>$order->orderid]) }}', '{{ route('panel.adminer.orders.e.g') }}')" class="btn btn-youtube waves-effect btn-circle float-left waves-light"><i class="fa fa-times"></i> </button>
                                    <a class="btn btn-twitter waves-effect btn-circle waves-light" title="ویرایش" data-title="ویرایش" href="{{ route('panel.adminer.order.e.g.edit', ['orderid'=>$order->orderid]) }}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-danger text-center">
                                        هیچ سفارشی وجود ندارد.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                    <tfoot>
                            
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">سفارشات در انتظار تایید</div>
            <div class="panel-body pt-5 row">
                <table class="table color-bordered-table inverse-bordered-table">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">شماره سفارش</th>
                            <th class="text-center">کاربر</th>
                            <th class="text-center">تاریخ سفارش</th>
                            <th class="text-center">تعداد محصول</th>
                            <th class="text-center">مبلغ سفارش (با 9% مالیات)</th>
                            <th class="text-center">وضعیت</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['ordersQ'] as $key => $order)
                            <tr id="delete-{{ $order->orderid }}">
                                <td>{{$order->orderid}}</td>
                                <td>{{$order->login}}</td>
                                <td class="text-center">{{Verta($order->date)}}</td>
                                <td>{{$order->orderdetails_count}}</td>
                                <td>{{$order->subtotal+$order->tax}} ريال</td>
                                <td class="text-center">{{$order->status}}</td>
                                <td>
                                    <button onclick="delete_('{{ route('panel.adminer.order.delete', ['orderid'=>$order->orderid]) }}', '{{ route('panel.adminer.orders.e.g') }}')" class="btn btn-youtube waves-effect btn-circle float-left waves-light"><i class="fa fa-times"></i> </button>
                                    <a class="btn btn-twitter waves-effect btn-circle waves-light" title="ویرایش" data-title="ویرایش" href="{{ route('panel.adminer.order.edit', ['orderid'=>$order->orderid]) }}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-danger text-center">
                                        هیچ سفارشی وجود ندارد.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                    <tfoot>
                            
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    
@endsection
