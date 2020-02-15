@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') 

<link href="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">
@endsection
@section('content') 
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5">
                    <form class="floating-labels mt-5 ajaxForm" action="{{$routePost}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6 mb-5 float-left">
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" required name="title" value="{{($page) ? $page->title : ''}}" ><span class="highlight"></span> <span class="bar"></span>
                                <label for="title">نام صفحه</label>
                                <span class="help-block text-danger small error-title"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <div class="form-group">
                                <input type="text" class="form-control" id="filename" name="filename"  value="{{($page) ? str_replace('.html','',$page->filename) : ''}}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="filename">نام فایل</label>
                                <span class="help-block text-danger small error-filename"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4 mb-5 float-left">
                            <div class="m-4 row w-100">
                                <div class="checkbox checkbox-circle checkbox-danger w-100">
                                </div>
                                <label for="checkbox_avail"> وضعیت (فعال / غیرفعال) </label>
                                <input data-on-text="فعال" data-off-text="غیرفعال" class="js-switch small" type="checkbox" data-size="small"  name="active" {{($page->active == 'Y') ? 'checked' : ''}} value="Y">
                            </div>
                        </div>
                        <div class="form-group col-md-4 mb-5 float-left">
                            <div class="m-4 row w-100">
                                <select name="place" id="place" class="form-control">
                                    <option value="FOOTER" {{ ($page->place == 'FOOTER') ? 'selected' : ''}}>نمایش در فوتر</option>
                                    <option value="CATEGORY" {{ ($page->place == 'CATEGORY') ? 'selected' : ''}}>نمایش در منو</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 mb-5 float-left">
                            <div class="m-4 row w-100">                                
                                <input type="number" class="form-control" id="orderby" required name="orderby" value="{{($page) ? $page->orderby : ''}}" ><span class="highlight"></span> <span class="bar"></span>
                                <label for="orderby">موقعیت</label>
                                <span class="help-block text-danger small error-orderby"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-12 mb-5 float-left">
                            <a href="#" class="btn btn-danger btn-change-textarea">فعال / غیر فعال کردن ویرایش محتوای متنی</a>
                        </div>
                        <div class="form-group col-md-12 mb-5 float-left">
                            <div class="form-group">
                                <textarea name="description" class="form-control description1" id="description" rows="5"> {!!($description) ? $description : ''!!}</textarea>
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="description">محتوای صفحه</label>
                                <span class="help-block text-danger small error-description"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-12 mb-5 float-left">
                            <div class="form-group">
                                <input type="text" class="form-control" id="meta_keywords" required name="meta_keywords" value="{{($page) ? $page->meta_keywords : ''}}" ><span class="highlight"></span> <span class="bar"></span>
                                <label for="meta_keywords">کلمات کلیدی</label>
                                <span class="help-block text-danger small error-meta_keywords"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-12 mb-5 float-left">
                            <div class="form-group">
                                <input type="text" class="form-control" id="meta_desciption" name="meta_desciption"  value="{{($page) ? $page->meta_desciption : ''}}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="meta_desciption">توضیحات متا تگ</label>
                                <span class="help-block text-danger small error-meta_desciption"></span>
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
@endsection

