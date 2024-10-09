<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- TITLE -->
		<title>SCM LOGISTICS</title>

		<!-- Favicon -->
		<link rel="icon" href="{{asset('build/assets/images/brand/favicon.ico')}}" type="image/x-icon">

        <!-- BOOTSTRAP CSS -->
	    <link id="style" href="{{asset('build/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" >

        <!-- APP CSS & APP SCSS -->
        @vite(['resources/css/app.css' , 'resources/sass/app.scss'])

        @yield('styles')

	</head>

	<body class="login-img">

		<!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{asset('build/assets/images/svgs/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- GLOBAL-LOADER -->

		<!-- PAGE -->
		<div class="page bg-img">

        	{{$slot}}

		</div>

		<!-- JQUERY JS -->
		<script src="{{asset('build/assets/plugins/jquery/jquery.min.js')}}"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{asset('build/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
		<script src="{{asset('build/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

		@yield('scripts')

        <!-- APP JS-->
		@vite('resources/js/app.js')
        <!-- END SCRIPTS -->

	</body>
</html>
