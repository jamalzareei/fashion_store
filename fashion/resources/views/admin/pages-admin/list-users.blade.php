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
                <form action="{{ route('admin.users') }}" method="GET">
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
                    {{--  <form action="{{ route('admin.users.update') }}" method="post">
                        @csrf  --}}
                        <table class="table color-bordered-table inverse-bordered-table">
                            <thead>
                                <tr>
                                    <td colspan="6">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th class="text-center">#</th>
                                    <th class="text-center">نام کاربری</th>
                                    <th class="text-center">نام</th>
                                    <th class="text-center">ایمیل</th>
                                    <th class="text-center">شماره همراه</th>
                                    <th class="text-center">فعال/غیر فعال</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $key => $user)
                                    <tr id="row-{{ $user->id }}">
                                        <th class="text-center">
                                            {{$user->id}}
                                        </th>
                                        <th class="text-center">{{$user->username}} </th>
                                        <th class="text-center">{{$user->firstname}} {{$user->lastname}}</th>
                                        <th class="text-center">{{$user->email}}</th>
                                        <th class="text-center">{{$user->phone}} </th>
                                        <th class="text-center">
                                            <input data-on-text="فعال" data-off-text="غیرفعال" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$user->id}}][active]" {{($user->email_verified_at || $user->phone_verified_at) ? 'checked' : ''}} value="1" onchange="changeStatus('{{route('admin.user.update', ['id' => $user->id])}}',this)">
                                            <i onclick="delete_('{{ route('admin.user.delete', ['id'=>$user->id]) }}', '{{ url()->current() }}')" class="btn btn-youtube waves-effect btn-circle float-right waves-light"><i class="fa fa-times"></i> </i>
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert alert-danger text-center">
                                                هیچ کاربری وجود ندارد.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    {{--  </form>  --}}
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
