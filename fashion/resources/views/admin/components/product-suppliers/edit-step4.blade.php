<form action="{{ route('edit.product.step.4.supplier.post') }}" method="POST" class=" col-md-8 offset-md-2 ajaxForm" id="dropzone" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="productid" value="{{ $product->productid }}">

    @if ($extrafields)
        
        @forelse ($extrafields as $extra)
            {{-- @if ($extra->show_less == 'Y' || (count($extra->extrafieldvalues)) || $extra->value != '') --}}
                
            <div class="form-group col-md-6 mb-2 float-left" id="element-extra_filed-{{$extra->fieldid}}">
                <label for="extra_filed-{{$extra->fieldid}}">{{$extra->field}}</label>
                <div class="input-group">
                    @if ($extra->fieldid == 6)
                        <select multiple class="select2 m-b-10 select2-multiple" multiple data-placeholder="انتخاب کنید"id="extra_filed-{{$extra->fieldid}}" aria-describedby="basic-addon-{{$extra->field}}" name="extra_filed[{{$extra->fieldid}}][]"  value="{{ (count($extra->extrafieldvalues) ) ? $extra->extrafieldvalues[0]->value : '' }}">
                            <option value=""></option>
                            @foreach ($uses as $key => $use)
                                <optgroup label="{{$key}}" extra="{{(count($extra->extrafieldvalues) ) ? $extra->extrafieldvalues[0]->value : ''}}">
                                    <?php
                                    $values = explode(',', $use);
                                    $select = '';
                                    if(count($extra->extrafieldvalues) && str_replace('  ',' ',$key) == str_replace('  ',' ',$extra->extrafieldvalues[0]->value)){ 
                                        $select = 'selected';
                                    }
                                    
                                    ?>
                                    @foreach ($values as $use)
                                        <?php if(count($extra->extrafieldvalues) && str_replace(['  ', ' '],'',$use) == str_replace(['  ',' '],'',$extra->extrafieldvalues[0]->value)){  $select = 'selected';  } ?>
                                        <option {{$select}} <?php if(count($extra->extrafieldvalues) && strpos(trim($extra->extrafieldvalues[0]->value), trim($use)) !== false){ echo 'selected'; }else{echo 'checked';}  ?> value="{{$use}}">{{$use}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>

                        
                    @elseif ($extra->fieldid == 12)
                        <input type="text" class="form-control" data-mask="999 x 999 x 999" dir="ltr" id="extra_filed-{{$extra->fieldid}}" aria-describedby="basic-addon-{{$extra->field}}" name="extra_filed[{{$extra->fieldid}}]"  value="{{ (count($extra->extrafieldvalues) ) ? $extra->extrafieldvalues[0]->value : '' }}">
                                            
                    @elseif ($extra->fieldid == 1)
                        <?php $values = explode(',', $extra->value) ?>
                        <select name="extra_filed[{{$extra->fieldid}}]" class="form-control disabled" id="extra_filed-{{$extra->fieldid}}" aria-describedby="basic-addon-{{$extra->field}}" >
                                <option value=""></option>
                            @foreach ($values as $item)
                                <option value="{{$item}}" {{ (isset($extra->extrafieldvalues[0]) ) ? ((trim(str_replace(['کاشی','سرامیک','پرسلان',' '],'',$extra->extrafieldvalues[0]->value)) == trim($item)) ? 'selected' : '') : '' }}>{{$item}}</option>
                            @endforeach
                        </select>
                    @else
                        @if ($extra->value)
                        <?php $values = explode(',', $extra->value) ?>
                            <select name="extra_filed[{{$extra->fieldid}}]" class="form-control" id="extra_filed-{{$extra->fieldid}}" aria-describedby="basic-addon-{{$extra->field}}">
                                    <option value=""></option>
                                @foreach ($values as $item)
                                    <option value="{{$item}}" {{ (count($extra->extrafieldvalues) ) ? ((trim($extra->extrafieldvalues[0]->value) == trim($item)) ? 'selected' : '') : '' }}>{{$item}}</option>
                                @endforeach
                            </select>
                        @else
                            
                        <input type="text" class="form-control" id="extra_filed-{{$extra->fieldid}}" aria-describedby="basic-addon-{{$extra->field}}" name="extra_filed[{{$extra->fieldid}}]"  value="{{ (count($extra->extrafieldvalues) ) ? $extra->extrafieldvalues[0]->value : '' }}">
                        @endif
                    @endif
                    
                    @if ($extra->show_less == 'N')
                    <span class="input-group-addon cursor" id="basic-addon-{{$extra->field}}" onclick="removeProperetyList('#element-extra_filed-','{{$extra->fieldid}}','{{$extra->field}}')"><i class="text-danger fa fa-times" ></i></span>    
                    @endif
                </div>
                <span class="help-block text-danger small error-extra_filed"></span>
            </div>
            {{-- @endif --}}
            @empty
        @endforelse
    @endif
    <div id="list-properties"></div>
    {{-- <select class="form-control" id="addPropertyField">
        <option value="">-- اضافه کردن --</option>
        @if ($extrafields)
            @forelse ($extrafields as $extra)
                @if ($extra->show_less == 'N' && (count($extra->extrafieldvalues) == 0))
                    <option value="" fieldid="{{$extra->fieldid}}" field="{{$extra->field}}">{{$extra->field}}</option>
                @endif
            @empty
            @endforelse
        @endif
    </select> --}}
    
    <button type="submit" class="btn btn-success waves-effect waves-light mt-4 m-l-10 btn-block">ویرایش</button>
</form>

<script>
    function value_6(_this){
        //alert(_this.value);
        $('.value_6_selected').val(_this.value);
    }
    $("input").click(function(){
        var value= $(this).val();
        if(value.length < 1){
           $(this).attr("value", -1);
        }
    });

    
</script>