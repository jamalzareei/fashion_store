<div class="row">
    <div class="col-md-4 pb-3">
        <select class="select2 m-b-10 select2-multiple" data-placeholder="انتخاب کنید"  id="categories" name="country_id" onchange="changeCategory('{{ route('change.location', ['type' => 'state']) }}', this.value,'#state_id')">
            @if ($seller->country)
            <option value="{{$seller->country_id}}">{{$seller->country->name}}</option>
            @endif
            {!! $countries !!}
        </select>
        <label for="categories" style="float: right;position: absolute;right: 5px;top: -20px;">کشور</label>
        <span class="help-block text-danger small error-categories"></span>
                
    </div>
    <div class="col-md-4 pb-3">
        <select class="select2 m-b-10 select2-multiple" data-placeholder="انتخاب کنید"  id="state_id" name="state_id" onchange="changeCategory('{{ route('change.location', ['type' => 'city']) }}', this.value,'#city_id')">
            @if ($seller->state)
                <option value="{{$seller->state_id}}">{{$seller->state->name}}</option>
            @endif
        </select>
        <label for="state_id" style="float: right;position: absolute;right: 5px;top: -20px;">استان</label>
        <span class="help-block text-danger small error-state_id"></span>
    </div>
    <div class="col-md-4 pb-3">
        <select class="select2 m-b-10 select2-multiple" data-placeholder="انتخاب کنید"  id="city_id" name="city_id">
            @if ($seller->city)
                <option value="{{$seller->city_id}}">{{$seller->city->name}}</option>
            @endif
        </select>
        <label for="city_id" style="float: right;position: absolute;right: 5px;top: -20px;">شهر</label>
        <span class="help-block text-danger small error-categories.2"></span>
    </div>
</div>