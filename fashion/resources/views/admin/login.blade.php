
<!DOCTYPE html>
<html lang="fa">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('panel/assets/images/favicon.png') }}">
	<title>پنل مدیریتی سرام پخش</title>
	<!-- Bootstrap Core CSS -->
	<link href="{{ asset('panel/assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('panel/assets/plugins/bootstrap-extension/css/bootstrap-extension.css') }}" rel="stylesheet">
	<!-- animation CSS -->
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
		.login-box,.white-box {
			background: #cdedfa;
			box-shadow: none;
		}
	</style>
</head>

<body>
	<!-- Preloader -->
	<div class="preloader">
		<svg class="circular" viewbox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
		</svg>
	</div>
	<section id="wrapper" class="login-register">
		<div class="login-box login-sidebar">
			<div class="white-box">
				<form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('login.admin') }}">
						@csrf
					<input type="hidden" name="code_country" value="0098">
					<a href="javascript:void(0)" class="text-center db">
                        <br>
						<h2><strong>سرام پخش</strong></h2>
						@if(session('noty'))
						{{(session('noty')['message'])}}
						@endif
					</a>
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="form-group m-t-40">
						<div class="col-12">
                            <input class="form-control @error('username') is-invalid @enderror" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" type="text" name="username" value="{{ old('username') }}" required="" placeholder="نام کاربری">
                             

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
					</div>
					<div class="form-group">
						<div class="col-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="رمز عبور" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<div class="checkbox checkbox-primary pull-right p-t-0">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
								<label for="remember"> به خاطر سپاری </label>
							</div>
                        </div>
					</div>
					<div class="form-group text-center m-t-20">
						<div class="col-12">
							<button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">ورود</button>
						</div>
					</div>
					<div class="form-group m-b-0">
						<div class="col-sm-12 text-center">
							<p>حسابی ندارید؟ 
								<a target="_blank" class="text-success" href="https://cerampakhsh.com/landing" class="m-r-5"><b>ثبت نام فروشنده</b></a>
								<a target="_blank" class="text-primary" href="https://cerampakhsh.com/page/%D8%AB%D8%A8%D8%AA-%D9%86%D8%A7%D9%85-%D8%AA%D8%A7%D9%85%DB%8C%D9%86-%DA%A9%D9%86%D9%86%D8%AF%DA%AF%D8%A7%D9%86/18" class="m-r-5"><b>ثبت نام تولید کننده</b></a>
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
	<!-- jQuery -->
	<script src="{{ asset('panel/assets/plugins/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="{{ asset('panel/assets/plugins/bootstrap/dist/js/tether.min.js') }}"></script>
	<script src="{{ asset('panel/assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('panel/assets/plugins/bootstrap-extension/js/bootstrap-extension.min.js') }}"></script>
	<!-- Menu Plugin JavaScript -->
	<script src="{{ asset('panel/assets/plugins/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
	<!--slimscroll JavaScript -->
	<script src="{{ asset('panel/assets/plugins/jquery.slimscroll/jquery.slimscroll.min.js') }}"></script>
	<!--Wave Effects -->
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
</body>

</html>