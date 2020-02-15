@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') @endsection
@section('content') 
<div class="white-box table-responsive">

    <div class="row">
        <div class="col-md-6">
            {{--  <form action="{{ route('list.order.merchant') }}" method="GET">
                <div class="row">
                    <div class="col-10">
                        <input type="text" name="order" class="form-control" localhomeholder="جستجو  ( نام، ... )">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>  --}}
        </div>
    </div>
    <hr>
    <table class="table color-bordered-table inverse-bordered-table">
        <thead>
            <tr>
                <th>#</th>
                <th>سفارش دهنده</th>
                <th>نام محصول</th>
                <th>شهر</th>
                <th>تلفن</th>
                <th>تعداد</th>
                <th>قیمت (ریال)</th>
                <th>تاریخ</th>
                <th>وضعیت</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $key => $order)
                <tr id="delete-{{ $order->orderid }}">
                    <td>{{$order->orderid}}</td>
                    <td>{{$order->order->firstname}} {{$order->order->lastname}}</td>
                    <td>{{$order->product->product}}<br>{{$order->productcode}}</td>
                    <td>{{$order->order->s_city}}</td>
                    <td>{{$order->order->phone}}</td>
                    <td>{{$order->amount}}</td>
                    <td>{{number_format($order->price)}} ریال</td>
                    <td>{{date('Y-m-d H:i:s', $order->order->date)}}</td>
                    <td>
                        {{$order->order->status}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">
                        <div class="alert alert-danger text-center">
                            هیچ سفارشی موجود نیست
                        </div>
                    </td>
                </tr>
            @endforelse
            
        </tbody>
        <tfoot>
                
        </tfoot>
    </table>
    <div class="row text-center">
        {{ $orders->appends($_GET)->links() }}
    </div>
</div>
@endsection
@section('js') @endsection

