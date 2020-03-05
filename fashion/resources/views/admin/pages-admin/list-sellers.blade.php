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
                <form action="{{ route('panel.admin.sellers') }}" method="GET">
                    <div class="row">
                        <div class="col-10">
                            <input type="text" name="title" class="form-control" placeholder="نام یا اسلاگ و یا شماره تلفن">
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
            <div class="panel-body pt-5 row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                    {{--  <form action="{{ route('panel.admin.categories.update') }}" method="post">
                        @csrf  --}}
                        <table class="table color-bordered-table inverse-bordered-table">
                            <thead>
                                {{--  <tr>
                                    <td colspan="7">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>  --}}
                                <tr class="text-center">
                                    {{--  <th class="text-center">#</th>  --}}
                                    <th class="text-center">مدیریت</th>
                                    <th class="text-center">نام</th>
                                    <th class="text-center">شماره تماس</th>
                                    <th class="text-center">آدرس</th>
                                    <th class="text-center">فعال</th>
                                    <th class="text-center">تماس گرفته شده</th>
                                    <th class="text-center"> عملیات </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sellers as $key => $seller)
                                    <tr id="row-{{ $seller->id }}">
                                        <th class="text-center">
                                            <a href="{{ route('panel.admin.seller.edit', ['slug'=>$seller->slug]) }}">{{$seller->manager}}</a>
                                        </th>
                                        <th class="text-center">
                                            <a href="{{ route('panel.admin.seller.edit', ['slug'=>$seller->slug]) }}">{{$seller->name}}</a>
                                        </th>
                                        <th class="text-center">
                                            <a href="{{ route('panel.admin.seller.edit', ['slug'=>$seller->slug]) }}">{{$seller->phones}} <br> {{ $seller->user->username}}</a>
                                        </th>
                                        <th class="text-center">
                                            <a href="{{ route('panel.admin.seller.edit', ['slug'=>$seller->slug]) }}">{{$seller->state_id}}-{{$seller->city_id}}</a>
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="فعال" data-off-text="غیرفعال" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$seller->id}}][active_admin]" {{($seller->active_verified_at) ? 'checked' : ''}} value="1" onchange="changeStatus('{{route('panel.admin.sellers.update', ['id' => $seller->id])}}',this)">
                                            
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="تماس" data-off-text="انتظار" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$seller->id}}][active_admin]" {{($seller->tell_verified_at) ? 'checked' : ''}} value="1" onchange="changeStatus('{{route('panel.admin.sellers.tell.update', ['id' => $seller->id])}}',this)">
                                            
                                        </th>
                                        <th class="text-center">
                                            <a class="btn btn-twitter waves-effect btn-circle waves-light" title="دیدن اطلاعات کامل" data-title="دیدن اطلاعات کامل" href="{{ route('panel.admin.seller', ['slug'=>$seller->slug]) }}"><i class="fa fa-eye"></i></a>
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-danger text-center">
                                                فروشنده ای وجود ندارد.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                            <tfoot>
                                {{--  <tr>
                                    <td colspan="7">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>  --}}
                            </tfoot>
                        </table>
                    {{--  </form>  --}}
                    
                    <div class="row text-center">
                        {{ $sellers->appends($_GET)->links() }}
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
