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
                    <form class="form-inline w-100" action="{{ route('panel.adminer.properties.add', ['categoryid'=> $category_id ]) }}" method="post">
                        @csrf
                        <div class="col-md-2 input-group">
                            <input type="number" name="orderby" class="form-control" placeholder="موقعیت" value="{{old('orderby')}}">
                            @error('orderby')
                                <div class="help-block text-danger small error-orderby">{{ $message }}</div>
                            @else
                                <div class="help-block text-info small error-orderby">موقعیت از نوع عدد</div>
                            @enderror
                        </div>
                        <div class="col-md-2 input-group">
                            <input type="text" name="field" class="form-control" placeholder="نام پراپرتی" value="{{old('field')}}">
                            @error('field')
                                <div class="help-block text-danger small error-field">{{ $message }}</div>
                            @else
                                <div class="help-block text-info small error-orderby"> اکسترا فیلد</div>
                            @enderror
                        </div>
                        <div class="col-md-4 input-group">
                            <input type="text" name="value" class="form-control" data-role="tagsinput" placeholder="با تب یا اینتر کلمه اضافه میشود" value="{{old('value')}}">
                            <div class="help-block text-info small error-orderby">با تب یا اینتر کلمه اضافه میشود</div>
                        </div>
                        <div class="col-md-1 input-group">
                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox"  checked name="active" value="Y">
                            <div class="help-block text-info small error-orderby"> فعال یا غیر فعال </div>
                        </div>
                        <div class="col-md-1 input-group">
                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox"  checked name="show_less" value="Y">
                            <div class="help-block text-info small error-orderby"> نمایش در کنار محصول</div>
                        </div>
                        <div class="col-md-2 input-group">
                            <button type="submit" class="btn btn-info">افزودن</button>
                            <div class="help-block text-info small error-orderby"> &nbsp;</div>
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
                    <form action="{{ route('panel.adminer.properties.update') }}" method="post">
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
                                    <tr id="row-{{ $property->fieldid }}">
                                        {{--  <th class="text-center">
                                            <input type="checkbox" name="data[{{$property->fieldid}}][check]" id="{{$property->fieldid}}" value="1">
                                        </th>  --}}
                                        <th class="text-center" width="100">
                                            <input type="text" class="form-control" name="data[{{$property->fieldid}}][orderby]" id="orderby{{$property->fieldid}}" value="{{$property->orderby}}">
                                        </th>
                                        <th class="text-center">
                                            <input type="text" class="form-control" name="data[{{$property->fieldid}}][field]" id="field{{$property->fieldid}}" value="{{$property->field}}">
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$property->fieldid}}][active]" {{($property->active == 'Y') ? 'checked' : ''}} value="Y">
                                        </th>
                                        <th class="text-center">
                                            <input data-on-text="بلی" data-off-text="خیر" class="js-switch small" type="checkbox" data-size="small"  name="data[{{$property->fieldid}}][show_less]" {{($property->show_less == 'Y') ? 'checked' : ''}} value="Y">
                                        </th>
                                        <th class="text-center">
                                            <i onclick="delete_('{{ route('panel.adminer.property.delete', ['propertyid'=>$property->fieldid]) }}', '{{ route('panel.adminer.properties', ['categoryid' => $category_id]) }}')" class="btn btn-youtube waves-effect btn-circle float-left waves-light"><i class="fa fa-times"></i> </i>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">
                                            <label for="value{{$property->fieldid}}">لیست موارد پیشفرض <small>(موارد را با کاما از هم جدا نمایید.)</small></label>
                                            <input type="text" class="form-control" data-role="tagsinput" name="data[{{$property->fieldid}}][value]" id="value{{$property->fieldid}}" value="{{$property->value}}">
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
