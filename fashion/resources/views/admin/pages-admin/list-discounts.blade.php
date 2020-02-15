@extends('admin.layouts.master')

@section('title')
@endsection

@section('css')
    
<link href="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">

<link href="{{asset('panel/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet">

<link href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <form class="row w-100" action="{{ route('panel.adminer.discounts.add') }}" method="post">
                        @csrf
                        <div class="col-md-3 form-group">
                            @error('coupon')
                                <div class="w-100 help-block text-danger small error-coupon">{{ $message }}</div>
                            @else
                                <div class="w-100 help-block text-info small error-coupon">کد تخفیف</div>
                            @enderror
                            <input type="text" name="coupon" class="form-control w-100" placeholder="کد تخفیف" value="{{old('coupon')}}">
                        </div>
                        <div class="col-md-3 form-group">
                            @error('expire')
                                <div class="w-100 help-block text-danger small error-expire">{{ $message }}</div>
                            @else
                                <div class="w-100 help-block text-info small error-expire"> تاریخ انقضا</div>
                            @enderror
                            <input type="text" name="expire" class="form-control mydatepicker" dir="ltr" placeholder="تاریخ انقضا" value="{{old('expire')}}">
                        </div>
                        <div class="col-md-3 form-group">
                            @error('times')
                                <div class="w-100 help-block text-danger small error-times">{{ $message }}</div>
                            @else
                                <div class="w-100 help-block text-info small error-times"> تعداد دفعات استفاده</div>
                            @enderror
                            <input type="text" name="times" class="form-control" placeholder="تعداد دفعات استفاده" value="{{old('times')}}">
                        </div>
                        <div class="col-md-2 form-group">
                            <div class="w-100 help-block text-info small error-orderby"> فعال یا غیر فعال </div>
                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox"  checked name="status" value="Y">
                        </div>
                        <div class="col-md-3 form-group">
                            @error('discount')
                                <div class="w-100 help-block text-danger small error-discount">{{ $message }}</div>
                            @else
                                <div class="w-100 help-block text-info small error-discount"> مقدار تخفیف</div>
                            @enderror
                            <div class="input-group">
                                <input type="number" name="discount"  class="form-control" id="discount" aria-describedby="basic-addon3" placeholder="مقدار تخفیف" value="{{old('discount')}}">
                                <span class="input-group-addon" id="basic-addon3">
                                    <select name="coupon_type" id="coupon_type" class="">
                                        <option value="percent">درصد</option>
                                        <option value="absolute">ریال</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            @error('categoryid')
                                <div class="w-100 help-block text-danger small error-categoryid">{{ $message }}</div>
                            @else
                                <div class="w-100 help-block text-info small error-categoryid"> دسته بندی</div>
                            @enderror
                            <select name="categoryid" id="categoryid" class="form-control">
                                <option value="">انتخاب برای دسته بندی</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->categoryid}}">{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            @error('productcode')
                                <div class="w-100 help-block text-danger small error-productcode">{{ $message }}</div>
                            @else
                                <div class="w-100 help-block text-info small error-productcode"> کد محصول</div>
                            @enderror
                            <input type="text" name="productcode" class="form-control" placeholder="کد محصول" value="{{old('productcode')}}">
                        </div>
                        <div class="col-md-2 form-group">
                            @error('minimum')
                                <div class="w-100 help-block text-danger small error-minimum">{{ $message }}</div>
                            @else
                                <div class="w-100 help-block text-info small error-minimum"> حداقل مقدار سفارش</div>
                            @enderror
                            <input type="text" name="minimum" class="form-control" placeholder="حداقل مقدار سفارش" value="{{old('minimum')}}">
                        </div>
                        <div class="col-md-2 form-group">
                            <div class="w-100 help-block text-info small error-orderby"> &nbsp;</div>
                            <button type="submit" class="btn btn-info">افزودن</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        <hr>
        <div class="panel panel-danger">
            <div class="panel-heading"> {{ $title }}</div>
            <div class="panel-body pt-5 row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                    <form action="{{ route('panel.adminer.discounts.update') }}" method="post">
                        @csrf
                        <table class="table color-bordered-table inverse-bordered-table">
                            <thead>
                                <tr>
                                    <td colspan="7">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    {{--  <th class="text-center">#</th>  --}}
                                    <th class="text-center">کد تخفیف</th>
                                    <th class="text-center">مقدار تخفیف</th>
                                    <th class="text-center">فعال</th>
                                    <th class="text-center">تاریخ انقضا</th>
                                    <th class="text-center">تعداد باقی مانده</th>
                                    <th class="text-center">اختصاص به(محصول / دسته بندی)</th>
                                    <th class="text-center"> عملیات </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($discounts as $key => $code)
                                    <tr id="row-{{ $code->coupon }}">
                                        <th class="text-center">
                                            {{$code->coupon}}
                                        </th>
                                        <th class="text-center">
                                            <div class="input-group">
                                                <input type="number" name="data[{{$code->coupon}}][discount]" class="form-control" id="discount{{$code->coupon}}" value="{{$code->discount}}" aria-describedby="basic-addon3" placeholder="مقدار تخفیف" value="{{old('discount')}}">
                                                <span class="input-group-addon" id="basic-addon3">
                                                    <select name="data[{{$code->coupon}}][coupon_type]" id="coupon_type{{$code->coupon}}" class="">
                                                        <option value="percent" {{($code->coupon_type == "percent") ? "selected" : ""}}>درصد</option>
                                                        <option value="absolute" {{($code->coupon_type == "absolute") ? "selected" : ""}}>ریال</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$code->coupon}}][status]" {{($code->status == 'Y') ? 'checked' : ''}} value="Y">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" class="form-control mydatepicker2" name="data[{{$code->coupon}}][expire]" id="expire{{$code->coupon}}" value="{{Verta($code->expire)->format('Y/m/d')}}">
                                        </th>
                                        <th class="text-center" width="100">
                                            <input type="number" class="form-control" name="data[{{$code->coupon}}][times]" id="times{{$code->coupon}}" value="{{$code->times}}">
                                        </th>
                                        <th class="text-center">
                                            {{($code->product) ? $code->product->productcode : ''}}
                                            <br>
                                            {{($code->category) ? $code->category->category : ''}}
                                        </th>
                                        <th class="text-center">
                                            <i onclick="delete_('{{ route('panel.adminer.discount.delete', ['coupon'=>$code->coupon]) }}', '{{ route('panel.adminer.discounts') }}')" class="btn btn-youtube waves-effect btn-circle float-left waves-light"><i class="fa fa-times"></i> </i>
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-danger text-center">
                                                هیچ پراپرتی وجود ندارد
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
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
    
<script src="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.js')}}"></script>

<script src="{{asset('panel/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script type="text/javascript">
    $('.js-switch').bootstrapSwitch();
</script>


<script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
<script>
		jQuery('.mydatepicker, #datepicker').persianDatepicker({
            orientation: 'right',
            altFormat: "L",
            //calendar.persian.locale: 'fa',
            observer: true,
            format: 'L',
            timePicker: {
                enabled: false
            }
		});
</script>
@endsection
