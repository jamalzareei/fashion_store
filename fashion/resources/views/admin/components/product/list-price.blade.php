<table class="table color-bordered-table inverse-bordered-table">
    <thead>
        <tr>
            <th>#</th>
            <th>کد محصول</th>
            <th>نام محصول</th>
            <th>فروشنده مرتبط</th>
            <th>قیمت اصلی</th>
            <th>درصد تخفیف</th>
            <th>هزینه نصب</th>
            <th>زمان تحویل</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($prices as $key => $price)
            <tr id="delete-{{ $price->id }}">
                <td>{{$key+1}}</td>
                <td>{{$price->product->productcode}}</td>
                <td>{{$price->product->product}}</td>
                <td>{{($price->merchant) ? $price->merchant->title : 'قیمت کارخانه'}}</td>
                <td>{{$price->price}} ریال</td>
                <td>{{$price->discount}} %</td>
                <td>@if ($price->installation_costs){{$price->installation_costs}} ریال @endif</td>
                <td>@if ($price->delivery_time) {{$price->delivery_time}} روز @endif</td>
            </tr>
        @empty
            <tr>
                <td colspan="8">
                    <div class="alert alert-danger text-center">
                        هیچ قیمتی وارد نشده است
                    </div>
                </td>
            </tr>
        @endforelse
        
    </tbody>
    <tfoot>
            
    </tfoot>
</table>