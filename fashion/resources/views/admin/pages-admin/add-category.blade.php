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
                                <input type="text" class="form-control" id="name" required name="name" value="{{($category) ? $category->name : ''}}" ><span class="highlight"></span> <span class="bar"></span>
                                <label for="name">نام دسته بندی</label>
                                <span class="help-block text-danger small error-name"></span>
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
                                                <input id="checkbox_active" type="checkbox" name="active" value="1" {{($category && $category->active == '1') ? 'checked' : ''}}>
                                                <label for="checkbox_active"> فعال </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="m-4 row w-100">
                                            <div class="checkbox checkbox-circle checkbox-success w-100">
                                                <input id="checkbox_menu" type="checkbox" name="menu" value="1" {{($category && $category->menu == '1') ? 'checked' : ''}}>
                                                <label for="checkbox_menu"> نمایش در منوی سایت </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="m-4 row w-100">
                                            <div class="checkbox checkbox-circle checkbox-primary w-100">
                                                <input id="checkbox_filter" type="checkbox" name="filter" value="1" {{($category && $category->filter == '1') ? 'checked' : ''}}>
                                                <label for="checkbox_filter"> نمایش در فیلتر ها </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="m-4 row w-100">
                                            <div class="checkbox checkbox-circle checkbox-primary w-100">
                                                <input id="checkbox_add_product" type="checkbox" name="add_product" value="1" {{($category && $category->add_product == '1') ? 'checked' : ''}}>
                                                <label for="checkbox_add_product"> قابل انتخاب در دسته بندی اضافه کردن محصول </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5 pt-4">
                                        <div class="m-4 row w-100">
                                            <div class="form-group">
                                                {{--  <input type="text" class="form-control" id="link" required name="link" >  --}}
                                                <textarea name="default_message" class="form-control" id="default_message" rows="5"> {{($category) ? $category->default_message : ''}}</textarea>
                                                <span class="highlight"></span> <span class="bar"></span>
                                                <label for="default_message"> توضیحات یا پیشفرض پراپرتی (با کاما از هم جدا شوند)</label>
                                                <span class="help-block text-danger small error-default_message"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="m-4 row w-100">
                                            <div class="checkbox checkbox-circle checkbox-primary w-100">
                                                <input type="text" class="form-control" id="icon" name="icon"  value="{{($category) ? $category->icon : ''}}"><span class="highlight"></span> <span class="bar"></span>
                                                <label for="icon">کلاس ایکون (fa fa-book)</label>
                                                <span class="help-block text-danger small error-icon"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="m-4 row w-100">
                                            <div class="checkbox checkbox-circle checkbox-primary w-100">
                                                <input type="text" class="form-control" id="title_page" name="title_page"  value="{{($category) ? $category->title_page : ''}}"><span class="highlight"></span> <span class="bar"></span>
                                                <label for="title_page">عنوان صفحه (سئو)</label>
                                                <span class="help-block text-danger small error-title_page"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <div class="form-group  row w-100">
                                <label for="imageUrl">عکس محصول</label>
                                @if ($category && $category->image && count($category->image) && $category->image[0])
                                    <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload" data-default-file="{{asset($category->image[0]->path)}}">
                                @else
                                    <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload">
                                @endif 
                                <small>
                                        <div class="form-control-feedback text-danger error-imageUrl"></div>
                                </small>
                            </div>
                            <div class="form-group">
                                {{--  <input type="text" class="form-control" id="link" required name="link" >  --}}
                                <textarea name="meta_keywords" class="form-control" id="meta_keywords" rows="5"> {{($category) ? $category->meta_keywords : ''}}</textarea>
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="meta_keywords">متا کیورد</label>
                                <span class="help-block text-danger small error-meta_keywords"></span>
                            </div>
                            <div class="form-group">
                                {{--  <input type="text" class="form-control" id="link" required name="link" >  --}}
                                <textarea name="meta_description" class="form-control" id="meta_description" rows="5"> {{($category) ? $category->meta_description : ''}}</textarea>
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="meta_description">متا توضیحات</label>
                                <span class="help-block text-danger small error-meta_description"></span>
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

