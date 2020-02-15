<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}} @yield('title')</title>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('panel/assets/images/favicon.png') }}">

	<link href="{{ asset('panel/assets/plugins/jqueryui/jquery-ui.min.css') }}" rel="stylesheet">
	<!-- Bootstrap Core CSS -->
	<link href="{{ asset('panel/assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('panel/assets/plugins/bootstrap-extension/css/bootstrap-extension.css') }}" rel="stylesheet">
	<link href="{{ asset('panel/assets/plugins/lobipanel/dist/css/lobipanel.min.css') }}" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="{{ asset('panel/assets/plugins/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
	<!-- Animation CSS -->
	<link href="{{ asset('panel/assets/plugins/animate/animate.css') }}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ asset('panel/assets/css/style.css') }}" rel="stylesheet">
	<!-- color CSS -->
	<link href="{{ asset('panel/assets/css/colors/default.css') }}" id="theme" rel="stylesheet">
	<!-- Icons -->
	<link href="{{ asset('panel/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('panel/assets/plugins/linea-icons/css/linea-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('panel/assets/plugins/material-design-iconic-font/css/material-design-iconic-font.css') }}" rel="stylesheet">
	<link href="{{ asset('panel/assets/plugins/weather-icons/css/weather-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('panel/assets/plugins/themify-icons/css/themify-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('panel/assets/plugins/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
	<style>
		li.disabled *{
			color: #ccc !important;
			cursor: not-allowed;
		}
	</style>
    @yield('css')
</head>
<body class="fix-header fix-sidebar">
		<!-- Preloader -->
		<!-- <div class="preloader">
			<svg class="circular" viewbox="25 25 50 50">
				<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
			</svg>
		</div> -->
		<div id="wrapper">
			@include('admin.components.navigation')
			@if (auth()->user()->role == 2)
				@include('admin.components.sidebar-merchants')
			@elseif (auth()->user()->role == 3)
				@include('admin.components.sidebar-suppliers')
				
			@elseif (auth()->user()->role == 1)
				@include('admin.components.sidebar-admin')
			@endif
			<div id="page-wrapper">
				<div class="container-fluid">
					@include('admin.components.breadcrumb')

					@yield('content')

					@include('admin.components.setting')
				</div>
				@include('admin.components.footer')
			</div>
			<!-- /#page-wrapper -->
		</div>
		<!-- /#wrapper -->
		
		<!-- jQuery -->
		<script src="{{ asset('panel/assets/plugins/jquery/dist/jquery.min.js') }}"></script>
		<script src="{{ asset('panel/assets/plugins/jqueryui/jquery-ui.min.js') }}"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="{{ asset('panel/assets/plugins/bootstrap/dist/js/tether.min.js') }}"></script>
		<script src="{{ asset('panel/assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('panel/assets/plugins/bootstrap-extension/js/bootstrap-extension.min.js') }}"></script>
		<!-- Sidebar menu plugin JavaScript -->
		<script src="{{ asset('panel/assets/plugins/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
		<!-- Draggable-panel -->
		<script src="{{ asset('panel/assets/plugins/lobipanel/dist/js/lobipanel.min.js') }}"></script>
		<script>
			$(function() {
				$('.panel').lobiPanel({
					sortable: true,
					reload: false,
					editTitle: false,
					unpin: {
						tooltip : 'شناور'
					},
					minimize: {
						tooltip : 'کوچک‌نمایی'
					},
					expand: {
						tooltip : 'تمام صفحه'
					},
					close: {
						tooltip : 'بستن'
					}
				});
			});
		</script>
		<!--Slimscroll JavaScript For custom scroll-->
		<script src="{{ asset('panel/assets/plugins/jquery.slimscroll/jquery.slimscroll.min.js') }}"></script>
		<!-- Wave Effects -->
		<script src="{{ asset('panel/assets/plugins/waves/waves.min.js') }}"></script>
		<!-- Custom Theme JavaScript -->
		<script src="{{ asset('panel/assets/js/custom.js') }}"></script>
		<!--Style Switcher -->
		<script src="{{ asset('panel/assets/js/style-switcher.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7"></script>
		<script>
			@if(session('noty'))
				Swal.fire({
					type: "{!! session('noty')['status'] !!}",
					title: "{!! session('noty')['title'] !!}",
					text: "{!! session('noty')['message'] !!}",
				})
				<?php session()->forget('noty') ?>
			@endif
		</script>
		<script src="{{ asset('public/js/script.js') }}"></script>

		
	<script src="{{ asset('panel/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>
		@yield('js')
	</body>
</html>
