@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') 

{{-- <link href="{{ asset('panel/assets/plugins/jquery-wizard-master/css/wizard.css') }}" rel="stylesheet"> --}}
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
            <div class="col-sm-12">
                <div class="panel panel-danger">
                    <div class="panel-heading"><a href="https://cerampakhsh.com/product/{{$product->slug}}" target="_blank">{{ $title }}</a></div>
                    <div class="panel-body pt-5">
						<div class="row text-right">
								<button onclick="delete_('{{ route('delete.product.supplier.post', ['id'=>$product->productid]) }}', '{{ route('list.product.supplier') }}')" class="btn btn-youtube waves-effect float-left waves-light"><i class="fa fa-times"></i> حذف محصول</button>
							</div>
                        <div class="">

							<div class="sttabs tabs-style-linemove">
								<nav>
									<ul>
										<li><a href="#section-linemove-1" class="sticon ti-home"><span>اطلاعات پایه</span></a></li>
										<li><a href="#section-linemove-2" class="sticon ti-upload"><span>گالری محصول</span></a></li>
										<li><a href="#section-linemove-3" class="sticon ti-help"><span>اطلاعات اضافی محصول</span></a></li>
										<li><a href="#section-linemove-4" class="sticon ti-anchor"><span>مشخصات فنی</span></a></li>
										<li><a href="#section-linemove-5" class="sticon ti-money"><span>قیمت گذاری محصول</span></a></li>
										{{-- <li><a href="#section-linemove-6" class="sticon ti-settings"><span>به اشتراک گذاری</span></a></li> --}}
									</ul>
								</nav>
								<div class="content-wrap text-center">
									<section id="section-linemove-1">
										@include('admin.components.product-suppliers.edit-step1',['product' => $product, 'categories' => $categories, 'suppliers'=> $suppliers ])
									</section>
									<section id="section-linemove-2">
										@include('admin.components.product-suppliers.edit-step2',['product' => $product ])
									</section>
									<section id="section-linemove-3">
										@include('admin.components.product-suppliers.edit-step3',['product' => $product ])
									</section>
									<section id="section-linemove-4">
										@include('admin.components.product-suppliers.edit-step4',['product' => $product, 'extrafields' => $extrafields ])
									</section>
									<section id="section-linemove-5">
										@include('admin.components.product-suppliers.edit-step5',['product' => $product, 'price' => $price ])
									</section>
									{{-- <section id="section-linemove-6">
										<div class="alert alert-success ">
											محصول با موفقیت اضافه گردید. 
										</div>
									</section> --}}
								</div>
								<!-- /content -->
							</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('js') 
    

	<script src="{{ asset('panel/assets/plugins/cbpFWTabs/cbpFWTabs.min.js') }}"></script>
	<script type="text/javascript">
		(function() {

			[].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
				new CBPFWTabs(el);
			});

		})();
	</script>

	<script src="{{ asset('panel/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>

	{{-- <script src="{{ asset('admin-theme/assets/plugins/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('admin-theme/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script> --}}
	<script>
		$(document).ready(function() {
			// Basic
			$('.dropify').dropify({
				messages: {
					default: 'یک فایل اینجا بکشید و یا کلیک کنید (حجم فایل کمتر از 300 کیلوبایت  )',
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

