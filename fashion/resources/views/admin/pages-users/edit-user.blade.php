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
    @if ($step == null || $step == 'bio')
    <div class="col-md-8 offset-md-2">
        <div class="panel panel-danger">
            <div class="panel-heading">اطلاعات کلی
            </div>
            <div class="panel-body pt-5">
                <form class="floating-labels mt-5 ajaxForm" action="{{ route('edit.user.post') }}" method="POST">
                    @csrf
                    
                    <div class="row">

                        <div class="form-group col-md-6 mb-5">
                            <input type="text" class="form-control" id="phone" name="phone" {{ ($user->phone) ? 'disabled' : '' }} value="{{ ($user->phone) ? $user->phone : '' }}"><span class="highlight"></span> <span class="bar"></span>
                            <label for="phone" style="{{ ($user->phone) ? 'margin-top: -30px;' : '' }}">شماره تلفن</label>
                            <span class="help-block text-danger small error-phone"></span>
                        </div>
                        <div class="form-group col-md-6 mb-5">
                            <input type="email" class="form-control" id="email" name="email" {{ ($user->email) ? 'disabled' : '' }} value="{{ ($user->email) ? $user->email : '' }}"><span class="highlight"></span> <span class="bar"></span>
                            <label for="email" style="{{ ($user->email) ? 'margin-top: -30px;' : '' }}" >ایمیل</label>
                            <span class="help-block text-danger small error-email"></span>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-md-6 mb-5">
                            <input type="text" class="form-control" id="fname" name="firstname" required value="{{ ($user->firstname) ? $user->firstname : '' }}"><span class="highlight"></span> <span class="bar"></span>
                            <label for="fname">نام</label>
                            <span class="help-block text-danger small error-firstname"></span>
                        </div>
                        <div class="form-group col-md-6 mb-5">
                            <input type="text" class="form-control" id="lname" name="lastname" required value="{{ ($user->lastname) ? $user->lastname : '' }}"><span class="highlight"></span> <span class="bar"></span>
                            <label for="lname">نام خانوادگی</label>
                            <span class="help-block text-danger small error-lastname"></span>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <select  class="form-control " id="country" name="s_country">
                                <option > -- انتخاب کشور --</option>
                                <option value="IR" selected>ایران</option>
                            
                        </select>
                        <label for="country">کشور</label>
                        <span class="help-block text-danger small error-s_country"></span>
                    </div>
                    <div class="form-group mb-5">
                        @include('admin.components.states',['s_state_default' => ($user->s_state) ? $user->s_state : ''])
                        {{--  <input type="text" class="form-control" id="state" name="s_state" required value="{{ ($user->s_state) ? $user->s_state : '' }}"><span class="highlight"></span> <span class="bar"></span>  --}}
                        <label for="state">استان</label>
                        <span class="help-block text-danger small error-s_state"></span>
                    </div>
                    <div class="form-group mb-5">
                        <select  class="form-control " id="city" name="s_city">
                            @if ($user->s_city)
                                
                            <option value="{{ ($user->s_city) ? $user->s_city : '' }}">{{ ($user->s_city) ? $user->s_city : '' }}</option>
                            @endif
                        </select>
                        {{--  <input type="text" class="form-control" id="city" name="s_city" required value="{{ ($user->s_city) ? $user->s_city : '' }}"><span class="highlight"></span> <span class="bar"></span>  --}}
                        <label for="city">شهر</label>
                        <span class="help-block text-danger small error-s_city"></span>
                    </div>
                    <div class="form-group mb-5">
                        <input type="text" class="form-control" id="zipcode" name="s_zipcode" required value="{{ ($user->s_zipcode) ? $user->s_zipcode : '' }}"><span class="highlight"></span> <span class="bar"></span>
                        <label for="zipcode">کد پستی</label>
                        <span class="help-block text-danger small error-s_zipcode"></span>
                    </div>
                    <div class="form-group m-b-5">
                        <textarea class="form-control" rows="4" id="address" name="s_address" required value="">{{ ($user->s_address) ? $user->s_address : '' }}</textarea><span class="highlight"></span> <span class="bar"></span>
                        <label for="address">آدرس</label>
                        <span class="help-block text-danger small error-s_address"></span>
                    </div>

                    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
                    <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                </form>
            </div>
        </div>
    </div>
    @elseif ($step == 'card')

    <div class="col-md-8 offset-md-2">
        <div class="panel panel-primary">
            <div class="panel-heading">اضافه کردن کارت بانکی
            </div>
            <div class="panel-body pt-5">
                <form class="floating-labels mt-5 ajaxForm" action="{{ route('edit.user.card-number.post') }}" method="POST">
                    @csrf
                    <div class="form-group mb-5">
                        <input type="text" class="form-control" id="card_name" name="card_name" required  value="{{ ($user->card_name) ? $user->card_name : '' }}"><span class="highlight"></span> <span class="bar"></span>
                        <label for="card_name">بانک</label>
                        <span class="help-block text-danger small error-card_name"></span>
                    </div>
                    <div class="form-group mb-5">
                        <input type="text" class="form-control" dir="ltr" id="card_number" name="card_number" required  value="{{ ($user->card_number) ? $user->card_number : '' }}"><span class="highlight"></span> <span class="bar"></span>
                        <label for="card_number">شماره کارت بانکی</label>
                        <span class="help-block text-danger small error-card_number"></span>
                    </div>
                    <div class="form-group mb-5">
                        <input type="text" class="form-control" dir="ltr" id="shaba_number" name="shaba_number" required  value="{{ ($user->shaba_number) ? $user->shaba_number : 'IR' }}"><span class="highlight"></span> <span class="bar"></span>
                        <label for="shaba_number">شماره شبا</label>
                        <span class="help-block text-danger small error-shaba_number"></span>
                    </div>

                    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ذخیره</button>
                    <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                </form>
            </div>
        </div>
    </div>
    @elseif ($step == 'spesiality')

    <div class="col-md-8 offset-md-2">
        <div class="panel panel-warning">
            <div class="panel-heading">اضافه کردن تخصص ها
            </div>
            <div class="panel-body pt-5">
                <form class="floating-labels mt-5 ajaxForm" action="{{ route('edit.user.spesiality.post') }}" method="POST">
                    @csrf
                    
                    <div class="form-group" style="overflow: hidden;">
                        <select multiple id="spesiality-select" name="spesiality[]" required>
                            @for ($i = 1; $i < 12; $i++)
                                <option value="{{$i}}" <?php if($user->spesiality){ ?> {{ (in_array($i, json_decode($user->spesiality))) ? 'selected' : '' }} <?php } ?>>{{$i}}</option>
                            @endfor
                        </select>
                        <span class="help-block text-danger small error-spesiality"></span>
                    </div>

                    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">افزودن به علاقه مندی ها</button>
                    <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                </form>
            </div>
        </div>
    </div>
    @elseif ($step == 'password')
    

    <div class="col-md-8 offset-md-2">
        <div class="panel panel-primary">
            <div class="panel-heading">تغییر رمز عبور
            </div>
            <div class="panel-body pt-5">
                <form class="floating-labels mt-5 ajaxForm" action="{{ route('edit.user.password.post') }}" method="POST">
                    @csrf
                    <div class="form-group mb-5">
                        <input type="password" class="form-control" id="country" name="password" required value=""><span class="highlight"></span> <span class="bar"></span>
                        <label for="country">پسورد</label>
                        <span class="help-block text-danger small error-password"></span>
                    </div>
                    <div class="form-group mb-5">
                        <input type="password" class="form-control" id="state" name="password_confirmation" required value=""><span class="highlight"></span> <span class="bar"></span>
                        <label for="state">تکرار پسورد</label>
                        <span class="help-block text-danger small error-password_confirmation"></span>
                    </div>

                    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">تغییر رمز عبور</button>
                    <button type="button" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                </form>
            </div>
        </div>
    </div>
        
    @endif
    
</div>

@endsection
@section('js') 
<script type="text/javascript" src="{{ asset('panel/assets/plugins/custom-select/custom-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('panel/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        // For select 2
        $('#spesiality-select').multiSelect();
        $('#select-all').click(function() {
            $('#spesiality-select').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#spesiality-select').multiSelect('deselect_all');
            return false;
        });

    });
</script>
@endsection
