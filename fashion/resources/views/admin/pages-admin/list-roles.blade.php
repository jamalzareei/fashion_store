@extends('admin.layouts.master')

@section('title')
@endsection

@section('css')
    
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5 row">
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                    <form action="{{ route('panel.adminer.users.role.add') }}" method="post" class="form-inline">
                        @csrf
                        <div class="group-control">
                            <label for="membership">سطح عضویت</label>
                            <input class="form-control" type="text" name="membership" id="membership" placeholder="سطح عضویت">
                        </div>
                        <div class="group-control">
                            <label for="usertype">User Type</label>
                            <select name="usertype" id="usertype" class="form-control">
                                @foreach (range('A', 'Z') as $char) {
                                    <option value="{{$char}}">{{$char}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="group-control">
                            <label for="role_id">کد</label>
                            <input class="form-control" type="text" name="role_id" id="role_id" placeholder="کد">
                        </div>
                        <input type="submit" class="btn btn-primary" value="ذخیره" />
                    </form>    


                    <table class="table color-bordered-table inverse-bordered-table">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center">نام سطح عضویت</th>
                                <th class="text-center">نوع کاربری (حروف انگلیسی)</th>
                                <th class="text-center">تعداد کاربران</th>
                                <th class="text-center">شماره اختصاصی</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $role)
                                <tr id="row-{{ $key }}">
                                    <th class="text-center">{{isset($role['membership']) ? $role['membership'] : ''}}</th>
                                    <th class="text-center">{{isset($role['usertype']) ? $role['usertype'] : ''}}</th>
                                    <th class="text-center">{{isset($role['count_users']) ? $role['count_users'] : ''}}</th>
                                    <th class="text-center">{{isset($role['role_id']) ? $role['role_id'] : ''}}</th>
                                    <th class="text-center">
                                        <button onclick="delete_('{{ route('panel.adminer.users.role.delete', ['key'=>$key]) }}', '{{ route('panel.adminer.users.roles') }}')" class="btn btn-youtube waves-effect btn-circle float-left waves-light"><i class="fa fa-times"></i> </button>
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
                                
                        </tfoot>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
    
@endsection
