@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') @endsection
@section('content') 
<div class="white-box table-responsive">

    <div class="row">
        <div class="col-md-6">
            {{--  <form action="{{ route('list.order.merchant') }}" method="GET">
                <div class="row">
                    <div class="col-10">
                        <input type="text" name="order" class="form-control" localhomeholder="جستجو  ( نام، ... )">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>  --}}
        </div>
    </div>
    <hr>
    <table class="table color-bordered-table inverse-bordered-table">
        <thead>
            <tr>
                <th>#</th>
                <th>عنوان</th>
                <th>فرستنده</th>
                <th>تاریخ</th>
                <th>وضعیت</th>
                <th>مشاهده</th>
            </tr>
        </thead>
        <tbody>
             @forelse ($tickets as $key => $ticket)
                <tr id="delete-{{ $ticket->id }}">
                    <td>{{$key}}</td>
                    <td>{{$ticket->title}}</td>
                    <td>@if($ticket->sender){{$ticket->sender->firstname}} {{$ticket->sender->lastname}}@endif</td>
                    <td>{{$ticket->date}}</td>
                    <td>
                        @if (count($ticket->user))
                            <span class="text-success">    خوانده شده</span>
                        @else
                            <span class="text-danger">    خوانده نشده</span>
                        @endif
                    </td>
                    <td>
                        <i class="fa fa-eye" onclick="showMessage('{{ route('suppliers.ticke.show', ['id'=>$ticket->id]) }}')" data-toggle="modal" data-target=".show-message-lg"></i>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="alert alert-danger text-center">
                            هیچ پیامی ندارید.
                        </div>
                    </td>
                </tr>
            @endforelse 
            
        </tbody>
        <tfoot>
                
        </tfoot>
    </table>
    <div class="row text-center">
         {{ $tickets->appends($_GET)->links() }} 
    </div>
    <div class="modal fade show-message-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel"></h4>
                </div>
                <div class="modal-body" id="show-message-modal">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-right" data-dismiss="modal">بستن</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@endsection
@section('js') @endsection

