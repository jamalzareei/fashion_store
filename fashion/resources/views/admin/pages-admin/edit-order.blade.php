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
                    <form class="form-inline ajaxForm mb-5" action="{{ route('panel.adminer.order.update', ['orderid'=>$order->orderid]) }}" method="post" name="changeOrder">
                        @csrf
                        <select name="status" class="form-control" >
                            <option {{($order->status == "I") ? "selected" : ""}} value="I">نامعين</option>
                            <option {{($order->status == "Q") ? "selected" : ""}} value="Q" selected="">در صف بررسي قرار گرفته</option>
                            <option {{($order->status == "R") ? "selected" : ""}} value="R">تایید سفارش</option>
                            <option {{($order->status == "S") ? "selected" : ""}} value="S">آماده سازی سفارش</option>
                            <option {{($order->status == "T") ? "selected" : ""}} value="T">خروج از انبار</option>
                            <option {{($order->status == "U") ? "selected" : ""}} value="U">دریافت در مرکز توزیع شهر شما</option>
                            <option {{($order->status == "V") ? "selected" : ""}} value="V">تحویل به مامور پست</option>
                            <option {{($order->status == "W") ? "selected" : ""}} value="W">تحویل مرسوله به مشتری</option>
                            <option {{($order->status == "P") ? "selected" : ""}} value="P">بررسي شده و به اتمام رسيده</option>
                            <option {{($order->status == "B") ? "selected" : ""}} value="B">برگشت خورده</option>
                            <option {{($order->status == "D") ? "selected" : ""}} value="D">مورد پذيرش قرار نگرفته</option>
                            <option {{($order->status == "F") ? "selected" : ""}} value="F">مردود شده</option>
                            <option {{($order->status == "C") ? "selected" : ""}} value="C">كامل كردن</option>
                        </select>

                        <button class="btn btn-primary" type="submit">ذخیره اطلاعات</button>
                    </form>
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
                                        <th class="text-center">{{($product->price*$product->amount*str_replace('/','.',$product->size))}} ريال </th>
                                        <th class="text-center"><a href="https://cerampakhsh.com/product/{{$product->slug}}" target="_blank"><i class="fa fa-eye"></i></a></th>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">تاریخ تحویل انتخاب شده مشتری</th>
                                    <td>{{$order->date_delivery}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">جمع کالاها</th>
                                    <td>{{(number_format($order->subtotal))}} ريال</td>
                                </tr>
                                <tr>
                                    <th scope="row">9% مالیات</th>
                                    <td>{{number_format($order->tax)}} ريال</td>
                                </tr>
                                <tr>
                                    <th scope="row">جمع کل پرداختی</th>
                                    <td>{{number_format($order->subtotal+$order->tax)}} ريال</td>
                                </tr>
                                <tr>
                                    <th scope="row">نوع پرداخت</th>
                                    <td>{{$order->payment_method}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class=""></div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    
@endsection
