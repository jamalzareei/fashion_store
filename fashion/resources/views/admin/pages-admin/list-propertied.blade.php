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
                    <form class="form-inline w-100" action="{{ route('panel.admin.properties.add', ['category_id'=> $category_id ]) }}" method="post">
                        @csrf
                        <div class="col-md-2 input-group">
                            <input type="number" name="order" class="form-control" placeholder="موقعیت" value="{{old('order')}}">
                            @error('order')
                                <div class="help-block text-danger small error-order">{{ $message }}</div>
                            @else
                                <div class="help-block text-info small error-order">موقعیت از نوع عدد</div>
                            @enderror
                        </div>
                        <div class="col-md-2 input-group">
                            <input type="text" name="name" class="form-control" placeholder="نام پراپرتی" value="{{old('name')}}">
                            @error('name')
                                <div class="help-block text-danger small error-name">{{ $message }}</div>
                            @else
                                <div class="help-block text-info small error-orderby"> اکسترا فیلد</div>
                            @enderror
                        </div>
                        <div class="col-md-4 input-group">
                            <input type="text" name="default_list" class="form-control" data-role="tagsinput" placeholder="با تب یا اینتر کلمه اضافه میشود" value="{{old('default_list')}}">
                            <div class="help-block text-info small error-default_list">با تب یا اینتر کلمه اضافه میشود</div>
                        </div>
                        <div class="col-md-1 input-group">
                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox"  checked name="active" value="1">
                            <div class="help-block text-info small error-active"> فعال یا غیر فعال </div>
                        </div>
                        <div class="col-md-2 input-group">
                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox"  checked name="show_less" value="1">
                            <div class="help-block text-info small error-show_less"> نمایش در کنار محصول</div>
                        </div>
                        <div class="col-md-2 input-group">
                            <button type="submit" class="btn btn-info">افزودن</button>
                            <div class="help-block text-info small error-submit"> &nbsp;</div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        <hr>
        <div class="panel panel-danger">
            <div class="panel-heading"> {{ $title }}</div>
            <div class="panel-body pt-5 row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                    <form action="{{ route('panel.admin.properties.update') }}" method="post">
                        @csrf
                        <table class="table color-bordered-table inverse-bordered-table">
                            <thead>
                                <tr>
                                    <td colspan="5">
                                        <button class="btn btn-block btn-rounded btn-primary waves-effect" type="submit">اعمال تغییرات</button>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    {{--  <th class="text-center">#</th>  --}}
                                    <th class="text-center">موقعیت</th>
                                    <th class="text-center">نام</th>
                                    <th class="text-center">فعال</th>
                                    <th class="text-center">نمایش در کنار محصول</th>
                                    <th class="text-center"> عملیات </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($properties as $key => $property)
                                    <tr id="row-{{ $property->id }}">
                                        {{--  <th class="text-center">
                                            <input type="checkbox" name="data[{{$property->id}}][check]" id="{{$property->id}}" value="1">
                                        </th>  --}}
                                        <th class="text-center" width="100">
                                            <input type="text" class="form-control" name="data[{{$property->id}}][order]" id="order{{$property->id}}" value="{{$property->order}}">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" class="form-control" name="data[{{$property->id}}][name]" id="name{{$property->id}}" value="{{$property->name}}">
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$property->id}}][active]" {{($property->active == '1') ? 'checked' : ''}} value="1">
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$property->id}}][show_less]" {{($property->show_less == '1') ? 'checked' : ''}} value="1">
                                        </th>
                                        <th class="text-center">
                                            <i onclick="delete_('{{ route('panel.admin.property.delete', ['property_id'=>$property->id]) }}', '{{ url()->full() }}')" class="btn btn-youtube waves-effect btn-circle float-right waves-light"><i class="fa fa-times"></i> </i>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">
                                            <label for="default_list{{$property->id}}">لیست موارد پیشفرض <small>(موارد را با کاما از هم جدا نمایید.)</small></label>
                                            <input type="text" class="form-control" data-role="tagsinput" name="data[{{$property->id}}][default_list]" id="default_list{{$property->id}}" value="{{$property->default_list}}">
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="alert alert-danger text-center">
                                                هیچ پراپرتی وجود ندارد
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">
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

<script src="{{asset('panel/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script type="text/javascript">
    $('.js-switch').bootstrapSwitch();
</script>
@endsection
