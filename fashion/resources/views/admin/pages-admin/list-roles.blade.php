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
                    <form action="{{ route('admin.user.add') }}" method="post" class="form-inline">
                        @csrf
                        <div class="group-control mx-2">
                            <label for="name">نام</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="سطح عضویت">
                        </div>
                        <div class="group-control mx-2">
                            <label for="code">سطح ارشدیت ( حروف الفبای انگلیسی)</label>
                            <select name="code" id="code" class="form-control">
                                @foreach (range('A', 'Z') as $char) {
                                    <option value="{{$char}}">{{$char}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="group-control mx-2">
                            <label for="slug">اسلاگ</label>
                            <input class="form-control" type="text" name="slug" id="slug" placeholder="اسلاگ">
                        </div>
                        <div class="group-control mx-2">
                            <label for="description">توضیحات</label>
                            <input class="form-control" type="text" name="description" id="description" placeholder="توضیحات">
                        </div>
                        <div class="group-control mx-2">
                            <label for="description">&nbsp;</label>
                            
                            <input type="submit" class="btn btn-primary" value="ذخیره" />
                        </div>
                    </form>    


                    <table class="table color-bordered-table inverse-bordered-table">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center">نام سطح عضویت</th>
                                <th class="text-center">سطح ارشدیت</th>
                                <th class="text-center">تعداد کاربران</th>
                                <th class="text-center">slug  (code)</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $role)
                                <tr id="row-{{ $key }}">
                                    <th class="text-center">{{ $role->name }}</th>
                                    <th class="text-center">{{ $role->code }}</th>
                                    <th class="text-center">{{ $role->users_count }}</th>
                                    <th class="text-center">{{ $role->slug }}</th>
                                    <th class="text-center">
                                        <button onclick="delete_('{{ route('admin.role.delete', ['id'=>$role->id]) }}', '{{ url()->current() }}')" class="btn btn-youtube waves-effect btn-circle float-left waves-light"><i class="fa fa-times"></i> </button>
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
