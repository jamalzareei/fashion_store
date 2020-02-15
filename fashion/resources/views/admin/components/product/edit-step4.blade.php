<form action="{{ route('edit.product.step.4.merchant.post') }}" method="POST" class=" col-md-8 offset-md-2 ajaxForm" id="dropzone" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="productid" value="{{ $product->productid }}">

    @if ($extrafields)
        
        @forelse ($extrafields as $extra)
            @if ($extra->show_less == 'Y' || (count($extra->extrafieldvalues)))
                
            <div class="form-group col-md-6 mb-5 float-left" id="element-extra_filed-{{$extra->fieldid}}">
                <label for="extra_filed-{{$extra->fieldid}}">{{$extra->field}}</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="extra_filed-{{$extra->fieldid}}" aria-describedby="basic-addon-{{$extra->field}}" required name="extra_filed[{{$extra->fieldid}}]"  value="{{ (count($extra->extrafieldvalues) ) ? $extra->extrafieldvalues[0]->value : '' }}">
                    @if ($extra->show_less == 'N')
                    <span class="input-group-addon cursor" id="basic-addon-{{$extra->field}}" onclick="removeProperetyList('#element-extra_filed-','{{$extra->fieldid}}','{{$extra->field}}')"><i class="text-danger fa fa-times" ></i></span>    
                    @endif
                </div>
                <span class="help-block text-danger small error-extra_filed"></span>
            </div>
            @endif
            @empty
        @endforelse
    @endif
    <div id="list-properties"></div>
    <select class="form-control" id="addPropertyField">
        <option value="">-- اضافه کردن --</option>
        @if ($extrafields)
            @forelse ($extrafields as $extra)
                @if ($extra->show_less == 'N' && (count($extra->extrafieldvalues) == 0))
                    <option value="" fieldid="{{$extra->fieldid}}" field="{{$extra->field}}">{{$extra->field}}</option>
                @endif
            @empty
            @endforelse
        @endif
    </select>
    
    <button type="submit" class="btn btn-success waves-effect waves-light mt-4 m-l-10 btn-block">ویرایش</button>
</form>