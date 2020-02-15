<a id="imageRowPlace-{{ $image['id'] }}" href="javascript:void(0)" title="" style="position: relative;margin-top:3px;">
    <img src="https://cerampakhsh.com/{{ str_replace('/var/www/vhosts/cerampakhsh.com/httpdocs/','',$image["image_path"]) }}" width="32.5%" style="margin-top: 3px;">
    <button class="btn btn-sm btn-block btn-danger" onclick="delete_row('{{ route('delect.decor.image.supplier.post', ['id' => $image['id']]) }}', 'imageRowPlace-{{ $image['id'] }}')" style="width: 50%;position: absolute;left: 25%;top: 2px;">حذف عکس</button>
    
</a>