<form class="floating-labels mt-5 ajaxUpload" action="{{ route('panel.seller.admin.step.1.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $seller->id }}">
    <div class="form-group col-md-6 mb-5 float-left">
        <input type="text" class="form-control" id="name" required name="name" value="{{ $seller->name }}"><span class="highlight"></span> <span class="bar"></span>
        <label for="name">نام فروشگاه</label>
        <span class="help-block text-danger small error-name"></span>
    </div>
    <div class="form-group col-md-6 mb-5 float-left">
        <input type="text" class="form-control" id="slug" required name="slug" value="{{ $seller->slug }}"><span class="highlight"></span> <span class="bar"></span>
        <label for="slug">نام اختصاصی</label>
        <span class="help-block text-danger small error-slug"></span>
    </div>
    <div class="form-group col-md-6 mb-5 float-left">
        <input type="text" class="form-control" id="manager" required name="manager" value="{{ $seller->manager }}" ><span class="highlight"></span> <span class="bar"></span>
        <label for="manager">نام مدیریت</label>
        <span class="help-block text-danger small error-manager"></span>
    </div>
    <div class="form-group col-md-6 mb-5 float-left">
        <input type="text" class="form-control" id="username" required name="username" value="{{ $seller->user->username }}"><span class="highlight"></span> <span class="bar"></span>
        <label for="username">نام کاربری فروشنده (کاربر)</label>
        <span class="help-block text-danger small error-username"></span>
    </div>

    <div class="form-group  row w-100">
        <label for="imageUrl">عکس فروشگاه</label>
        <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload" data-default-file="{{($seller->image && $seller->image[0]) ? asset($seller->image[0]->path) : ''}}">
        <small>
            <div class="form-control-feedback text-danger error-imageUrl"></div>
        </small>
        
    </div>
    

    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">افزودن</button>
    {{--  <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>  --}}
</form>