@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') @endsection
@section('content') 
<div class="white-box table-responsive">

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('list.product.supplier') }}" method="GET">
                <div class="row">
                    <div class="col-10">
                        <input type="text" name="product" class="form-control" localhomeholder="جستجو  ( نام، ... )">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <table class="table color-bordered-table inverse-bordered-table">
        <thead>
            <tr>
                <th>#</th>
                <th>کد محصول</th>
                <th>نام محصول</th>
                <th>تولید کننده</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $key => $product)
                <tr id="delete-{{ $product->productid }}">
                    <td>{{$key+1}}</td>
                    <td>{{$product->productcode}}</td>
                    <td>{{$product->product}}</td>
                    <td>{{$product->manufactory->manufacturer}}</td>
                    <td>
                            <a class="btn btn-primary" href="{{ route('list.price.supplier', ['slugProduct'=>$product->slug]) }}">قیمت گذاری</a>
                        
                        @if ($product->my_product_user)
                            <a class="btn btn-danger" title="ویرایش" data-title="ویرایش" href="{{ route('edit.product.supplier', ['slug'=>$product->slug]) }}"><i class="fa fa-edit"></i></a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="alert alert-danger text-center">
                            هیچ محصولی اضافه نشده است.
                        </div>
                    </td>
                </tr>
            @endforelse
            
        </tbody>
        <tfoot>
                
        </tfoot>
    </table>
    <div class="row text-center">
        {{ $products->appends($_GET)->links() }}
    </div>
</div>
@endsection
@section('js') @endsection