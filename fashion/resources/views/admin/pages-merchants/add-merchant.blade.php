@extends('admin.layouts.master') 
@section('title') @endsection
@section('css') 
<link rel="stylesheet" href="{{ asset('panel/assets/plugins/dropify/dist/css/dropify.min.css') }}">
<link href="{{ asset('panel/assets/plugins/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css">


<link href="{{ asset('panel/assets/plugins/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('panel/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css">
<style>
        .ms-container{
            width: 100%;
        }
</style>
@endsection
@section('content') 

<div class="row">
    
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading">{{ $title }}
            </div>
            <div class="panel-body pt-5">
                
                    
                <form class="floating-labels mt-5 ajaxUpload" action="{{ route('add.merchant.post.type') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($type == 'transporter')
                        <input type="hidden" name="type_merchant" value="{{$type}}">
                    @elseif ($type == 'installer')
                        <input type="hidden" name="type_merchant" value="{{$type}}">
                    @else
                        <input type="hidden" name="type_merchant" value="merchant">
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-6 mb-5 float-left">
                                <input type="text" class="form-control" id="title" required name="title"  value=""><span class="highlight"></span> <span class="bar"></span>
                                
                                @if ($type == 'transporter' || $type == 'installer')
                                    <label for="title">نام </label>
                                @else
                                    <label for="title">نام فروشگاه</label>
                                @endif
                                <span class="help-block text-danger small error-title"></span>
                            </div>
                            
                            <div class="form-group col-md-6 mb-5 float-left">
                                <input type="text" class="form-control" id="name_manage_store" required name="name_manage_store"  value=""><span class="highlight"></span> <span class="bar"></span>
                                
                                @if ($type == 'transporter' || $type == 'installer')
                                <label for="name_manage_store">نام خانوادگی</label>
                                @else
                                <label for="name_manage_store">نام مدیر فروشگاه</label>
                                @endif
                                <span class="help-block text-danger small error-name_manage_store"></span>
                            </div>
                            <div class="form-group col-md-6 mb-5 float-right">
                                <input type="text" class="form-control" id="phone" required name="phone"  value=""><span class="highlight"></span> <span class="bar"></span>
                                <label for="phone">موبایل</label>
                                <span class="help-block text-danger small error-phone"></span>
                            </div>
                            
                            <div class="form-group col-md-6 mb-5 float-right">
                                <input type="text" class="form-control" id="phone_number" required name="phone_number"  value=""><span class="highlight"></span> <span class="bar"></span>
                                <label for="phone_number">تلفن محل کسب</label>
                                <span class="help-block text-danger small error-phone_number"></span>
                            </div>
                            
                            <div class="form-group col-md-6 mb-5 float-right">
                                <input type="text" class="form-control" id="city" required name="city"  value=""><span class="highlight"></span> <span class="bar"></span>
                                <label for="city">شهر</label>
                                <span class="help-block text-danger small error-city"></span>
                            </div>
                            <div class="form-group col-md-6 mb-5 float-right">
                                <input type="text" class="form-control" id="time_work" required name="time_work"  value=""><span class="highlight"></span> <span class="bar"></span>
                                <label for="time_work">ساعت کاری</label>
                                <span class="help-block text-danger small error-time_work"></span>
                            </div>
                            


                            
                            <div class="form-group col-md-12 mb-5 float-right">
                                <textarea class="form-control" rows="4" id="address" required name="address"  value=""></textarea><span class="highlight"></span> <span class="bar"></span>
                                <label for="address">آدرس</label>
                                <span class="help-block text-danger small error-address"></span>
                            </div>
                            
                            <div class="form-group col-md-12 mb-5 float-right ">
                                <input type="text" class="form-control" id="store_address" name="store_address"  value=""><span class="highlight"></span> <span class="bar"></span>
                                <label for="store_address">آدرس انبار</label>
                                <span class="help-block text-danger small error-store_address"></span>
                            </div>
                            <div class="form-group col-md-12 mb-5 float-right">
                                <input type="text" class="form-control" id="website_address" name="website_address"  value=""><span class="highlight"></span> <span class="bar"></span>
                                <label for="website_address">آدرس وبسایت</label>
                                <span class="help-block text-danger small error-website_address"></span>
                            </div>
                            <div class="form-group col-md-12 mb-5 float-right">
                                <input type="text" class="form-control" id="insta_address" name="insta_address"  value=""><span class="highlight"></span> <span class="bar"></span>
                                <label for="insta_address">آدرس اینستاگرام</label>
                                <span class="help-block text-danger small error-insta_address"></span>
                            </div>
                            <div class="form-group col-md-12 mb-5 float-right">
                                <input type="text" class="form-control" id="telegram_address" name="telegram_address"  value=""><span class="highlight"></span> <span class="bar"></span>
                                <label for="telegram_address">آدرس تلگرام</label>
                                <span class="help-block text-danger small error-telegram_address"></span>
                            </div>
                            <div class="form-group col-md-12 m-b-5 mt-5 float-right">
                                <textarea class="form-control" rows="4" id="details" required name="details"  value=""></textarea><span class="highlight"></span> <span class="bar"></span>
                                <label for="details">توضیحات در مورد فروشگاه / نصاب / شرکت حمل</label>
                                <span class="help-block text-danger small error-details"></span>
                            </div>

                            
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                
                                <div class="col-12 mb-5">
                                    <label>لطفا نمایندگی های رسمی و مجاز را انتخاب نمایید.</label>
                                </div>
                                <div class="form-group col-md-12" style="overflow: hidden;">
                                    <select multiple id="suppliers-select" name="suppliers[]">
                                        @foreach ($suppliers as $supp)
                                            <option value="{{ $supp->manufacturerid }}" >{{ $supp->manufacturer }}</option>
                                        @endforeach
                                    </select>
                                </div>
            
                                <div class="button-box m-t-20"> 
                                    <a id="select-all" class="btn btn-danger btn-outline" href="#">انتخاب همه</a> 
                                    <a id="deselect-all" class="btn btn-info btn-outline" href="#">عدم انتخاب همه</a> 
                                </div>
                            </div>
                            
                            <div class="form-group pt-5">
                                <label for="imageUrl" class="mb-3">لوگو</label>
                                    <input type="file" id="imageUrl" name="imageUrl" class="dropify file-upload">
                                <small>
                                        <div class="form-control-feedback text-danger error-imageUrl"></div>
                                </small>
                                
                            </div>
                            <div class="form-group pt-5">
                                <label for="imageUrl2" class="mb-3">کاور ( عکسی از فروشگاه )</label>
                                
                                    <input type="file" id="imageUrl2" name="imageUrl2" class="dropify file-upload">
                                <small>
                                        <div class="form-control-feedback text-danger error-imageUrl2"></div>
                                </small>                                                                      
                                    
                                                                                                            
                            </div>
                            
                            <div class="form-group pt-5">
                                {{-- <label for="imageUrl3" class="mb-3">اضافه کردن تعرفه</label> --}}
                                <p class="text-info">
                                    شرکت حمل/شرکت نصب محترم
                                    <br>
                                    با توجه به استفاده نرم افزار از تعرفه حمل/ نصب اتحادیه و مطابق با قیمت رابتی و مطلوب مصرف کننده بازار،
                                    خواهشمند است قیمت های خدمات حمل و نصب خود را در سربر
                                     شرکت با مهر و امضا در محل مشخص شده پایین انتقال نمایید.
                                     خاطر نشان می نماید مبالغ پیشنهادی شما صرفا جهت بررسی می باشد و نرم افزار بر اساس نرخ نامه اتحادیه فعالیت میکند
                                     <br>
                                     <span for="" class="float-right">با تشکر سرام پخش</span>
                                     
                                </p>
                                
                                    <input type="file" id="imageUrl3" name="imageUrl3" class="dropify file-upload">
                                <small>
                                        <div class="form-control-feedback text-danger error-imageUrl3"></div>
                                </small>                                                                      
                                    
                                                                                                            
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 mt-5 mb-5">
                            
                                <div class="form-group col-md-6 mb-5 float-right">
                                    <input id="latitude" class="controls form-control mt-3" name="latitude" type="text" value="" placeholder="انتخاب از روی نقشه">
                                    <label for="time_work">عرض جغرافیایی</label>
                                    <span class="help-block text-danger small error-latitude"></span>
                                </div>
                                    
                                <div class="form-group col-md-6 mb-5 float-right">
                                    <input id="longitude" class="controls form-control mt-3" name="longitude" type="text" value="" placeholder="انتخاب از روی نقشه">
                                    <label for="time_work">طول جغرافیایی</label>
                                    <span class="help-block text-danger small error-longitude"></span>
                                </div>
                                
                                <small>
                                        <div class="form-control-feedback text-danger error-location"></div>
                                    </small>
                                <div id="map" style="width: 100%;height: 500px;padding: 25px;"></div>
                        </div>
    
                        <div class="row mt-5">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
    


@endsection
@section('js') 
<script src="{{ asset('panel/assets/plugins/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('panel/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        // For select 2

        $(".select2").select2();
        
        $('#suppliers-select').multiSelect();
        $('#select-all').click(function() {
            $('#suppliers-select').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#suppliers-select').multiSelect('deselect_all');
            return false;
        });

    });
</script>

<script src="{{ asset('panel/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>

{{-- <script src="{{ asset('admin-theme/assets/plugins/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin-theme/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script> --}}
	<script>
		$(document).ready(function() {
			// Basic
			$('.dropify').dropify({
				messages: {
					default: 'یک فایل اینجا بکشید و یا کلیک کنید(حجم فایل کمتر از 300 کیلوبایت  )',
					replace: 'برای جایگزینی ، یک فایل اینجا بکشید و یا کلیک کنید(حجم فایل کمتر از 300 کیلوبایت  )',
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

    var lat            = 25.27;
    var lon            = 60.61;

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

