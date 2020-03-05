<form class=" col-md-8 offset-md-2 ajaxForm" action="{{ route('panel.seller.admin.step.6.post') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$seller->id}}">
    <input type="hidden" name="ajax" value="ajax">
    <div class="row">
        
        <div class="form-group col-md-12 mb-5 float-left">
            <label for="time_transfor">حد اکثر زمان ارسال بر حسب روز</label>
            <input type="text" class="form-control" id="time_transfor" required name="time_transfor" value="{{ $seller->time_transfor }}"><span class="highlight"></span> <span class="bar"></span>
            <span class="help-block text-danger small error-time_transfor"></span>
        </div>

        
        
        <div class="form-group col-md-12 mb-5 float-left">
            <label for="">نحوه فروش</label>

            <div class="checkbox">
                <input id="sell_in_person" type="checkbox" name="sell_in_person" value="حضوری">
                <label for="sell_in_person"> حضوری </label>
            </div>
            <div class="checkbox">
                <input id="sell_online" type="checkbox" name="sell_online" value="انلاین و ارسال پستی ">
                <label for="sell_online"> انلاین و ارسال پستی </label>
            </div>
        </div>
        <div class="form-group col-md-12 mb-5 float-left">
            <label for="shipping_cost">هزینه پست</label>
            <input type="text" class="form-control" id="shipping_cost" required name="shipping_cost" value="{{ $seller->shipping_cost }}"><span class="highlight"></span> <span class="bar"></span>
            <span class="help-block text-danger small error-shipping_cost"></span>
        </div>
        <div class="form-group col-md-12 mb-5 float-left">
            <label for="">نحوه دریافت وجه</label>

            <div class="checkbox">
                <input id="pay_in_person" type="checkbox" name="pay_in_person" value="درب منزل ">
                <label for="pay_in_person"> درب منزل </label>
            </div>
            <div class="checkbox">
                <input id="pay_cart" type="checkbox" name="pay_cart" value="کارت به کارت">
                <label for="pay_cart"> کارت به کارت </label>
            </div>
            <div class="checkbox">
                <input id="pay_online" type="checkbox" name="pay_online" value="درگاه پرداخت">
                <label for="pay_online"> درگاه پرداخت </label>
            </div>
            <span class="help-block text-danger small error-name"></span>
        </div>
        

    </div>
    

    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ذخیره اطلاعات</button>

</form>