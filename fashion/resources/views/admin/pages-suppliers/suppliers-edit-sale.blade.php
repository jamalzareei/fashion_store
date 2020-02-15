@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') @endsection
@section('content') 
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5">
                    <form class="floating-labels mt-5 ajaxForm" style="height: 970px;" action="{{ route('panel.suppliers.edit.steps.post', ['step'=> $routeSubmit]) }}" method="POST">
                        @csrf

                        <div class="form-group col-md-12 mb-5 float-right">
                            <input type="text" class="form-control" id="manager" required name="manager"  value="{{ ($data) ? $data->manager : '' }}"><span class="highlight"></span> <span class="bar"></span>
                            <label for="manager">نام مدیر {{$name}}</label>
                            <span class="help-block text-danger small error-manager"></span>
                        </div>
                        <div class="form-group col-md-12 mb-5 float-right">
                            <input type="text" class="form-control" id="phones" required name="phones"  value="{{ ($data) ? $data->phones : '' }}"><span class="highlight"></span> <span class="bar"></span>
                            <label for="phones">تلفن دفتر {{$name}}</label>
                            <span class="help-block text-danger small error-phones"></span>
                        </div>
                        
                        <div class="form-group col-md-12 mb-5 float-right">
                            <input type="text" class="form-control" id="fax" required name="fax"  value="{{ ($data) ? $data->fax : '' }}"><span class="highlight"></span> <span class="bar"></span>
                            <label for="fax">شماره فکس {{$name}}</label>
                            <span class="help-block text-danger small error-fax"></span>
                        </div>
                        

                        
                        <div class="form-group col-md-12 mb-5 float-right">
                            <textarea class="form-control" rows="4" id="address" required name="address"  value="">{{ ($data) ? $data->address : '' }}</textarea><span class="highlight"></span> <span class="bar"></span>
                            <label for="address">آدرس</label>
                            <span class="help-block text-danger small error-address"></span>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-5 mb-5">
                                
                                    <div class="form-group col-md-6 mb-5 float-right">
                                        <input id="latitude" class="controls form-control mt-3" name="latitude" type="text" value="{{ ($data) ? $data->latitute : '' }}" placeholder="انتخاب از روی نقشه">
                                        <label for="time_work">عرض جغرافیایی</label>
                                        <span class="help-block text-danger small error-latitude"></span>
                                    </div>
                                        
                                    <div class="form-group col-md-6 mb-5 float-right">
                                        <input id="longitude" class="controls form-control mt-3" name="longitude" type="text" value="{{ ($data) ? $data->longitute : '' }}" placeholder="انتخاب از روی نقشه">
                                        <label for="time_work">طول جغرافیایی</label>
                                        <span class="help-block text-danger small error-longitude"></span>
                                    </div>
                                    
                                    <small>
                                        <div class="form-control-feedback text-danger error-location"></div>
                                    </small>
                                    <div id="map" style="width: 100%;height: 500px;padding: 25px;"></div>
                            </div>
                        </div>
    
                        <div class="row mt-5" style="position: absolute;bottom: 10px">
                            <button type="submit" class="btn btn-success waves-effect waves-light btn-lg m-l-10">ثبت</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js') 
<link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
<script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
<script>

    var lat            = {{ ($data) ? (($data->latitute) ? $data->latitute : '25.27' ) : '25.27' }};
    var lon            = {{ ($data) ? (($data->longitute) ? $data->longitute : '60.61' ) : '60.61' }};

    var markerStyle = new ol.style.Style({
        image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
            anchor: [0.5, 46],
            anchorXUnits: 'fraction',
            anchorYUnits: 'pixels',
            opacity: 0.75,
            src: 'https://openlayers.org/en/latest/examples/data/icon.png'
        }))
    });


    var map = new ol.Map({
        target: 'map',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([lon,lat]), // Coordinates of New York
            zoom: 7 //Initial Zoom Level
        })
    });

    var marker = new ol.Feature({
        geometry: new ol.geom.Point(
            ol.proj.fromLonLat([lon,lat])
        ),  // Cordinates of New York's Town Hall
    });
    var vectorSource = new ol.source.Vector({
        features: [marker]
    });

    var markerVectorLayer = new ol.layer.Vector({
        source: vectorSource,
        style: markerStyle
    });
    map.addLayer(markerVectorLayer);
    //////////////////////////////////////

    map.on('click', function(evt){
        var coords = ol.proj.toLonLat(evt.coordinate);
        var lat = coords[1];
        var lon = coords[0];
        //alert("Lat, Lon : " + lat + ", " + lon)
        map.removeLayer(markerVectorLayer);
        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lon;
        marker = new ol.Feature({
            geometry: new ol.geom.Point(
                ol.proj.fromLonLat([lon,lat])
            ),  // Cordinates of New York's Town Hall
        });
        vectorSource = new ol.source.Vector({
            features: [marker]
        });

        markerVectorLayer = new ol.layer.Vector({
            source: vectorSource,
            style: markerStyle
        });
        map.addLayer(markerVectorLayer);
        $('.formMap').submit();
    });
</script>
@endsection

