@extends('admin.layouts.master')

@section('title')
@endsection

@section('css')
    
<link href="{{ asset('panel/assets/plugins/dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5 row">
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="{{ route('panel.adminer.filemanager.post') }}" method="POST" class="dropzone" id="dropzone" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="path" value="{{$path}}">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple>
                                            </div>
                                        </form>
                                        <div class="popup-gallery m-t-30" id="showListGallery">
                                        </div>
                                    </div>
                                    <div class="col-md-6" dir="ltr">
                                        <div class="row">
                                            @if ($pathBack)
                                                <div class="col-md-12 col-12 m-2">
                                                    <a href="{{ route('panel.adminer.filemanager') }}?path={{$pathBack}}">
                                                        <i class="fa fa-mail-reply"></i>
                                                        ../ 
                                                    </a>                                                
                                                </div>
                                            @endif
                                            @foreach ($listFolders as $folder)
                                                <div class="col-md-12 col-12 m-2">
                                                    <a href="{{ route('panel.adminer.filemanager') }}?path={{$folder}}">
                                                        <i class="fa fa-folder"></i>
                                                        {{$folder}}
                                                    </a>
                                                </div>
                                            @endforeach
                                            @foreach ($listFiles as $file)
                                            <div class="col-md-12 col-12 m-2">
                                                <i class="fa fa-file-photo-o"></i>
                                                {{$file}}
                                                <a href="{{ route('panel.adminer.filemanager.delete') }}?path={{$file}}"><i class="fa fa-times text-danger float-right mx-2 font-size h2"></i></a>
                                            </div>
                                            @endforeach
                                            {{--  <div class="col-12 m-2"><i class="fa fa-folder"></i> fa-folder</div>
                                            <div class="col-12 m-2"><i class="fa fa-file-photo-o"></i> fa-file-photo-o <span class="text-muted">(alias)</span> </div>
                                            <div class="col-12 m-2"><i class="fa fa-photo"></i> fa-photo <span class="text-muted">(alias)</span> </div>  --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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
			}
		};
	</script>
@endsection
