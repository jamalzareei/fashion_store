@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') @endsection
@section('content') 
<div class="white-box table-responsive">

    
    <table class="table color-bordered-table inverse-bordered-table">
        <thead>
            <tr>
                <th>#</th>
                <th>نام</th>
                <th>شهر</th>
                <th>تلفن تماس</th>
                <th>ساعت کار</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lists as $key => $list)
                <tr id="delete-{{ $list->id }}">
                    <td>{{$key+1}}</td>
                    <td>{{$list->title}}</td>
                    <td>{{$list->city}}</td>
                    <td>{{$list->phone}}-{{$list->phone_number}}</td>
                    <td>{{$list->time_work}}</td>
                    <td>
                        {{-- <a class="btn btn-danger" title="حذف" data-title="حذف" href="{{ route('edit.merchant', ['slug'=>$list->slug]) }}"><i class="fa fa-times"></i></a> --}}
                        <a class="btn btn-info" title="ویرایش" data-title="ویرایش" href="{{ route('edit.merchant', ['merchant_id'=>$list->id]) }}"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="alert alert-danger text-center">
                            هیچ فروشنده / نصاب / شرکت حمل اضافه نشده است
                        </div>
                    </td>
                </tr>
            @endforelse
            
        </tbody>
        <tfoot>
                
        </tfoot>
    </table>
    <div class="row text-center">
        {{ $lists->appends($_GET)->links() }}
    </div>
</div>
@endsection
@section('js') @endsection