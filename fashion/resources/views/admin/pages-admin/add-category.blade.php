@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') 

<link rel="stylesheet" href="{{ asset('panel/assets/plugins/dropify/dist/css/dropify.min.css') }}">

<link href="{{ asset('panel/assets/plugins/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('panel/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content') 
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5">
                    <form class="floating-labels mt-5 ajaxUpload" action="{{$routePost}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6 mb-5 float-left">
                            <div class="form-group">
                                <input type="text" class="form-control" id="category" required name="category" value="{{($category) ? $category->category : ''}}" ><span class="highlight"></span> <span class="bar"></span>
                                <label for="category">نام دسته بندی</label>
                                <span class="help-block text-danger small error-category"></span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="link" name="link"  value="{{($category) ? $category->link : ''}}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="link">لینک اختصاصی</label>
                                <span class="help-block text-danger small error-link"></span>
                            </div>
                            <div class="row">
                                <div class="w-100">
                                    <div class="col-12">
                                        <div class="m-4 row w-100">
                                            <div class="checkbox checkbox-circle checkbox-danger w-100">
                                                <input id="checkbox_avail" type="checkbox" name="avail" value="Y" {{($category && $category->avail == 'Y') ? 'checked' : ''}}>
                                                <label for="checkbox_avail"> فعال </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="m-4 row w-100">
                                            <div class="checkbox checkbox-circle checkbox-success w-100">
                                                <input id="checkbox_is_menu" type="checkbox" name="is_menu" value="Y" {{($category && $category->is_menu == 'Y') ? 'checked' : ''}}>
                                                <label for="checkbox_is_menu"> نمایش در منوی سایت </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="m-4 row w-100">
                                            <div class="checkbox checkbox-circle checkbox-primary w-100">
                                                <input id="checkbox_is_filter" type="checkbox" name="is_filter" value="Y" {{($category && $category->is_filter == 'Y') ? 'checked' : ''}}>
                                                <label for="checkbox_is_filter"> نمایش در فیلتر ها </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="m-4 row w-100">
                                            <div class="checkbox checkbox-circle checkbox-primary w-100">
                                                <input id="checkbox_is_add" type="checkbox" name="is_add" value="Y" {{($category && $category->is_add == 'Y') ? 'checked' : ''}}>
                                                <label for="checkbox_is_add"> قابل انتخاب در دسته بندی اضافه کردن محصول </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <div class="form-group  row w-100">
                                <label for="imageUrl">عکس محصول</label>
                                @if ($category && $category->icon)
                                    <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload" data-default-file="https://cerampakhsh.com/{{str_replace('/var/www/vhosts/cerampakhsh.com/httpdocs/','',$category->icon->image_path)}}">
                                @else
                                    <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload">
                                @endif 
                                <small>
                                        <div class="form-control-feedback text-danger error-imageUrl"></div>
                                </small>
                            </div>
                            <div class="form-group">
                                {{--  <input type="text" class="form-control" id="link" required name="link" >  --}}
                                <textarea name="description" class="form-control" id="description" rows="5"> {{($category) ? $category->description : ''}}</textarea>
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="description">توضیحات</label>
                                <span class="help-block text-danger small error-description"></span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت اطلاعات</button>
                        {{--  <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>  --}}
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js') 
<script src="{{ asset('panel/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>

{{-- <script src="{{ asset('admin-theme/assets/plugins/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin-theme/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script> --}}
	<script>
		$(document).ready(function() {
			// Basic
			$('.dropify').dropify({
				messages: {
					default: 'یک فایل اینجا بکشید و یا کلیک کنید(حجم فایل کمتر از 300 کیلوبایت  )',
					replace: 'برای جایگزینی ، یک فایل اینجا بکشید و یا کلیک کنید(حجم فایل کمتر از 300 کیلوبایت  )',
					remove: 'حذف',
					error: 'خطا در ارسال فایل'
				}
			});

			// Used events
			var drEvent = $('#input-file-events').dropify();

			drEvent.on('dropify.beforeClear', function(event, element) {
				return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
			});

			drEvent.on('dropify.afterClear', function(event, element) {
				alert('File deleted');
			});

			drEvent.on('dropify.errors', function(event, element) {
				console.log('Has Errors');
			});

			var drDestroy = $('#input-file-to-destroy').dropify();
			drDestroy = drDestroy.data('dropify')
			$('#toggleDropify').on('click', function(e) {
				e.preventDefault();
				if (drDestroy.isDropified()) {
					drDestroy.destroy();
				} else {
					drDestroy.init();
				}
			})
		});
    </script>

    
    <script src="{{ asset('panel/assets/plugins/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript" src="{{ asset('panel/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script>
            $(".select2").select2();
    </script>
    @endsection

