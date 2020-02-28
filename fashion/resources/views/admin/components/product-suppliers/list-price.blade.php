<table class="table color-bordered-table inverse-bordered-table">
    <thead>
        <tr>
            <th>#</th>
            <th>فروشنده</th>
            <th>قیمت</th>
            <th>تعداد</th>
            <th>درصد تخفیف</th>
            <th>ویژگی ها</th>
            <th>زمان تحویل</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($prices as $key => $price)
            <tr id="delete-{{ $price->id }}">
                <td>{{$key+1}}</td>
                <td>{{$price->seller_id}}</td>
                <td>{{$price->price}}</td>
                <td>{{($price->count)}}</td>
                <td>درصد تخفیف</td>
                <td>ویژگی ها</td>
                <td>زمان تحویل</td>
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