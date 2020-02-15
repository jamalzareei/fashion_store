@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') @endsection
@section('content') 
<div class="white-box table-responsive">

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('list.decor.supplier') }}" method="GET">
                <div class="row">
                    <div class="col-10">
                        <input type="text" name="decor" class="form-control" localhomeholder="جستجو  ( نام، ... )">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <table class="table color-bordered-table inverse-bordered-table">
        <thead>
            <tr>
                <th>#</th>
                <th>کد دکور</th>
                <th>نام دکور</th>
                <th>تولید کننده</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($decors as $key => $decor)
                <tr id="delete-{{ $decor->id }}">
                    <td>{{$key+1}}</td>
                    <td>{{$decor->code}}</td>
                    <td>{{$decor->title}}</td>
                    <td>{{$decor->manufactory->manufacturer}}</td>
                    <td>
                        <a class="btn btn-danger" title="ویرایش" data-title="ویرایش" href="{{ route('edit.decor.supplier', ['slug'=>$decor->slug]) }}"><i class="fa fa-edit"></i></a>
                        
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="alert alert-danger text-center">
                            هیچ دکوری اضافه نشده است.
                        </div>
                    </td>
                </tr>
            @endforelse
            
        </tbody>
        <tfoot>
                
        </tfoot>
    </table>
    <div class="row text-center">
        {{ $decors->appends($_GET)->links() }}
    </div>
</div>
@endsection
@section('js') @endsection