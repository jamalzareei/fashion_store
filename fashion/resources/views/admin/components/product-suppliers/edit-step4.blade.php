<form action="{{ route('panel.product.admin.step.4.post') }}" method="POST" class=" col-md-8 offset-md-2 ajaxForm" id="dropzone" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">

    @if ($extrafields)
        
        @forelse ($extrafields as $extra)
        
            <div class="form-group col-md-6 mb-2 float-left" id="element-extra_filed-{{$extra->id}}">
                <label for="extra_filed-{{$extra->id}}">{{$extra->name}}</label>
                <div class="input-group">
                    @if ($extra->default_list)
                    <?php $values = explode(',', $extra->default_list) ?>
                        <select name="extra_filed[{{$extra->id}}]" class="form-control" id="extra_filed-{{$extra->id}}" aria-describedby="basic-addon-{{$extra->name}}">
                                <option value=""></option>
                            @foreach ($values as $item)
                                <option value="{{$item}}" {{ ($extra->extrafieldsproduct && $extra->extrafieldsproduct[0]->value == $item) ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    @else
                        
                    <input type="text" name="extra_filed[{{$extra->id}}]" class="form-control" id="extra_filed-{{$extra->id}}" aria-describedby="basic-addon-{{$extra->name}}"  value="{{ ($extra->extrafieldsproduct) ? $extra->extrafieldsproduct[0]->value : ''}}">
                    @endif
                </div>
                <span class="help-block text-danger small error-extra_filed"></span>
            </div>
        @empty
        @endforelse
    @endif
    <div id="list-properties"></div>
    
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