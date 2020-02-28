<form action="{{ route('panel.product.admin.step.3.post') }}" method="POST" class="ajaxForm" id="dropzone" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="form-group col-md-12 m-b-5 mt-5 float-right">
        <label for="description_short">توضیحات کوتاه</label>
        <textarea class="form-control" rows="4" id="description_short" required name="description_short"  value="">{{ ($product->description_short) }}</textarea><span class="highlight"></span> <span class="bar"></span>
        <span class="help-block text-danger small error-description_short"></span>
    </div>
    
    <div class="form-group col-md-12 m-b-5 mt-5 float-right">
        <label for="description_full">توضیحات کامل</label>
        <textarea class="form-control" rows="4" id="description_full" required name="description_full"  value="">{{ ($product->description_full) }}</textarea><span class="highlight"></span> <span class="bar"></span>
        <span class="help-block text-danger small error-description_full"></span>
    </div>
    <div class="form-group col-md-12 m-b-5 mt-5 float-right">
        <label for="meta_keywords">متا کیورد</label>
        <textarea class="form-control" rows="4" id="meta_keywords" required name="meta_keywords"  value="">{{ ($product->meta_keywords) }}</textarea><span class="highlight"></span> <span class="bar"></span>
        <span class="help-block text-danger small error-meta_keywords"></span>
    </div>
    
    <div class="form-group col-md-12 m-b-5 mt-5 float-right">
        <label for="meta_description">متا توضیحات </label>
        <textarea class="form-control" rows="4" id="meta_description" required name="meta_description"  value="">{{ ($product->meta_description) }}</textarea><span class="highlight"></span> <span class="bar"></span>
        <span class="help-block text-danger small error-meta_description"></span>
    </div>
    
    
    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ویرایش</button>
</form>