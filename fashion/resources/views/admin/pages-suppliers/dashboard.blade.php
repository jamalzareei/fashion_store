@extends('admin.layouts.master')

@section('title')
    پنل
@endsection

@section('css')
    
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5 row">
                <div class="col-lg-12 col-md-12 col-sm-12 pr-4">
                    <h3 class="box-title">اطلاعات کارخانه (تولید کننده)</h3>
                    <div class="row">
                        <div class="col-md-6 pl-4">
                            <h5 class="m-b-5 text-center ">اطلاعات پایه<span class="pull-left">{{ $progress['manufacturer'] }}%</span>  <a class="float-left btn btn-outline btn-primary " href="{{ route('panel.suppliers.edit') }}"><span class="btn-label p-0 m-0"><i class="fa fa-edit"></i></span> </a></h5>
                            <div class="progress mt-4 row">
                                <div class="progress-bar progress-bar-info" aria-valuenow="{{ $progress['manufacturer'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress['manufacturer'] }}%" role="progressbar"></div>
                            </div>
                        </div>
                        <div class="col-md-6 pl-4">
                            <h5 class="m-b-5 text-center ">دفتر مرکزی<span class="pull-left">{{ $progress['office'] }}%</span>  <a class="float-left btn btn-outline btn-primary " href="{{ route('panel.suppliers.sale.edit',['step' => 'office']) }}"><span class="btn-label p-0 m-0"><i class="fa fa-edit"></i></span> </a></h5>
                            <div class="progress mt-4 row">
                                <div class="progress-bar progress-bar-success" aria-valuenow="{{ $progress['office'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress['office'] }}%" role="progressbar"></div>
                            </div>
                        </div>
                        <div class="col-md-6 pr-4">
                            <h5 class="m-b-5 text-center ">دفتر فروش<span class="pull-left">{{ $progress['sale'] }}%</span>  <a class="float-left btn btn-outline btn-primary " href="{{ route('panel.suppliers.sale.edit',['step' => 'sale']) }}"><span class="btn-label p-0 m-0"><i class="fa fa-edit"></i></span>  </a></h5>
                            <div class="progress mt-4 row">
                                <div class="progress-bar progress-bar-warning" aria-valuenow="{{ $progress['sale'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress['sale'] }}%" role="progressbar"></div>
                            </div>
                        </div>
                        <div class="col-md-6 pr-4">
                            <h5 class="m-b-5 text-center ">انبار مرکزی<span class="pull-left">{{ $progress['storehouse'] }}%</span>  <a class="float-left btn btn-outline btn-primary " href="{{ route('panel.suppliers.sale.edit',['step' => 'storehouse']) }}"><span class="btn-label p-0 m-0"><i class="fa fa-edit"></i></span> </a></h5>
                            <div class="progress mt-4 row">
                                <div class="progress-bar progress-bar-inverse" aria-valuenow="{{ $progress['storehouse'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress['storehouse'] }}%" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">آخرین محصولات ویرایش شده ی من</div>
            <div class="panel-body p-0 m-0 row">
                <table class="table color-bordered-table inverse-bordered-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>کد محصول</th>
                            <th>نام محصول</th>
                            <th>تولید کننده</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $key => $product)
                            <tr id="delete-{{ $product->productid }}">
                                <td>{{$key+1}}</td>
                                <td>{{$product->productcode}}</td>
                                <td>{{$product->product}}</td>
                                <td>{{$product->manufactory->manufacturer}}</td>
                                <td>
                                    <a class="btn btn-outline btn-primary" href="{{ route('list.price.supplier', ['slugProduct'=>$product->slug]) }}">قیمت گذاری</a>
                                    <a class="btn btn-outline btn-danger" title="ویرایش" data-title="ویرایش" href="{{ route('edit.product.supplier', ['slug'=>$product->slug]) }}"><i class="fa fa-edit"></i></a>
                                    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-danger text-center">
                                        هیچ محصولی در لیست شما وجود ندارد
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                    <tfoot>
                            
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="white-box">
            <h1 class="box-title">پرفروشترین سایز کاشی</h1>
            <div>
                <canvas id="chartMore" height="150"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="white-box">
            <h1 class="box-title">پرفروشترین کاشی ها ( کاربری )</h1>
            <div>
                <canvas id="chartMore2" height="150"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    
	<!-- Chart JS -->
	{{-- <script src="{{ asset('panel/assets/js/chartjs.init.js') }}"></script> --}}
    <script src="{{ asset('panel/assets/plugins/Chart.js/Chart.min.js') }}"></script>
    <script>
        var ctx = document.getElementById("chartMore").getContext("2d");
        var data = {
            
            labels: [
                <?php 
                    foreach ($maxes as $item){
                        echo "'";
                        foreach ($item->product->extrafieldvalues as $item2){
                            if($item2->fieldid == 1)
                            echo $item2->value;
                        }
                        
                        echo "',";
                    }
                ?>
            ],
            datasets: [
                /*{
                    label: "My First dataset",
                    fillColor: "rgba(252,201,186,0.8)",
                    strokeColor: "rgba(252,201,186,0.8)",
                    highlightFill: "rgba(252,201,186,1)",
                    highlightStroke: "rgba(252,201,186,1)",
                    data: [10, 30, 80, 61, 26, 75, 40]
                },*/
                {
                    label: "بیشترین فروش",
                    fillColor: "rgba(180,193,215,0.8)",
                    strokeColor: "rgba(180,193,215,0.8)",
                    highlightFill: "rgba(180,193,215,1)",
                    highlightStroke: "rgba(180,193,215,1)",
                    data: [
                        <?php
                        foreach ($maxes as $key => $item){
                            if($key != 0) { echo ','; }
                            echo $item->occurrences;
                        }
                        ?>
                    ]
                }
            ]
        };

        var chart = new Chart(ctx).Bar(data, {
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.005)",
            scaleGridLineWidth : 0,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke : true,
            barStrokeWidth : 0,
            tooltipCornerRadius: 2,
            barDatasetSpacing : 3,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });

        var ctx2 = document.getElementById("chartMore2").getContext("2d");
        var data2 = {
            
            labels: [
                <?php 
                    foreach ($maxes as $item){
                        echo "'";
                        foreach ($item->product->extrafieldvalues as $item2){
                            if($item2->fieldid == 6)
                            echo $item2->value;
                        }
                        
                        echo "',";
                    }
                ?>
            ],
            datasets: [
                /*{
                    label: "My First dataset",
                    fillColor: "rgba(252,201,186,0.8)",
                    strokeColor: "rgba(252,201,186,0.8)",
                    highlightFill: "rgba(252,201,186,1)",
                    highlightStroke: "rgba(252,201,186,1)",
                    data: [10, 30, 80, 61, 26, 75, 40]
                },*/
                {
                    label: "فروش کاربری",
                    fillColor: "rgba(252,201,186,0.8)",
                    strokeColor: "rgba(252,201,186,0.8)",
                    highlightFill: "rgba(252,201,186,1)",
                    highlightStroke: "rgba(252,201,186,1)",
                    data: [
                        <?php
                        foreach ($maxes as $key => $item){
                            if($key != 0) { echo ','; }
                            echo $item->occurrences;
                        }
                        ?>
                    ]
                }
            ]
        };

        var chart2 = new Chart(ctx2).Bar(data2, {
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.005)",
            scaleGridLineWidth : 0,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke : true,
            barStrokeWidth : 0,
            tooltipCornerRadius: 2,
            barDatasetSpacing : 3,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });
    </script>
@endsection
