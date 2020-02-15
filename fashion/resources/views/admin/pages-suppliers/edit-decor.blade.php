@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') 

<link rel="stylesheet" href="{{ asset('panel/assets/plugins/dropify/dist/css/dropify.min.css') }}">

<link href="{{ asset('panel/assets/plugins/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('panel/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('panel/assets/plugins/dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css">

<style>
	
	.content-wrap section {
		text-align: right;
	}
	.form-group {
		float: right;
	}
	.select2-container{
		width: 100%;
	}
	.content-wrap section.content-current {
		padding: 0;
	}
</style>
@endsection
@section('content') 
<div class="row">
    <div class="col-md-6 ">
        <div class="panel panel-danger">
            <div class="panel-heading"><a href="https://cerampakhsh.com/decor/{{$decor->slug}}" target="_blank">{{ $title }}</a></div>
            <div class="panel-body pt-5">
				<div class="row text-right">
					<button onclick="delete_('{{ route('delete.decor.supplier.post', ['id'=>$decor->id]) }}', '{{ route('list.decor.supplier') }}')" class="btn btn-youtube waves-effect float-left waves-light"><i class="fa fa-times"></i> حذف دکور</button>
				</div>
                    <form class="floating-labels mt-5 ajaxForm" action="{{ route('edit.decor.supplier.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $decor->id }}">
                        <div class="form-group col-md-6 mb-5 float-left">
                            <input type="text" class="form-control" id="decor" required name="title" value="{{ $decor->title }}" ><span class="highlight"></span> <span class="bar"></span>
                            <label for="decor">نام دکور</label>
                            <span class="help-block text-danger small error-decor"></span>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <input type="text" class="form-control" id="decorcode" readonly required name="code" value="{{ $decor->code }}"><span class="highlight"></span> <span class="bar"></span>
                            <label for="decorcode">کد دکور</label>
                            <span class="help-block text-danger small error-decorcode"></span>
                        </div>
                        <div class="form-group col-md-12 mb-5 float-left">
                            <select class="select2 m-b-10 select2-multiple" multiple data-placeholder="انتخاب کنید"  id="products_id" name="products_id[]" >
                                @foreach ($products as $product)
                                    <option value="{{ $product->productid }}" @if (count($product->decors))
                                        @if ($product->decors[0]->decor_id == $decor->id )
                                            selected
                                        @endif
                                    @endif>{{ $product->product }}</option>
                                @endforeach
                            </select>
                            <label for="products_id" style="float: right;position: absolute;right: 5px;top: -20px;">محصولات مرتبط</label>
                            <span class="help-block text-danger small error-products_id"></span>
                                    
                        </div>


                        <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ویرایش</button>
                        {{--  <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>  --}}
                    </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5">
                <form action="{{ route('add.decor.image.supplier.post') }}" method="POST" class="dropzone" id="dropzone" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $decor->id }}">
                    <div class="fallback">
                        <input name="file" type="file" multiple>
                    </div>
                </form>
                <div class="popup-gallery m-t-30" id="showListGallery">
                        {{--  <pre> {{var_dump($product->images)}}</pre>  --}}
                    @forelse ($decor->images as $image)
                        @include('admin.components.image-gallery-decor-suppliers', [ 'image' => $image])
                    
                    @empty
                        <div class="alert alert-warning"> فایلی آپلود نشده است. </div>
                    @endforelse
                </div>
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
    <script src="{{ asset('panel/assets/plugins/dropzone-master/dist/dropzone.js') }}"></script>
	<script>
		$(document).ready(function() {

			Dropzone.prototype.defaultOptions.dictDefaultMessage = "فایل ها را جهت آپلود به این قسمت بکشید(حجم فایل کمتر از 300 کیلوبایت  )";
			Dropzone.prototype.defaultOptions.dictFallbackMessage = "مرورگر شما از آپلود فایل با کشیدن و رهاسازی پشتیبانی نمی کند";
			Dropzone.prototype.defaultOptions.dictFileTooBig = "فایل خیلی بزرگ است (@{{filesize}}MiB). حداکثر حجم فایل: @{{maxFilesize}}MiB.";
			Dropzone.prototype.defaultOptions.dictInvalidFileType = "امکان ارسال فایل های از این نوع وجود ندارد";
			Dropzone.prototype.defaultOptions.dictResponseError = "سرور با کد @{{statusCode}} پاسخ داد.";
			Dropzone.prototype.defaultOptions.dictCancelUpload = "لغو ارسال";
			Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "آیا از لغو این ارسال اطمینان دارید؟";
			Dropzone.prototype.defaultOptions.dictRemoveFile = "حذف فایل";
			Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "امکان ارسال فایل بیشتر وجود ندارد.";

		});
		Dropzone.options.dropzone =
			{
			maxFilesize: 12,
			renameFile: function(file) {
				var dt = new Date();
				var time = dt.getTime();
				return time+file.name;
			},
			acceptedFiles: ".jpeg,.jpg,.png,.gif",
			addRemoveLinks: true,
			timeout: 5000,
			success: function(file, response) 
			{
				console.log(response);
				$('#showListGallery .alert.alert-warning').remove();
				$('#showListGallery').append(response.data);
			},
			error: function(file, response)
			{
				return false;
			}
		};
	</script>
@endsection

