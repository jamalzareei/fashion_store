<a id="imageRowPlace-{{ $image['id'] }}" href="javascript:void(0)" title="" style="position: relative;margin-top:3px;">
    <img src="{{ asset($image["path"]) }}" width="32.5%" style="margin-top: 3px;">
    <button class="btn btn-sm btn-block btn-danger" onclick="delete_row('{{ route('panel.product.admin.step.2.delete.post', ['id' => $image['id']]) }}', 'imageRowPlace-{{ $image['id'] }}')" style="width: 50%;position: absolute;left: 25%;top: 2px;">حذف عکس</button>
    
</a>