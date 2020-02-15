@extends('admin.layouts.master')

@section('title')
@endsection

@section('css')
    
<link href="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">

<link href="{{asset('panel/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    
                </div>
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
                                <th class="text-center">#</th>
                                <th class="text-center">IP</th>
                                <th class="text-center">نام</th>
                                <th class="text-center">ایمیل</th>
                                <th class="text-center">فعال</th>
                                <th class="text-center">لینک صفحه</th>
                                <th class="text-center"> عملیات </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reviews as $key => $review)
                                <tr id="row-{{$review->id}}">
                                    <th class="text-center">
                                        {{$review->id}}
                                    </th>
                                    <th class="text-center">
                                        {{$review->remote_ip}}
                                    </th>
                                    <th class="text-center">
                                        {{$review->name}}
                                    </th>
                                    <th class="text-center">
                                        {{$review->email}}
                                    </th>
                                    <th class="text-center">
                                        <form action="{{ route('panel.adminer.review.update', ['type'=>$type,'id'=>$review->id,'coloumn'=>'active']) }}" name="active_{{$review->id}}" method="post" class="ajaxForm">
                                            @csrf
                                            <button class="btn btn-primary hidden" type="submit">ثبت نظر</button>
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small" onchange="javascript: document.active_{{$review->id}}.submit(function(e) { e.preventDefault();})" name="active" {{($review->active == 'Y') ? 'checked' : ''}} value="Y">
                                        </form>
                                    </th>
                                    <th class="text-center">
                                        @if ($review[$type])
                                            
                                        <a href="https://cerampakhsh.com/{{$type}}/{{($review[$type]) ? $review[$type]->slug : ''}}" target="_blank">لینک صفحه</a>
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample-{{$review->id}}" aria-expanded="false" aria-controls="collapseExample-{{$review->id}}">
                                            نمایش و جواب
                                        </button>
                                        <i onclick="delete_('{{ route('panel.adminer.review.delete', ['type'=>$type,'id'=>$review->id]) }}', '{{ route(\Request::route()->getName()) }}')" class="btn btn-youtube waves-effect btn-circle float-right waves-light"><i class="fa fa-times"></i> </i>
                                    </th>
                                </tr>
                                <tr class="collapse" id="collapseExample-{{$review->id}}">
                                    <th colspan="7" class="text-right">
                                        <p>
                                            {{$review->message}}
                                        </p>
                                        <form action="{{ route('panel.adminer.review.update', ['type'=>$type,'id'=>$review->id,'coloumn'=>'reply']) }}" method="post" class="ajaxForm">
                                            @csrf
                                            <label for="value{{$review->id}}">جواب دادن به کامنت</small></label>
                                            <textarea name="reply" class="form-control" id="" cols="30" rows="5">{{$review->reply}}</textarea>
                                            <br>
                                            <button class="btn btn-success" type="submit">ثبت نظر</button>
                                        </form>
                                        <hr>
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-danger text-center">
                                            نظری ثبت نشده است
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    {{--  <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>  --}}
                                    <div class="row text-center">
                                        {{ $reviews->appends($_GET)->links() }}
                                    </div>
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

<script src="{{asset('panel/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script type="text/javascript">
    $('.js-switch').bootstrapSwitch();
</script>
@endsection
