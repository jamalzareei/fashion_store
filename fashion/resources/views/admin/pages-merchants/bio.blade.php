

@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('css')
    
@endsection

@section('content')
    
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">اطلاعات کاربری
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">نام کاربری </th>
                            <td>{{ ($user->login) ? $user->login : 'وارد نشده است' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">نام</th>
                            <td>{{ ($user->firstname) ? $user->firstname : 'وارد نشده است' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">نام خانوادگی</th>
                            <td>{{ ($user->lastname) ? $user->lastname : 'وارد نشده است' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">تلفن</th>
                            <td>{{ ($user->phone) ? $user->phone : 'وارد نشده است' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">ایمیل</th>
                            <td>{{ ($user->email) ? $user->email : 'وارد نشده است' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">نوع حساب</th>
                            <td>
                                @if ($user->role)
                                    @if ($user->role == '2')
                                        فروشنده
                                    
                                    @elseif ($user->role == '3')
                                        کارخانه
                                    @else
                                        کاربر عادی
                                    @endif
                                @else
                                وارد نشده است
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">آدرس</th>
                            <td>{{ $user->s_country . " " . $user->s_state . " " . $user->s_city . " " . $user->s_address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">اطلاعات فروشگاه
            </div>
            <div class="panel-body">
                @if ($user->merchant)
                    
                    <div class="col-sm-12 m-3 text-center"> 
                        @if (($user->merchant->image_path))
                            <img src="https://cerampakhsh.com/{{ ($user->merchant->image_path) }}" alt="image" class="img-circle" width="170">
                        @else
                            <img src="{{ asset('public/logo-300300.png') }}" alt="image" class="img-circle" width="170">
                        @endif
                        
                    </div>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">نام فروشگاه </th>
                                <td>{{ ($user->merchant->title) ? $user->merchant->title : 'وارد نشده است' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">ساعات کاری</th>
                                <td>{{ ($user->merchant->time_work) ? $user->merchant->time_work : 'وارد نشده است' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">تلفن</th>
                                <td>{{ ($user->merchant->phone) ? $user->merchant->phone : 'وارد نشده است' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">شهر</th>
                                <td>{{ ($user->merchant->city) ? $user->merchant->city : 'وارد نشده است' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">آدرس</th>
                                <td>{{ ($user->merchant->address) ? $user->merchant->address : 'وارد نشده است' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">جزئیات</th>
                                <td>{{ ($user->merchant->details) ? $user->merchant->details : 'وارد نشده است' }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                <div class="alert alert-dark">

                    اطلاعات فروشنده شما وارد نشده است.
                    <a href="{{ route('edit.merchant') }}" class="btn btn-outline-danger float-right" >اضافه کردن اطلاعات فروشگاه</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection

@section('js')
    
@endsection
