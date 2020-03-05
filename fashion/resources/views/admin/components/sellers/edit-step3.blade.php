<form action="{{ route('panel.seller.admin.step.3.post') }}" method="POST" class="ajaxForm floating-labels mt-5" id="dropzone" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $seller->id }}">
    
    <div class="form-group col-md-12 mb-5 float-left">
        <input type="text" class="form-control" value="{{ $seller->phones }}" id="phones" data-role="tagsinput" name="phones" ><span class="highlight"></span> <span class="bar"></span>
        <label for="phones">شماره تماس های فروشگاه</label>
        <span class="help-block text-danger small error-phones"></span>
    </div>
    
    @include('admin.components.location', ['countries' => $countries, 'seller' => $seller])

    
    <div class="form-group col-md-12 mb-5 float-left">
        <textarea name="address" class="form-control" id="address" rows="5">{{ $seller->address }}</textarea>
        <span class="highlight"></span> <span class="bar"></span>
        <label for="address">آدرس شعبه</label>
        <span class="help-block text-danger small error-address"></span>
    </div>
    
    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ویرایش</button>
</form>