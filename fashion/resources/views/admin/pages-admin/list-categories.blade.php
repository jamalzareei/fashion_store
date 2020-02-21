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
                <form action="{{ route('panel.admin.categories', ['parent_id'=> $parent_id]) }}" method="GET">
                    <div class="row">
                        <div class="col-10">
                            <input type="text" name="category" class="form-control" placeholder="نام یا اسلاگ و یا لینک">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="{{ route('panel.admin.category.add', ['parentid'=> $parent_id]) }}" class="btn btn-warning float-right"><i class="fa fa-plus"></i> اضافه کردن دسته جدید به این گروه</a>
            </div>
        </div>
        <hr>
        <div class="panel panel-danger">
            <div class="panel-heading">@if($category)<a href="{{ route('panel.admin.categories', ['parent'=> $category->parent_id]) }}" class="btn btn-danger mx-5">بازگشت</a>@endif {{ $title }}</div>
            <div class="panel-body pt-5 row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                    <form action="{{ route('panel.admin.categories.update') }}" method="post">
                        @csrf
                        <table class="table color-bordered-table inverse-bordered-table">
                            <thead>
                                <tr>
                                    <td colspan="10">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    {{--  <th class="text-center">#</th>  --}}
                                    <th class="text-center">موقعیت</th>
                                    <th class="text-center">نام</th>
                                    <th class="text-center">فعال</th>
                                    <th class="text-center">منو</th>
                                    <th class="text-center">فیلتر</th>
                                    <th class="text-center">اضافه کردن محصول</th>
                                    <th class="text-center">زیر دسته ای</th>
                                    <th class="text-center">پراپرتی ها</th>
                                    <th class="text-center"> عملیات </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $key => $category)
                                    <tr id="row-{{ $category->id }}">
                                        {{--  <th class="text-center">
                                            <input type="checkbox" name="data[{{$category->id}}][check]" id="{{$category->id}}" value="1">
                                        </th>  --}}
                                        <th class="text-center" width="100">
                                            <input type="text" class="form-control" name="data[{{$category->id}}][order]" id="order{{$category->id}}" value="{{$category->order}}">
                                        </th>
                                        <th class="text-center">
                                            <a href="{{ route('panel.admin.category.edit', ['id'=>$category->id]) }}">{{$category->name}}</a>
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$category->id}}][active]" {{($category->active == '1') ? 'checked' : ''}} value="1">
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$category->id}}][menu]" {{($category->menu == '1') ? 'checked' : ''}} value="1">
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$category->id}}][filter]" {{($category->filter == '1') ? 'checked' : ''}} value="1">
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$category->id}}][add_product]" {{($category->add_product == '1') ? 'checked' : ''}} value="1">
                                        </th>
                                        <th class="text-center">
                                            <a href="{{ route('panel.admin.categories', ['parent_id'=>$category->id]) }}">لیست  زیر دسته ها</a>
                                        </th>
                                        
                                        <th class="text-center">
                                            <a href="{{ route('panel.admin.properties', ['id'=>$category->id]) }}">لیست پراپرتی ها</a>
                                        </th>
                                        <th class="text-center">
                                            <a class="btn btn-twitter waves-effect btn-circle waves-light" title="ویرایش" data-title="ویرایش" href="{{ route('panel.admin.category.edit', ['id'=>$category->id]) }}"><i class="fa fa-edit"></i></a>
                                            <i onclick="delete_('{{ route('panel.admin.categories.delete', ['id'=>$category->id]) }}', '{{ url()->full() }}')" class="btn btn-youtube waves-effect btn-circle float-right waves-light"><i class="fa fa-times"></i> </i>
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            <div class="alert alert-danger text-center">
                                                هیچ دسته ای وجود ندارد
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    
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
