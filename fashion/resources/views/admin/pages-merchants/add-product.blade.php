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
                    <form class="floating-labels mt-5 ajaxUpload" action="{{ route('add.product.merchant.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6 mb-5 float-left">
                            <input type="text" class="form-control" id="product" required name="product" ><span class="highlight"></span> <span class="bar"></span>
                            <label for="product">نام محصول</label>
                            <span class="help-block text-danger small error-product"></span>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <input type="text" class="form-control" id="productcode" required name="productcode" value="{{$lastproduct_id}}"><span class="highlight"></span> <span class="bar"></span>
                            <label for="productcode">کد محصول</label>
                            <span class="help-block text-danger small error-productcode"></span>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            @include('admin.components.category', ['categories' => $categories])
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <select class="form-control " id="suppliers-select" name="manufacturerid">
                                <option > -- انتخاب تولید کننده --</option>
                                @foreach ($suppliers as $supp)
                                    <option value="{{ $supp->manufacturerid }}" >{{ $supp->manufacturer }}</option>
                                @endforeach
                            </select>
                            {{--  <input type="text" class="form-control" id="manufacturerid" required name="manufacturerid" ><span class="highlight"></span> <span class="bar"></span>  --}}
                            <label for="manufacturerid">کارخانه ( تولید کننده )</label>
                            <span class="help-block text-danger small error-manufacturerid"></span>
                        </div>

                        <div class="form-group  row w-100">
                            <label for="imageUrl">عکس محصول</label>
                            <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload">
                            <small>
                                    <div class="form-control-feedback text-danger error-imageUrl"></div>
                            </small>
                            
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

