<a id="imageRowPlace-{{ $image['imageid'] }}" href="javascript:void(0)" title="" style="position: relative;margin-top:3px;">
    <img src="http://cerampakhsh.com/{{ str_replace('/var/www/vhosts/cerampakhsh.com/httpdocs/','',$image["image_path"]) }}" width="32.5%" style="margin-top: 3px;">
    <button class="btn btn-sm btn-block btn-danger" onclick="delete_row('{{ route('edit.product.step.2.merchant.delete.post', ['id' => $image['imageid']]) }}', 'imageRowPlace-{{ $image['imageid'] }}')" style="width: 50%;position: absolute;left: 25%;top: 2px;">حذف عکس</button>
    
</a>