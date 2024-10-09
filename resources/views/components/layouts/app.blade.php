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
        <style>
            .error-message{
                width: 100%;
                margin-top: 0.25rem;
                font-size: 0.875em;
                color: var(--bs-form-invalid-color);
            }
        </style>
        @livewireStyles
        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    

	</head>

	<body class="app ltr sidebar-mini light-mode">

        <!-- GLOBAL-LOADER -->
		{{-- <div id="global-loader">
            <img src="{{asset('build/assets/images/svgs/loader.svg')}}" class="loader-img" alt="Loader">
		</div> --}}
		<!-- GLOBAL-LOADER -->

		<!-- PAGE -->
		<div class="page">

            <div class="page-main">

                <!-- App-Header -->
                @include('layouts.components.app-header')
                <!-- End App-Header -->

                <!--App-Sidebar-->
                @include('layouts.components.app-sidebar')
                <!-- End App-Sidebar-->

                <!--app-content open-->
				<div class="app-content main-content">
                    <div class="side-app">
                        <div class="main-container">

                            {{ $slot }}

                        </div>
                    </div>
                    <!-- Container closed -->
                </div>
                <!-- main-content closed -->

            </div>

            <!-- Sidebar-right -->
            {{-- @include('layouts.components.sidebar-right') --}}
            <!-- End Sidebar-right -->

            <!-- Country-selector modal -->
            {{-- @include('layouts.components.modal') --}}
            <!-- End Country-selector modal -->

            <!-- Footer opened -->
			@include('layouts.components.footer')
            <!-- End Footer -->

            @yield('modals')

		</div>
        <!-- END PAGE-->

        <!-- SCRIPTS -->
        @include('layouts.components.scripts')

        <!-- APP JS-->
		@vite('resources/js/app.js')
        <!-- END SCRIPTS -->

        @livewireScripts
        @livewire('wire-elements-modal')
	</body>
</html>
