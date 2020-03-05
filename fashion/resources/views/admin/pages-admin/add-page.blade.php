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
                    <form class="floating-labels mt-5 ajaxUpload" action="{{$routePost}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6 mb-5 float-left">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" required name="name" value="{{($page) ? $page->name : ''}}" ><span class="highlight"></span> <span class="bar"></span>
                                <label for="name">نام صفحه</label>
                                <span class="help-block text-danger small error-name"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-5 float-left">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name_en" name="name_en"  value="{{($page) ? str_replace('.html','',$page->name_en) : ''}}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="name_en">نام فایل</label>
                                <span class="help-block text-danger small error-name_en"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4 mb-5 float-left">
                            <div class="m-4 row w-100">
                                <div class="checkbox checkbox-circle checkbox-danger w-100">
                                </div>
                                <label for="checkbox_avail"> وضعیت (فعال / غیرفعال) </label>
                                <input data-on-text="فعال" data-off-text="غیرفعال" class="js-switch small" type="checkbox" data-size="small"  name="active" {{($page->active == '1') ? 'checked' : ''}} value="1">
                            </div>
                        </div>
                        <div class="form-group col-md-4 mb-5 float-left">
                            <div class="m-4 row w-100">
                                <select name="position" id="position" class="form-control">
                                    <option value="FOOTER" {{ ($page->position == 'FOOTER') ? 'selected' : ''}}>نمایش در فوتر</option>
                                    <option value="CATEGORY" {{ ($page->position == 'CATEGORY') ? 'selected' : ''}}>نمایش در منو</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 mb-5 float-left">
                            <div class="m-4 row w-100">                                
                                <input type="number" class="form-control" id="order" required name="order" value="{{($page) ? $page->order : ''}}" ><span class="highlight"></span> <span class="bar"></span>
                                <label for="order">موقعیت</label>
                                <span class="help-block text-danger small error-order"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-12 mb-5 float-left">
                            <div class="form-group  row w-100">
                                <label for="fileupload">اپلود فایل محتوای صفحه ( فرمت اچ تی ام ال)</label>
                                <hr>
                                    <input type="file" id="fileupload" name="fileupload" class="dropify file-upload">
                                <small>
                                        <div class="form-control-feedback text-danger error-fileupload"></div>
                                </small>
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
                                <input type="text" class="form-control" id="meta_description" name="meta_description"  value="{{($page) ? $page->meta_description : ''}}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="meta_description">توضیحات متا تگ</label>
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

