@extends('admin.layouts.master') 
@section('title') @endsection
@section('css')

<link href="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">
 @endsection
@section('content') 
<div class="white-box table-responsive">

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('panel.admin.products') }}" method="GET">
                <div class="row">
                    <div class="col-10">
                        <input type="text" name="title" class="form-control" localhomeholder="جستجو  ( نام، ... )">
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
                <th>کد محصول</th>
                <th>نام محصول</th>
                <th>فروشنده</th>
                <th>کاربر</th>
                <th>فعال</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $key => $product)
                <tr id="delete-{{ $product->id }}">
                    <td>{{$product->code}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{($product->seller) ? $product->seller->name : '' }}</td>
                    <td>{{($product->user) ? $product->user->username : '' }}</td>
                    <th class="text-center">
                        <input data-on-text="فعال" data-off-text="غیرفعال" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$product->id}}][active_admin]" {{($product->active_admin || $product->active_admin) ? 'checked' : ''}} value="1" onchange="changeStatus('{{route('panel.admin.product.change.status.post', ['id' => $product->id])}}',this)">
                        
                    </th>
                    
                    <th class="text-center">
                        <a class="btn btn-twitter waves-effect btn-circle waves-light" title="ویرایش" data-title="ویرایش" href="{{ route('panel.admin.product.edit', ['slug'=>$product->slug]) }}"><i class="fa fa-edit"></i></a>
                        <i onclick="delete_('{{ route('panel.admin.product.delete.post', ['id'=>$product->id]) }}', '{{ url()->full() }}')" class="btn btn-youtube waves-effect btn-circle float-right waves-light"><i class="fa fa-times"></i> </i>
                    </th>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="alert alert-danger text-center">
                            هیچ محصولی اضافه نشده است.
                        </div>
                    </td>
                </tr>
            @endforelse
            
        </tbody>
        <tfoot>
                
        </tfoot>
    </table>
    <div class="row text-center">
        {{ $products->appends($_GET)->links() }}
    </div>
</div>
@endsection
@section('js') 

<script src="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.js')}}"></script>
<script type="text/javascript">
    $('.js-switch').bootstrapSwitch();
</script>
@endsection