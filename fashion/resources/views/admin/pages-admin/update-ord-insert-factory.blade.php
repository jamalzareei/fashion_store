@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') 

<link href="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">

<link href="{{ asset('panel/assets/plugins/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('panel/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content') 
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5">
                    <form class="floating-labels mt-5 ajaxForm" action="{{$factory->routeAction}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6 mb-5 float-left">
                            <div class="form-group">
                                <input type="text" class="form-control" id="manufacturer" required name="manufacturer" value="{{($factory) ? $factory->manufacturer : ''}}" ><span class="highlight"></span> <span class="bar"></span>
                                <label for="manufacturer">نام کارخانه</label>
                                <span class="help-block text-danger small error-manufacturer"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <div class="form-group">
                                <input type="text" class="form-control" id="manufacturer_en" name="manufacturer_en"  value="{{($factory) ? str_replace('.html','',$factory->manufacturer_en) : ''}}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="manufacturer_en">نام کارخانه (english)</label>
                                <span class="help-block text-danger small error-manufacturer_en"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <div class="m-4 row w-100">
                                <div class="checkbox checkbox-circle checkbox-danger w-100">
                                </div>
                                <label for="checkbox_avail"> وضعیت (فعال / غیرفعال) </label>
                                <input data-on-text="فعال" data-off-text="غیرفعال" class="js-switch small" type="checkbox" data-size="small"  name="avail" {{($factory->avail == 'Y') ? 'checked' : ''}} value="Y">
                            </div>
                        </div>
                        {{-- <div class="form-group col-md-6 mb-5 float-left">
                            <div class="m-4 row w-100">                                
                                <input type="number" class="form-control" id="user_login" required name="user_login" value="{{($factory) ? $factory->user_login : ''}}" ><span class="highlight"></span> <span class="bar"></span>
                                <label for="user_login">کاربر متصل</label>
                                <span class="help-block text-danger small error-user_login"></span>
                            </div>
                        </div> --}}
                        <div class="form-group col-md-6 mb-5 float-left">
                            <select class="select2 m-b-10"  data-placeholder="انتخاب کنید"  id="user_login" name="user_login" >
                                @foreach ($usersFactory as $user)
                                    <option value="{{ $user->login }}" 
                                        @if ($factory->user_login == $user->login)
                                            selected
                                        @endif
                                    >{{ $user->login }}</option>
                                @endforeach
                            </select>
                            <label for="user_login" style="float: right;position: absolute;right: 5px;top: -20px;">حساب کاربری متصل به کارخانه</label>
                            <span class="help-block text-danger small error-user_login"></span>
                        </div>
                        
                        <div class="form-group col-md-12 mb-5 float-left">
                            <select class="select2 m-b-10 select2-multiple" multiple data-placeholder="انتخاب کنید"  id="category_id" name="category_id[]" >
                                @foreach ($categories as $category)
                                    <option value="{{ $category->categoryid }}" 
                                        @if (strpos($factory->category_id, $category->categoryid) !== false || ($factory->category_id == $category->categoryid))
                                            selected
                                        @endif
                                    >{{ $category->category }}</option>
                                @endforeach
                            </select>
                            <label for="category_id" style="float: right;position: absolute;right: 5px;top: -20px;">دسته بندی مرتبط</label>
                            <span class="help-block text-danger small error-category_id"></span>
                        </div>
                        <div class="form-group col-md-12 mb-5 float-left">
                            <a href="#" class="btn btn-danger btn-change-textarea">فعال / غیر فعال کردن ویرایش محتوای متنی</a>
                        </div>
                        <div class="form-group col-md-12 mb-5 float-left">
                            <div class="form-group">
                                <textarea name="info_file" class="form-control description1" id="info_file" rows="5"> {!!($factory) ? $factory->info_file : ''!!}</textarea>
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="info_file">معرفی کارخانه</label>
                                <span class="help-block text-danger small error-info_file"></span>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12 mb-5 float-left">
                            <div class="form-group">
                                <textarea name="specification_file" class="form-control description1" id="specification_file" rows="5"> {!!($factory) ? $factory->specification_file : ''!!}</textarea>
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="specification_file">مشخصات فنی</label>
                                <span class="help-block text-danger small error-specification_file"></span>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12 mb-5 float-left">
                            <div class="form-group">
                                <textarea name="transportation_file" class="form-control description1" id="transportation_file" rows="5"> {!!($factory) ? $factory->transportation_file : ''!!}</textarea>
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="transportation_file">حمل و نق</label>
                                <span class="help-block text-danger small error-transportation_file"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-12 mb-5 float-left">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت اطلاعات</button>
                        </div>
                        {{--  <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>  --}}
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js') 
    <script src="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.js')}}"></script>
    <script type="text/javascript">
        $('.js-switch').bootstrapSwitch();
    </script>
    <script src="{{asset('panel/assets/plugins/tinymce/tinymce.min.js')}}"></script>
	<script src="{{asset('panel/assets/plugins/tinymce/langs/fa_IR.js')}}"></script>
	<script>
		$(document).ready(function() {

            $('.btn-change-textarea').click(function(){
                $('textarea[name="description"]').toggleClass('description').toggle();
                $('.mce-tinymce').remove();
                $(this).remove();
            })

			if ($(".description").length > 0) {
				tinymce.init({
					selector: "textarea.description",
					directionality : 'rtl',
					theme: "modern",
					height: 300,
					plugins: [
						"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
						"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
						"save table contextmenu directionality emoticons template paste textcolor"
					],
					toolbar: "newdocument | undo redo | styleselect | bold italic removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

				});
			}
		});
    </script>
    
    <script src="{{ asset('panel/assets/plugins/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript" src="{{ asset('panel/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script>
            $(".select2").select2();
    </script>
@endsection

