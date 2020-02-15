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
                <div class="col-lg-6 col-md-6 col-sm-6 pr-4">
                    <h3 class="box-title">اطلاعات کاربری</h3>
                    <h5 class="m-b-5 text-center ">اطلاعات پایه<span class="pull-left">{{ $progress['user'] }}%</span>  <a class="float-left btn btn-outline btn-primary " href="{{ route('edit.user', ['step'=>'bio']) }}"><span class="btn-label p-0 m-0"><i class="fa fa-edit"></i></span> </a></h5>
                    <div class="progress mt-4 row">
                        <div class="progress-bar progress-bar-info" aria-valuenow="{{ $progress['user'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress['user'] }}%" role="progressbar"></div>
                    </div>
                    <h5 class="m-b-5 text-center ">کارت بانکی<span class="pull-left">{{ $progress['card_user'] }}%</span>  <a class="float-left btn btn-outline btn-primary " href="{{ route('edit.user', ['step'=>'card']) }}"><span class="btn-label p-0 m-0"><i class="fa fa-edit"></i></span> </a></h5>
                    <div class="progress mt-4 row">
                        <div class="progress-bar progress-bar-success" aria-valuenow="{{ $progress['card_user'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress['card_user'] }}%" role="progressbar"></div>
                    </div>
                    <h5 class="m-b-5 text-center ">تخصص ها<span class="pull-left">{{ $progress['spasial_user'] }}%</span> <a class="float-left btn btn-outline btn-primary " href="{{ route('edit.user', ['step'=>'spesiality']) }}"><span class="btn-label p-0 m-0"><i class="fa fa-edit"></i></span> </a></h5>
                    <div class="progress mt-4 row">
                        <div class="progress-bar progress-bar-danger" aria-valuenow="{{ $progress['spasial_user'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress['spasial_user'] }}%" role="progressbar"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 pl-4">
                    <h3 class="box-title">اطلاعات فروشگاه شما </h3>
                    <h5 class="m-b-5 text-center ">اطلاعات پایه<span class="pull-left">{{ $progress['merchant_user'] }}%</span>  <a class="float-left btn btn-outline btn-primary " href="{{ route('edit.merchant') }}"><span class="btn-label p-0 m-0"><i class="fa fa-edit"></i></span>  </a></h5>
                    <div class="progress mt-4 row">
                        <div class="progress-bar progress-bar-warning" aria-valuenow="{{ $progress['merchant_user'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress['merchant_user'] }}%" role="progressbar"></div>
                    </div>
                    <h5 class="m-b-5 text-center ">ارتباط با کارخانه ها<span class="pull-left">{{ $progress['merchant_manufactory_user'] }}%</span>  <a class="float-left btn btn-outline btn-primary " href="{{ route('connect.suppliers') }}"><span class="btn-label p-0 m-0"><i class="fa fa-edit"></i></span> </a></h5>
                    <div class="progress mt-4 row">
                        <div class="progress-bar progress-bar-inverse" aria-valuenow="{{ $progress['merchant_manufactory_user'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress['merchant_manufactory_user'] }}%" role="progressbar"></div>
                    </div>
                </div>
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
