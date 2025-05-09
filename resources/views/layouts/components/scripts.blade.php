
        <!-- BACK-TO-TOP -->
        <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

        <!-- JQUERY JS -->
        <script src="{{asset('build/assets/plugins/jquery/jquery.min.js')}}"></script>

        <!-- BOOTSTRAP JS -->
        <script src="{{asset('build/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
        <script src="{{asset('build/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- SIDE-MENU JS -->
        <script src="{{asset('build/assets/plugins/sidemenu/sidemenu.js')}}"></script>

        <!-- STICKY js -->
        @vite('resources/assets/js/sticky.js')

        <!-- SIDEBAR JS -->
        <script src="{{asset('build/assets/plugins/sidebar/sidebar.js')}}"></script>

        {{-- <!-- Perfect SCROLLBAR JS-->
        <script src="{{asset('build/assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
        <script src="{{asset('build/assets/plugins/p-scroll/pscroll.js')}}"></script>
        <script src="{{asset('build/assets/plugins/p-scroll/pscroll-1.js')}}"></script> --}}

        <!-- POPOVER JS -->
		@vite('resources/assets/js/popover.js')

		<!-- NOTIFICATIONS JS -->
		<script src="{{asset('build/assets/plugins/notify/js/rainbow.js')}}"></script>
		{{-- <script src="{{asset('build/assets/plugins/notify/js/custom-notification.js')}}"></script> --}}
		<script src="{{asset('build/assets/plugins/notify/js/jquery.growl.js')}}"></script>

        @yield('scripts')

        