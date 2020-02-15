@extends('admin.layouts.master')

@section('title')
@endsection

@section('css')
    
<link href="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('panel.adminer.users') }}" method="GET">
                    <div class="row">
                        <div class="col-10">
                            <input type="text" name="title" class="form-control" placeholder="نام، شماره و ایمیل">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5 row">
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                    <form action="{{ route('panel.adminer.users.update') }}" method="post">
                        @csrf
                        <table class="table color-bordered-table inverse-bordered-table">
                            <thead>
                                <tr>
                                    <td colspan="8">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th class="text-center">#</th>
                                    <th class="text-center">کاربر</th>
                                    <th class="text-center">نام  <br> ایمیل</th>
                                    <th class="text-center">سطح عضویت</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">User Type</th>
                                    <th class="text-center">آخرین ورود</th>
                                    <th class="text-center">فعال/غیر فعال</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $key => $user)
                                    <tr id="row-{{ $user->login }}">
                                        <th class="text-center">
                                            <input type="checkbox" name="data[{{$user->login}}][check]" id="{{$user->login}}" value="1">
                                        </th>
                                        <th class="text-center">{{$user->login}}</th>
                                        <th class="text-center">{{$user->firstname}} {{$user->lastname}} <br>{{$user->email}}</th>
                                        <th class="text-center">
                                            <?php
                                             $membershipUser = $membership->where('role_id',$user->role)->first();
                                             $membershipArr = $membershipUser['membership'];
                                             $usertypeArr = $membershipUser['usertype'];
                                             $role_idArr = isset($membershipUser['role_id']) ? $membershipUser['role_id'] : $user->role;
                                            ?>
                                            {{$membershipArr}}
                                        </th>
                                        <th class="text-center">
                                            <select name="data[{{$user->login}}][role_id]" class="form-control" id="">
                                                @foreach ($membership as $member)
                                                    @if (!isset($member['role_id']))
                                                    <?php $member['role_id'] = 0 ?>
                                                    @endif
                                                    <option value="{{$member['role_id']}}"  {{($member['role_id'] == $role_idArr) ? "selected" : ""}}>{{$member['role_id']}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th class="text-center">
                                            <select name="data[{{$user->login}}][usertype]" class="form-control" id="">
                                                @foreach ($membership as $member)
                                                    <option value="{{$member['usertype']}}" {{($member['usertype'] == $usertypeArr) ? "selected" : ""}}>{{$member['usertype']}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th class="text-center">{{Verta($user->last_login)}}</th>
                                        <th class="text-center">
                                            <i onclick="delete_('{{ route('panel.adminer.users.delete', ['login'=>$user->login]) }}', '{{ route('panel.adminer.users') }}')" class="btn btn-youtube waves-effect btn-circle float-left waves-light"><i class="fa fa-times"></i> </i>
                                            <input data-on-text="فعال" data-off-text="غیرفعال" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$user->login}}][active]" {{($user->active == '1') ? 'checked' : ''}} value="1">
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-danger text-center">
                                                هیچ کاربری وجود ندارد.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    <div class="row text-center">
                        {{ $users->appends($_GET)->links() }}
                    </div>
                    
                </div>
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
@endsection
