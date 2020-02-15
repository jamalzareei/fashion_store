<form action="{{ route('edit.product.step.2.supplier.post') }}" method="POST" class="dropzone" id="dropzone" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="productid" value="{{ $product->productid }}">
    <div class="fallback">
        <input name="file" type="file" multiple>
    </div>
</form>
<div class="popup-gallery m-t-30" id="showListGallery">
        {{--  <pre> {{var_dump($product->images)}}</pre>  --}}
    @forelse ($product->images as $image)
        @include('admin.components.image-gallery-product-suppliers', [ 'image' => $image])
    
    @empty
        <div class="alert alert-warning"> فایلی آپلود نشده است. </div>
    @endforelse
</div>