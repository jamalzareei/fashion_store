@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') @endsection
@section('content') 
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5">
                    <form class="floating-labels mt-5 ajaxForm" action="{{ route('edit.user.post') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">تغییر رمز عبور</button>
                        <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js') @endsection

