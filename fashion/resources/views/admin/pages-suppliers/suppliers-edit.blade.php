@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') 
<link rel="stylesheet" href="{{ asset('panel/assets/plugins/dropify/dist/css/dropify.min.css') }}">
<link href="{{ asset('panel/assets/plugins/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content') 
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body pt-5">
                <form class="floating-labels mt-5 ajaxUpload" action="{{ route('panel.suppliers.edit.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                                <label for="image" class="mt-0">لوگو</label>
                            <div class="form-group">
                                <div class="mt-5">
                                    @if ($manufactorer)
                                        <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload" data-default-file="https://cerampakhsh.com/{{str_replace('/var/www/vhosts/cerampakhsh.com/httpdocs/','',$manufactorer->image)}}">
                                    @else
                                        <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload">
                                    @endif 
                                    <small>
                                            <div class="form-control-feedback text-danger error-imageUrl"></div>
                                    </small>
                                </div>
                                    
                                
                            </div>
                        </div>
                            <div class="form-group col-md-6 mb-5 float-right">
                                <input type="text" class="form-control" id="manufacturer" required name="manufacturer"  value="{{ ($manufactorer) ? $manufactorer->manufacturer : '' }}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="manufacturer">نام کاخانه</label>
                                <span class="help-block text-danger small error-manufacturer"></span>
                            </div>
                            
                            <div class="form-group col-md-6 mb-5 float-right">
                                <input type="text" class="form-control" id="manager" required name="manager"  value="{{ ($manufactorer) ? $manufactorer->manager : '' }}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="manager">نام مدیر کارخانه</label>
                                <span class="help-block text-danger small error-manager"></span>
                            </div>
                            
                            <div class="form-group col-md-6 mb-5">
                                @include('admin.components.states',['s_state_default' => ($manufactorer) ? $manufactorer->state : ''])
                                <label for="state">استان</label>
                                <span class="help-block text-danger small error-s_state"></span>
                            </div>
                            <div class="form-group col-md-6 mb-5">
                                <select  class="form-control " id="city" name="s_city">
                                    @if ($manufactorer)
                                        
                                    <option value="{{ ($manufactorer) ? $manufactorer->city : '' }}">{{ ($manufactorer) ? $manufactorer->city : '' }}</option>
                                    @endif
                                </select>
                                <label for="city">شهر</label>
                                <span class="help-block text-danger small error-s_city"></span>
                            </div>


                            
                            <div class="form-group col-md-12 mb-5 float-right">
                                <textarea class="form-control" rows="4" id="address" required name="address"  value="">{{ ($manufactorer) ? $manufactorer->address : '' }}</textarea><span class="highlight"></span> <span class="bar"></span>
                                <label for="address">آدرس</label>
                                <span class="help-block text-danger small error-address"></span>
                            </div>
                            
                            <div class="form-group col-md-12 mb-5 float-right">
                                <input type="text" class="form-control" id="relation_phone" name="relation_phone"  value="{{ ($manufactorer) ? $manufactorer->relation_phone : '' }}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="relation_phone">تلفن روابط عمومی</label>
                                <span class="help-block text-danger small error-relation_phone"></span>
                            </div>
                            <div class="form-group col-md-12 mb-5 float-right">
                                <input type="text" class="form-control" id="website_address" name="website_address"  value="{{ ($manufactorer) ? $manufactorer->website_address : '' }}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="website_address">آدرس وبسایت</label>
                                <span class="help-block text-danger small error-website_address"></span>
                            </div>
                            <div class="form-group col-md-12 mb-5 float-right">
                                <input type="text" class="form-control" id="insta_address" name="insta_address"  value="{{ ($manufactorer) ? $manufactorer->insta_address : '' }}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="insta_address">آدرس اینستاگرام</label>
                                <span class="help-block text-danger small error-insta_address"></span>
                            </div>
                            <div class="form-group col-md-12 mb-5 float-right">
                                <input type="text" class="form-control" id="telegram_address" name="telegram_address"  value="{{ ($manufactorer) ? $manufactorer->telegram_address : '' }}"><span class="highlight"></span> <span class="bar"></span>
                                <label for="telegram_address">آدرس تلگرام</label>
                                <span class="help-block text-danger small error-telegram_address"></span>
                            </div>

                        <div class="col-md-12 mt-5 mb-5">
                            
                                <div class="form-group col-md-6 mb-5 float-right">
                                    <input id="latitude" class="controls form-control mt-3" name="latitude" type="text" value="{{ ($manufactorer) ? $manufactorer->latitute : '' }}" placeholder="انتخاب از روی نقشه">
                                    <label for="time_work">عرض جغرافیایی</label>
                                    <span class="help-block text-danger small error-latitude"></span>
                                </div>
                                    
                                <div class="form-group col-md-6 mb-5 float-right">
                                    <input id="longitude" class="controls form-control mt-3" name="longitude" type="text" value="{{ ($manufactorer) ? $manufactorer->longitute : '' }}" placeholder="انتخاب از روی نقشه">
                                    <label for="time_work">طول جغرافیایی</label>
                                    <span class="help-block text-danger small error-longitude"></span>
                                </div>
                                
                                <small>
                                        <div class="form-control-feedback text-danger error-location"></div>
                                    </small>
                                <div id="map" style="width: 100%;height: 500px;padding: 25px;"></div>
                        </div>
    
                        <div class="row mt-5">
                            <button type="submit" class="btn btn-success waves-effect waves-light btn-lg m-l-10">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js') 

<script src="{{ asset('panel/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>

{{-- <script src="{{ asset('admin-theme/assets/plugins/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin-theme/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script> --}}
	<script>
		$(document).ready(function() {
			// Basic
			$('.dropify').dropify({
				messages: {
					default: 'لوگو را اینجا بکشید و یا کلیک کنید(حجم فایل کمتر از 300 کیلوبایت  )',
					replace: 'برای جایگزینی ، لوگو را اینجا بکشید و یا کلیک کنید(حجم فایل کمتر از 300 کیلوبایت  )',
					remove: 'حذف',
					error: 'خطا در ارسال فایل'
				}
			});

			// Used events
			var drEvent = $('#input-file-events').dropify();

			drEvent.on('dropify.beforeClear', function(event, element) {
				return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
			});

			drEvent.on('dropify.afterClear', function(event, element) {
				alert('File deleted');
			});

			drEvent.on('dropify.errors', function(event, element) {
				console.log('Has Errors');
			});

			var drDestroy = $('#input-file-to-destroy').dropify();
			drDestroy = drDestroy.data('dropify')
			$('#toggleDropify').on('click', function(e) {
				e.preventDefault();
				if (drDestroy.isDropified()) {
					drDestroy.destroy();
				} else {
					drDestroy.init();
				}
			})
		});
    </script>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
<script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
<script>

    var lat            = {{ ($manufactorer) ? (($manufactorer->latitute) ? $manufactorer->latitute : '25.27' ) : '25.27' }};
    var lon            = {{ ($manufactorer) ? (($manufactorer->longitute) ? $manufactorer->longitute : '60.61' ) : '60.61' }};

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

