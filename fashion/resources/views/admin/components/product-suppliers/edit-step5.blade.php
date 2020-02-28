<form class="mt-5 ajaxForm card pt-5 pb-0 mb-5 px-3" action="{{ route('panel.product.admin.step.5.post') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$product->id}}">
    <input type="hidden" name="ajax" value="ajax">
    <div class="row">
                    
            <div class="form-group mb-5 col-md-6">
                <label for="price"> قیمت اصلی به ریال </label>
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
                    <input type="text" class="form-control" id="count" name="count"  value="{{ $price ? $price->count : '' }}">
                    <div class="input-group-addon p-0" style="max-height: 38px !important;">
                        <select class="form-control w-100" name="unit" id="">
                            <option value="جین">جین</option>
                            <option value="عدد">عدد</option>
                        </select>
                    </div>
                </div>
                @error('count')
                    <span class="help-block text-danger small error-count">{{ $message }}</span>
                @else
                    <span class="help-block text-danger small error-count">&nbsp;</span>
                @enderror
            </div>
            
            <div class="form-group mb-5 col-md-2">
                <label for="tax">مالیات</label>
                <input type="text" class="form-control w-100" id="tax" name="tax" required value="{{ $price ? $price->tax : '' }}"><span class="highlight"></span> <span class="bar"></span>
                @error('tax')
                    <span class="help-block text-danger small error-tax">{{ $message }}</span>
                @else
                    <span class="help-block text-danger small error-tax">&nbsp;</span>
                @enderror
            </div>
            <div class="form-group mb-5  col-md-4">
                <label for="discount">تخفیف </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="discount" name="discount"  value="{{ $price ? $price->discount : '' }}">
                    <div class="input-group-addon p-0" style="max-height: 38px !important;">
                        <select class="form-control w-100" name="type_discount" id="">
                            <option value="PERSENT">درصد</option>
                            <option value="RIAL">ریال</option>
                        </select>
                    </div>
                </div>
                @error('discount')
                    <span class="help-block text-danger small error-discount">{{ $message }}</span>
                @else
                    <span class="help-block text-danger small error-discount">&nbsp;</span>
                @enderror
            </div>
             {{-- <div class="form-group mb-5 col-md-2">
                <label for="discount">درصد تخفیف</label>
                <input type="text" class="form-control" id="discount" name="discount" required value="{{ $price ? $price->discount : '' }}"><span class="highlight"></span> <span class="bar"></span>
                @error('discount')
                    <span class="help-block text-danger small error-discount">{{ $message }}</span>
                    @else
                        <span class="help-block text-danger small error-discount">&nbsp;</span>
                @enderror
            </div> --}}
            
            <div class="form-group mb-5 col-md-3">
                <label for="start_discount_at">تاریخ شروع تخفیف</label>
                <input type="text" class="form-control" id="start_discount_at" name="start_discount_at"  value="{{ $price ? $price->start_discount_at : '' }}"><span class="highlight"></span> <span class="bar"></span>
                @error('start_discount_at')
                    <span class="help-block text-danger small error-start_discount_at">{{ $message }}</span>
                @else
                    <span class="help-block text-danger small error-start_discount_at">&nbsp;</span>
                @enderror
            </div>
                
            <div class="form-group mb-5 col-md-3">
                <label for="end_discount_at">تاریخ پایان تخفیف</label>
                <input type="text" class="form-control" id="end_discount_at" name="end_discount_at"  value="{{ $price ? $price->end_discount_at : '' }}"><span class="highlight"></span> <span class="bar"></span>
                @error('end_discount_at')
                    <span class="help-block text-danger small error-end_discount_at">{{ $message }}</span>
                @else
                    <span class="help-block text-danger small error-end_discount_at">&nbsp;</span>
                @enderror
            </div> 
            <div class="form-group mb-5 pt-0 col-md-2">
                <label for="btn-submit">&nbsp;</label>
                <button type="submit" id="btn-submit" class="btn btn-success waves-effect btn-block waves-light m-l-10">ثبت</button>
            </div>

        </div>
    

    

</form>
<div id="loadPriceList">
    @include('admin.components.product-suppliers.list-price',['prices' => $product->prices])
</div>