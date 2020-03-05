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
                <form action="{{ route('panel.admin.pages') }}" method="GET">
                    <div class="row">
                        <div class="col-10">
                            <input type="text" name="title" class="form-control" placeholder="عنوان صفحه">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="{{ route('panel.admin.page.add') }}" class="btn btn-warning float-right"><i class="fa fa-plus"></i> اضافه کردن صفحه جدید </a>
            </div>
        </div>
        <hr>
        <div class="panel panel-danger">
            <div class="panel-heading"> {{ $title }}</div>
            <div class="panel-body pt-5 row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                    <form action="{{ route('panel.admin.pages.update') }}" method="post">
                        @csrf
                        <table class="table color-bordered-table inverse-bordered-table">
                            <thead>
                                <tr>
                                    <td colspan="7">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    {{--  <th class="text-center">#</th>  --}}
                                    <th class="text-center">موقعیت</th>
                                    <th class="text-center">نام پیج</th>
                                    <th class="text-center">نام فایل</th>
                                    <th class="text-center">فعال</th>
                                    <th class="text-center">محل نمایش</th>
                                    <th class="text-center">پیش نمایش</th>
                                    <th class="text-center"> عملیات </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pages as $key => $page)
                                    <tr id="row-{{ $page->id }}">
                                        {{--  <th class="text-center">
                                            <input type="checkbox" name="data[{{$page->id}}][check]" id="{{$page->id}}" value="1">
                                        </th>  --}}
                                        <th class="text-center" width="100">
                                            <input type="number" class="form-control" name="data[{{$page->id}}][order]" id="order{{$page->id}}" value="{{$page->order}}">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" class="form-control" name="data[{{$page->id}}][name]" id="name{{$page->id}}" value="{{$page->name}}">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" class="form-control" name="data[{{$page->id}}][name_en]" id="name_en{{$page->id}}" value="{{$page->name_en}}">
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$page->id}}][active]" {{($page->active == '1') ? 'checked' : ''}} value="Y">
                                        </th>
                                        <th class="text-center">
                                            <select name="data[{{$page->id}}][position]" id="data[{{$page->id}}][position]" class="form-control">
                                                <option value="FOOTER" {{ ($page->position == 'FOOTER') ? 'selected' : ''}}>نمایش در فوتر</option>
                                                <option value="CATEGORY" {{ ($page->position == 'CATEGORY') ? 'selected' : ''}}>نمایش در منو</option>
                                            </select>
                                        </th>
                                        <th class="text-center">
                                            <a href="/page/{{$page->slug}}" target="_blank">پیش نمایش</a>
                                        </th>
                                        <th class="text-center">
                                            <i onclick="delete_('{{ route('panel.admin.page.delete', ['id'=>$page->id]) }}', '{{ route('panel.admin.pages') }}')" class="btn btn-youtube waves-effect btn-circle float-right waves-light"><i class="fa fa-times"></i> </i>
                                            <a class="btn btn-twitter waves-effect btn-circle waves-light" title="ویرایش" data-title="ویرایش" href="{{ route('panel.admin.page.edit', ['id'=>$page->id]) }}"><i class="fa fa-edit"></i></a>
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-danger text-center">
                                                هیچ صفحه ای وجود ندارد
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
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
