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
                            @forelse ($orders as $key => $order)
                                <tr id="delete-{{ $order->orderid }}">
                                    <td>{{$order->orderid}}</td>
                                    <td>{{$order->login}}</td>
                                    <td class="text-center">{{Verta($order->date)}}</td>
                                    <td>{{$order->orderdetails_count}}</td>
                                    <td>{{$order->subtotal+$order->tax}} ريال</td>
                                    <td class="text-center">{{$order->status}}</td>
                                    <td>
                                        <button onclick="delete_('{{ route('panel.adminer.order.delete', ['orderid'=>$order->orderid]) }}', '{{ route('panel.adminer.orders.e.g') }}')" class="btn btn-youtube waves-effect btn-circle float-left waves-light"><i class="fa fa-times"></i> </button>
                                        <a class="btn btn-twitter waves-effect btn-circle waves-light" title="ویرایش" data-title="ویرایش" href="{{ route($routeEdit, ['orderid'=>$order->orderid]) }}"><i class="fa fa-edit"></i></a>
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
                    <div class="row text-center">
                        {{ $orders->appends($_GET)->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
    
@endsection
