<form class="floating-labels col-md-8 offset-md-2 ajaxForm" action="{{ route('panel.seller.admin.step.5.post') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$seller->id}}">
    <input type="hidden" name="ajax" value="ajax">
    <div class="row">
        
        <div class="form-group col-md-12 mb-5 float-left">
            <textarea name="about" class="form-control" id="about" rows="5">{{ $seller->about }}</textarea>
            <span class="highlight"></span> <span class="bar"></span>
            <label for="about">درباره فروشگاه</label>
            <span class="help-block text-danger small error-about"></span>
        </div>

        <div class="form-group col-md-12 mb-5 float-left">
            <textarea name="meta_keywords" class="form-control" id="meta_keywords" rows="5">{{ $seller->meta_keywords }}</textarea>
            <span class="highlight"></span> <span class="bar"></span>
            <label for="meta_keywords">متا کیورد</label>
            <span class="help-block text-danger small error-meta_keywords"></span>
        </div>
        <div class="form-group col-md-12 mb-5 float-left">
            <textarea name="meta_description" class="form-control" id="meta_description" rows="5">{{ $seller->meta_description }}</textarea>
            <span class="highlight"></span> <span class="bar"></span>
            <label for="meta_description">متا توضیحات</label>
            <span class="help-block text-danger small error-meta_description"></span>
        </div>
    </div>
    
    <button type="submit" class="btn btn-success waves-effect waves-light mt-4 m-l-10 btn-block">ویرایش</button>
    

</form>