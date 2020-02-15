@extends('admin.layouts.master') 
@section('title') @endsection
@section('css')


<link href="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">
<style>
    @media print {
        .navbar.navbar-default.navbar-static-top.m-b-0 {
            display: none;
        }
        .navbar-default.sidebar {
            display: none;
        }
        #page-wrapper {
            margin: 0 !important;
            padding: 0;
        }
        .row.bg-title {
            display: none;
        }
        .footer.text-center {
            display: none;
        }
        table tr:last-child {
            display: none;
        }
        table tr td:nth-child(n+5) {
            display: none;
        }
    }
</style>
@endsection
@section('content') 
<div class="white-box table-responsive">

    <div class="row">
            <form class="col-md-12" action="{{ route('update.price.avail.poducts') }}" method="GET">
                    <div class="row">
                        <div class="col-5">
                            <input type="text" name="value" class="form-control" localhomeholder="size">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
    </div>
    <hr>
    <form action="{{ route('update.price.avail.poducts.post') }}" method="post">
        @csrf
        <table class="table color-bordered-table inverse-bordered-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>کد محصول</th>
                    <th>نام محصول</th>
                    <th>ویژگی ها</th>
                    <th>قیمت</th>
                    <th>موجودی</th>
                    <th>در دسترس</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $key => $product)
                    <tr id="delete-{{ $product->productid }}">
                        <td>{{$key+1}}</td>
                        <td>{{$product->productcode}}</td>
                        <td>{{$product->product}}</td>
                        <td>

                            @forelse ($product->extrafieldvalues as $record)
                            {{$record->value.'    ,   '}}
                            {{-- <span class="label label-inverse">{{$record->value}}</span> --}}
                            @empty
                                
                            @endforelse
                            
                        </td>
                        <td>
                            <input class="form-control" type="hidden" name='data[{{ $key }}][productid]' value="{{$product->productid}}">
                            <input class="form-control" type="text" required name='data[{{ $key }}][price]' value="{{(count($product->prices)) ? $product->prices[0]->price : '0'}}">
                        </td>
                        <td>
                            <input class="form-control" type="text" name='data[{{ $key }}][avail]' value="{{(count($product->prices)) ? $product->prices[0]->avail : '0'}}">
                        </td>
                        
                        <td>
                            <input data-on-text="بله" data-off-text="خیر" type="checkbox" name='data[{{ $key }}][forsale]' {{($product->forsale == 'Y') ? 'checked' : ''}} value="Y">
                        </td>
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
                    <tr>
                        <td colspan="8">
                            <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                        </td>
                    </tr>
                
            </tbody>
            <tfoot>
                    
            </tfoot>
        </table>
    </form>
    <div class="row text-center">
        {{-- {{ $products->appends($_GET)->links() }} --}}
    </div>
</div>
@endsection
@section('js') 
<script src="{{asset('panel/assets/plugins/bootstrap-switch/bootstrap-switch.min.js')}}"></script>
	<script type="text/javascript">
		$(".bt-switch input[type='checkbox'], .bt-switch input[type='radio'], input[type='checkbox']").bootstrapSwitch();
		
	</script>
@endsection