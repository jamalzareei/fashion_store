@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') 

<link href="{{ asset('panel/assets/plugins/dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content') 
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5">
                <form action="{{ route('panel.suppliers.gallery.post') }}" method="POST" class="dropzone" id="dropzone" enctype="multipart/form-data">
                    @csrf
                    <div class="fallback">
                        <input name="file" type="file" multiple>
                    </div>
                </form>
                <div class="popup-gallery m-t-30" id="showListGallery">
                        {{--  <pre> {{var_dump($product->images)}}</pre>  --}}
                        @if ($gallery)
                            @forelse ($gallery as $image)
                                @include('admin.components.gallery-suppliers', [ 'image' => $image])
                            
                            @empty
                                <div class="alert alert-warning"> فایلی آپلود نشده است. </div>
                            @endforelse
                        @else
                            <div class="alert alert-warning"> فایلی آپلود نشده است. </div>
                        @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js') 
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
                
                Swal.fire({
                    type: 'error',
                    title: 'سایز عکس باید کمتر از 300 کیلوبایت باشد',
                    html: errors,
                });
			}
		};
    </script>
    @endsection

