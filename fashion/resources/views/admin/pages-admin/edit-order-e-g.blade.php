@extends('admin.layouts.master')

@section('title')
    
@endsection

@section('css')
    
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5 row">
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                    <a class="btn btn-block btn-info waves-effect mb-5" target="_blank" href="https://cerampakhsh.com/admin/order.php?orderid={{$order->orderid}}&mode=invoice"> <i class="fa fa-print"></i>چاپ صورت حساب</a>
                    <form class="floating-labels mt-5 ajaxForm" action="{{ route('panel.adminer.order.e.g.update', ['orderid' => $order->orderid]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">نام</th>
                                    <td>{{($order->address) ? $order->address->name : $order->firstname}}</td>
                                    <th scope="row">اطلاعات تماس</th>
                                    <td>{{($order->login)}}</td>
                                    <th scope="row">اطلاعات تماس</th>
                                    <td>{{($order->address) ? $order->address->phone : $order->login}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">استان</th>
                                    <td>{{($order->address) ? $order->address->state : $order->s_state}}</td>
                                    <th scope="row">شهر</th>
                                    <td>{{($order->address) ? $order->address->city : $order->s_city}}</td>
                                    <th scope="row">کد پستی</th>
                                    <td>{{($order->address) ? $order->address->zipe : $order->s_zipcode}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">آدرس</th>
                                    <td colspan="5">
                                        {{($order->address) ? $order->address->address : $order->s_address}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table color-bordered-table inverse-bordered-table">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center">کد محصول</th>
                                    <th class="text-center">نام محصول</th>
                                    <th class="text-center">تعداد درخواستی</th>
                                    <th class="text-center">قیمت</th>
                                    <th class="text-center">لینک محصول</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderdetails as $product)
                                    
                                    <tr class="">
                                        <th class="text-center">{{$product->productcode}}</th>
                                        <th class="text-center">{{$product->product}}</th>
                                        <th class="text-center">{{$product->amount}}</th>
                                        <th class="text-center">{{number_format($product->price*str_replace('/','.',$product->size)*$product->amount)}} ريال</th>
                                        <th class="text-center"><a href="https://cerampakhsh.com/product/{{$product->slug}}" target="_blank"><i class="fa fa-eye"></i></a></th>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div class="row px-5">
                                                <div class="radio radio-info radio-circle col-sm-4">
                                                    <input id="confirm-radio-{{$product->itemid}}" type="radio" checked name="details_support[{{$product->itemid}}]">
                                                    <label for="confirm-radio-{{$product->itemid}}"> تایید محصول </label>
                                                </div>
                                                <div class="radio radio-info radio-circle col-sm-4">
                                                    <div class="col">
                                                        <input id="change-radio-{{$product->itemid}}" type="radio" name="details_support[{{$product->itemid}}]" value="محصول تغییر یافته است">
                                                        <label for="change-radio-{{$product->itemid}}"> تغییر محصول <small>(برای تغییر محصول کد آن را با محصولات موجود جایگزین نمایید)</small></label>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <div class="col mt-2">
                                                        <small>کد محصول</small>
                                                        <input type="text" id="poductcode" class="form-control" name="productcode[{{$product->itemid}}]" value="{{$product->productcode}}" placeholder="کد محصول جایگزین را وارد نمایید">
                                                    </div>
                                                </div>
                                                <div class="radio radio-info radio-circle col-sm-4">
                                                    <input id="remove-radio-{{$product->itemid}}" type="radio"  name="details_support[{{$product->itemid}}]" value="محصول موجود نیست">
                                                    <label for="remove-radio-{{$product->itemid}}"> حذف محصول </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5">
                                        <div class="form-group col-md-6 mb-5 float-left">
                                            <label for="date_delivery" class="small">تاریخ تحویل انتخاب شده مشتری</label>
                                            <br>
                                            <input type="text" class="form-control" id="date_delivery" required name="date_delivery" value="{{$order->date_delivery}}" ><span class="highlight"></span> <span class="bar"></span>
                                            <span class="help-block text-danger small error-date_delivery"></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <button type="submit" class="btn btn-primary btn-block">ذخیره اطلاعات</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    
@endsection
