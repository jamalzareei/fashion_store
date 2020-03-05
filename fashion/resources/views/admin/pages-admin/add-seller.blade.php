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
                    <form class="floating-labels mt-5 ajaxUpload" action="{{ route('panel.admin.seller.add.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6 mb-5 float-left">
                            <input type="text" class="form-control" id="name" required name="name" ><span class="highlight"></span> <span class="bar"></span>
                            <label for="name">نام فروشگاه</label>
                            <span class="help-block text-danger small error-name"></span>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <input type="text" class="form-control" id="slug" required name="slug" value=""><span class="highlight"></span> <span class="bar"></span>
                            <label for="slug">نام اختصاصی</label>
                            <span class="help-block text-danger small error-slug"></span>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <input type="text" class="form-control" id="manager" required name="manager" ><span class="highlight"></span> <span class="bar"></span>
                            <label for="manager">نام مدیریت</label>
                            <span class="help-block text-danger small error-manager"></span>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <input type="text" class="form-control" id="username" required name="username" value=""><span class="highlight"></span> <span class="bar"></span>
                            <label for="username">نام کاربری فروشنده (کاربر)</label>
                            <span class="help-block text-danger small error-username"></span>
                        </div>

                        <div class="form-group  row w-100">
                            <label for="imageUrl">عکس محصول</label>
                            <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload">
                            <small>
                                    <div class="form-control-feedback text-danger error-imageUrl"></div>
                            </small>
                            
                        </div>
                        
                        <div class="form-group col-md-6 mb-5 float-left">
                            <textarea name="meta_keywords" class="form-control" id="meta_keywords" rows="5"></textarea>
                            <span class="highlight"></span> <span class="bar"></span>
                            <label for="meta_keywords">متا کیورد</label>
                            <span class="help-block text-danger small error-meta_keywords"></span>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <textarea name="meta_description" class="form-control" id="meta_description" rows="5"></textarea>
                            <span class="highlight"></span> <span class="bar"></span>
                            <label for="meta_description">متا توضیحات</label>
                            <span class="help-block text-danger small error-meta_description"></span>
                        </div>

                        <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">افزودن</button>
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

