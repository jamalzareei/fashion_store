@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') 

<style>
    .form-group {
        float: right;
    }
    </style>
@endsection
@section('content') 
<div class="white-box table-responsive">

    <div class="row">
        <div class="col-md-12">
            @if (request()->slugProduct && $product)
            <form class="mt-5 card pt-5 pb-0 mb-5 px-3" action="{{ route('add.price.supplier') }}" method="POST">
                @csrf
                <input type="hidden" name="productid" value="{{$product->productid}}">
                <div class="row">
                    
                    <div class="form-group mb-5 col-md-6">
                        <label for="price"> قیمت اصلی به ریال (<small class="text-danger"> قیمت وارد شده در این قسمت مربوط به انبار خود فروشنده میباشد.</small>)</label>
                        <input type="text" class="form-control w-100" id="price" name="price" required value="{{ $price ? $price->price : '' }}"><span class="highlight"></span> <span class="bar"></span>
                        @error('price')
                            <span class="help-block text-danger small error-price">{{ $message }}</span>
                        @else
                            <span class="help-block text-danger small error-price">&nbsp;</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-5  col-md-4">
                        <label for="exampleInputuname2">موجودی </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="avail" name="avail"  value="{{ $price ? $price->avail : '' }}">
                            <div class="input-group-addon p-0" style="max-height: 38px !important;">
                                <select class="form-control w-100" name="avail_type" id="">
                                    <option value="کارتن">کارتن</option>
                                    <option value="مترمربع">مترمربع</option>
                                    <option value="عدد">عدد</option>
                                </select>
                            </div>
                        </div>
                        @error('avail')
                            <span class="help-block text-danger small error-avail">{{ $message }}</span>
                        @else
                            <span class="help-block text-danger small error-avail">&nbsp;</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-5 col-md-2">
                        <label for="installation_costs">هزینه نصب (به ریال)</label>
                        <input type="text" class="form-control" id="installation_costs" name="installation_costs"  value="{{ $price ? $price->installation_costs : '' }}"><span class="highlight"></span> <span class="bar"></span>
                        @error('installation_costs')
                            <span class="help-block text-danger small error-installation_costs">{{ $message }}</span>
                        @else
                            <span class="help-block text-danger small error-installation_costs">&nbsp;</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5 col-md-2">
                        <label for="delivery_time">زمان تحویل ( روز)</label>
                        <input type="text" class="form-control" id="delivery_time" name="delivery_time"  value="{{ $price ? $price->delivery_time : '' }}"><span class="highlight"></span> <span class="bar"></span>
                        @error('delivery_time')
                            <span class="help-block text-danger small error-delivery_time">{{ $message }}</span>
                        @else
                            <span class="help-block text-danger small error-delivery_time">&nbsp;</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5 col-md-2">
                        <label for="discount">درصد تخفیف</label>
                        <input type="text" class="form-control" id="discount" name="discount" required value="{{ $price ? $price->discount : '' }}"><span class="highlight"></span> <span class="bar"></span>
                        @error('discount')
                            <span class="help-block text-danger small error-discount">{{ $message }}</span>
                            @else
                                <span class="help-block text-danger small error-discount">&nbsp;</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-5 col-md-3">
                        <label for="start_date">تاریخ شروع تخفیف</label>
                        <input type="text" class="form-control" id="start_date" name="start_date"  value="{{ $price ? $price->start_date : '' }}"><span class="highlight"></span> <span class="bar"></span>
                        @error('start_date')
                            <span class="help-block text-danger small error-start_date">{{ $message }}</span>
                            @else
                                <span class="help-block text-danger small error-start_date">&nbsp;</span>
                        @enderror
                    </div>
                        
                    <div class="form-group mb-5 col-md-3">
                        <label for="end_date">تاریخ پایان تخفیف</label>
                        <input type="text" class="form-control" id="end_date" name="end_date"  value="{{ $price ? $price->end_date : '' }}"><span class="highlight"></span> <span class="bar"></span>
                        @error('end_date')
                            <span class="help-block text-danger small error-end_date">{{ $message }}</span>
                            @else
                                <span class="help-block text-danger small error-end_date">&nbsp;</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5 pt-0 col-md-2">
                        <label for="btn-submit">&nbsp;</label>
                        <button type="submit" id="btn-submit" class="btn btn-success waves-effect btn-block waves-light m-l-10">ثبت</button>
                    </div>

                </div>
            </form>
            @endif
        </div>
    </div>
    <hr>
    @include('admin.components.product.list-price',['prices' => $product->prices])
    <div class="row text-center">
        
    </div>
</div>
@endsection
@section('js') @endsection

