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
                <form action="{{ route('panel.adminer.suppliers') }}" method="GET">
                    <div class="row">
                        <div class="col-10">
                            <input type="text" name="title" class="form-control" placeholder="جستجو بر اساس نام کارخانه">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="{{ route('panel.adminer.manufactor.updateOrInsert') }}" class="btn btn-warning float-right"><i class="fa fa-plus"></i> اضافه کردن کارخانه جدید </a>
            </div>
        </div>
        <hr>
        <div class="panel panel-danger">
            <div class="panel-heading"> {{ $title }}</div>
            <div class="panel-body pt-5 row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                        <table class="table color-bordered-table inverse-bordered-table">
                            <thead>
                                <tr>
                                    <td colspan="7">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th class="text-center">نام کارخانه</th>
                                    <th class="text-center">نام کارخانه (english)</th>
                                    <th class="text-center">کاربر متصل</th>
                                    <th class="text-center">استان</th>
                                    <th class="text-center">شهر</th>
                                    <th class="text-center">فعال</th>
                                    <th class="text-center"> عملیات </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($factories as $key => $factory)
                                    <tr id="row-{{ $factory->manufacturerid }}">
                                        {{--  <th class="text-center">
                                            <input type="checkbox" name="data[{{$factory->manufacturerid}}][check]" id="{{$factory->manufacturerid}}" value="1">
                                        </th>  --}}
                                        <th class="text-center">
                                            {{$factory->manufacturer}}
                                        </th>
                                        <th class="text-center">
                                            {{$factory->manufacturer_en}}
                                        </th>
                                        <th class="text-center">
                                            {{$factory->user_login}}
                                        </th>
                                        <th class="text-center">
                                            {{$factory->state}}
                                        </th>
                                        <th class="text-center">
                                            {{$factory->city}}
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$factory->manufacturerid}}][avail]" {{($factory->avail == 'Y') ? 'checked' : ''}} value="Y">
                                        </th>
                                        <th class="text-center">
                                            <a class="btn btn-twitter waves-effect btn-circle waves-light" title="ویرایش" data-title="ویرایش" href="{{ route('panel.adminer.manufactor.updateOrInsert', ['manufacturerid'=>$factory->manufacturerid]) }}"><i class="fa fa-edit"></i></a>
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-danger text-center">
                                                هیچ کارخانه ای وجود ندارد
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        {{--  <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>  --}}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    
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
