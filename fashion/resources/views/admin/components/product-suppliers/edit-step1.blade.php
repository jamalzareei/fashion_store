<form class="floating-labels mt-5 ajaxUpload" action="{{ route('panel.product.admin.step.1.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$product->id}}">
    <div class="form-group col-md-6 mb-5 float-left">
        <input type="text" class="form-control" id="name" required name="name"  value="{{$product->name}}"><span class="highlight"></span> <span class="bar"></span>
        <label for="name">نام محصول</label>
        <span class="help-block text-danger small error-name"></span>
    </div>
    <div class="form-group col-md-6 mb-5 float-left">
        <input type="text" class="form-control" id="code" required name="code" value="{{$product->code}}"><span class="highlight"></span> <span class="bar"></span>
        <label for="code">کد محصول</label>
        <span class="help-block text-danger small error-code"></span>
    </div>
    <div class="form-group col-md-12 mb-5 float-left">
        @include('admin.components.category', ['categories' => $categories])
        <div class="row">
            @foreach ($product->categories as $cat)
                <span class="label label-info m-r-5">{{$cat->name}}</span>
            @endforeach
        </div>
    </div>

    <div class="form-group  row w-100">
        <label for="imageUrl">عکس محصول</label>
        <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload" data-default-file="{{($product->image && $product->image[0]) ? asset($product->image[0]->path) : ''}}">
        <small>
            <div class="form-control-feedback text-danger error-imageUrl"></div>
        </small>
        
    </div>

    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ویرایش</button>
    {{--  <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>  --}}
</form>