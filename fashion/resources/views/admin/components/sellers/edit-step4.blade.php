<form action="{{ route('panel.seller.admin.step.4.post') }}" method="POST" class=" floating-labels col-md-8 offset-md-2 ajaxForm" id="dropzone" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $seller->id }}">

    @foreach ($sosials as $sosial)
        
    <div class="form-group col-md-12 mb-5 float-left">
        <?php $sosLink = $seller->sosialSeller->where('sosial_id', $sosial->id)->first(); ?>
        <input type="text" class="form-control" value="{{$sosLink ? $sosLink->link : ''}}" id="sosial" data-role="tagsinput" name="sosials[{{ $sosial->id }}]"><span class="highlight"></span> <span class="bar"></span>
        <label for="sosial">{{ $sosial->name }}</label>
        <span class="help-block text-danger small error-sosial"></span>
    </div>
    @endforeach
    
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