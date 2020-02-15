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
                <form action="{{ route('panel.adminer.pages') }}" method="GET">
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
                <a href="{{ route('panel.adminer.page.add') }}" class="btn btn-warning float-right"><i class="fa fa-plus"></i> اضافه کردن صفحه جدید </a>
            </div>
        </div>
        <hr>
        <div class="panel panel-danger">
            <div class="panel-heading"> {{ $title }}</div>
            <div class="panel-body pt-5 row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                    <form action="{{ route('panel.adminer.pages.update') }}" method="post">
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
                                    <th class="text-center">سطح</th>
                                    <th class="text-center">فعال</th>
                                    <th class="text-center">محل نمایش</th>
                                    <th class="text-center">پیش نمایش</th>
                                    <th class="text-center"> عملیات </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pages as $key => $page)
                                    <tr id="row-{{ $page->pageid }}">
                                        {{--  <th class="text-center">
                                            <input type="checkbox" name="data[{{$page->pageid}}][check]" id="{{$page->pageid}}" value="1">
                                        </th>  --}}
                                        <th class="text-center" width="100">
                                            <input type="number" class="form-control" name="data[{{$page->pageid}}][orderby]" id="orderby{{$page->pageid}}" value="{{$page->orderby}}">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" class="form-control" name="data[{{$page->pageid}}][title]" id="title{{$page->pageid}}" value="{{$page->title}}">
                                        </th>
                                        <th class="text-center">
                                            <select name="data[{{$page->pageid}}][level]" id="data[{{$page->pageid}}][level]" class="form-control">
                                                <option value="E" {{ ($page->level == 'E') ? 'selected' : ''}}>سطح 1</option>
                                                <option value="P" {{ ($page->level == 'P') ? 'selected' : ''}}>سطح 2</option>
                                            </select>
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$page->pageid}}][active]" {{($page->active == 'Y') ? 'checked' : ''}} value="Y">
                                        </th>
                                        <th class="text-center">
                                            <select name="data[{{$page->pageid}}][place]" id="data[{{$page->pageid}}][place]" class="form-control">
                                                <option value="FOOTER" {{ ($page->place == 'FOOTER') ? 'selected' : ''}}>نمایش در فوتر</option>
                                                <option value="CATEGORY" {{ ($page->place == 'CATEGORY') ? 'selected' : ''}}>نمایش در منو</option>
                                            </select>
                                        </th>
                                        <th class="text-center">
                                            <a href="https://cerampakhsh.com/page/{{str_replace(' ','+',($page->title) ? $page->title : 'jsj')}}/{{$page->pageid}}" target="_blank">پیش نمایش</a>
                                        </th>
                                        <th class="text-center">
                                            <i onclick="delete_('{{ route('panel.adminer.page.delete', ['pageid'=>$page->pageid]) }}', '{{ route('panel.adminer.pages') }}')" class="btn btn-youtube waves-effect btn-circle float-right waves-light"><i class="fa fa-times"></i> </i>
                                            <a class="btn btn-twitter waves-effect btn-circle waves-light" title="ویرایش" data-title="ویرایش" href="{{ route('panel.adminer.page.edit', ['pageid'=>$page->pageid]) }}"><i class="fa fa-edit"></i></a>
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
