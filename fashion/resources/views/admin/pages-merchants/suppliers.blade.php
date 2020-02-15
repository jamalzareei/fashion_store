@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') 

<link href="{{ asset('panel/assets/plugins/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('panel/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css">
<style>
        .ms-container{
            width: 100%;
        }
</style>
@endsection
@section('content') 

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5">
                <form class="floating-labels mt-5 ajaxForm" action="{{ route('connect.suppliers.post') }}" method="POST">
                    @csrf

                    <div class="col-12 mb-5">
                        <label>لطفا نمایندگی های رسمی و مجاز را انتخاب نمایید.</label>
                    </div>
                    <div class="form-group" style="overflow: hidden;">
                        <select multiple id="suppliers-select" name="suppliers[]">
                            @foreach ($suppliers as $supp)
                                <option value="{{ $supp->manufacturerid }}" @if (count($supp->merchants)>0) selected @endif>{{ $supp->manufacturer }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="button-box m-t-20"> 
                        <a id="select-all" class="btn btn-danger btn-outline" href="#">انتخاب همه</a> 
                        <a id="deselect-all" class="btn btn-info btn-outline" href="#">عدم انتخاب همه</a> 
                    </div>
								

                    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">اعمال تغییرات</button>
                    <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js') 
    <script src="{{ asset('panel/assets/plugins/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
	<script type="text/javascript" src="{{ asset('panel/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
	<script>
		jQuery(document).ready(function() {
			// For select 2

            $(".select2").select2();
            
            $('#suppliers-select').multiSelect();
			$('#select-all').click(function() {
				$('#suppliers-select').multiSelect('select_all');
				return false;
			});
			$('#deselect-all').click(function() {
				$('#suppliers-select').multiSelect('deselect_all');
				return false;
			});

        });
	</script>
@endsection

