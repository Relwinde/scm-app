<div>
    @include('layouts.components.page-header', ['title'=>$header_title])

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-left">

                        @yield('create-button')
                       
                        <div class="main-header-center ms-3 d-none d-lg-block">
                            {{-- <form  wire:submit="search" > --}}
                                <input   wire:model.live.debounce="search" type="text" class="form-control" placeholder="Recherche...">
                                {{-- <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button> --}}
                            {{-- </form> --}}
                        </div>
                    </div>
                        @yield('table')
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
    @section('scripts')

    <!-- SELECT2 JS -->
    <script src="{{asset('build/assets/plugins/select2/select2.full.min.js')}}"></script>
    @vite('resources/assets/js/select2.js')

    <!-- DATA TABLE JS-->
    {{-- <script src="{{asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/responsive.bootstrap5.min.js')}}"></script> --}}
    @vite('resources/assets/js/table-data.js')

    @endsection
</div>
