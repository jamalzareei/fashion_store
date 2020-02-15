<form class="floating-labels mt-5 ajaxUpload" action="{{ route('edit.product.step.1.merchant.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="productid" value="{{$product->productid}}">
    <div class="form-group col-md-6 mb-5 float-left">
        <input type="text" class="form-control" id="product" required name="product"  value="{{$product->product}}"><span class="highlight"></span> <span class="bar"></span>
        <label for="product">نام محصول</label>
        <span class="help-block text-danger small error-product"></span>
    </div>
    <div class="form-group col-md-6 mb-5 float-left">
        <input type="text" class="form-control" id="productcode" required name="productcode" value="{{$product->productcode}}"><span class="highlight"></span> <span class="bar"></span>
        <label for="productcode">کد محصول</label>
        <span class="help-block text-danger small error-productcode"></span>
    </div>
    <div class="form-group col-md-6 mb-5 float-left">
        @include('admin.components.category', ['categories' => $categories])
        <div class="row">
            @foreach ($product->categories as $cat)
                <span class="label label-info m-r-5">{{$cat->category}}</span>
            @endforeach
        </div>
    </div>
    <div class="form-group col-md-6 mb-5 float-left">
        <select class="form-control " id="suppliers-select" name="manufacturerid">
            <option > -- انتخاب تولید کننده --</option>
            @foreach ($suppliers as $supp)
                <option value="{{ $supp->manufacturerid }}" @if($product->manufacturerid == $supp->manufacturerid) selected @endif >{{ $supp->manufacturer }}</option>
            @endforeach
        </select>
        {{--  <input type="text" class="form-control" id="manufacturerid" required name="manufacturerid" ><span class="highlight"></span> <span class="bar"></span>  --}}
        <label for="manufacturerid">کارخانه ( تولید کننده )</label>
        <span class="help-block text-danger small error-manufacturerid"></span>
    </div>

    <div class="form-group  row w-100">
        <label for="imageUrl">عکس محصول</label>
        <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload" data-default-file="{{str_replace('/var/www/vhosts/cerampakhsh.com/httpdocs/','',$product->thumbnail->image_path)}}">
        <small>
            <div class="form-control-feedback text-danger error-imageUrl"></div>
        </small>
        
    </div>

    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ویرایش</button>
    {{--  <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>  --}}
</form>