<form action="{{ route('edit.product.step.3.supplier.post') }}" method="POST" class="ajaxForm" id="dropzone" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="productid" value="{{ $product->productid }}">
    <div class="form-group col-md-12 m-b-5 mt-5 float-right">
        <label for="descr">توضیحات کوتاه</label>
        <textarea class="form-control" rows="4" id="descr" required name="descr"  value="">{{ ($product->descr) }}</textarea><span class="highlight"></span> <span class="bar"></span>
        <span class="help-block text-danger small error-descr"></span>
    </div>
    
    <div class="form-group col-md-12 m-b-5 mt-5 float-right">
        <label for="fulldescr">توضیحات کامل</label>
        <textarea class="form-control" rows="4" id="fulldescr" required name="fulldescr"  value="">{{ ($product->fulldescr) }}</textarea><span class="highlight"></span> <span class="bar"></span>
        <span class="help-block text-danger small error-fulldescr"></span>
    </div>
    
    
    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ویرایش</button>
</form>