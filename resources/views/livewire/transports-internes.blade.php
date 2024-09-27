<div>
    @include('layouts.components.page-header', ['title'=>'Dossiers de transports internes'])

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des dossiers</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-left">
                        <button wire:click="$dispatch('openModal', {component: 'modals.create-transport-interne'})" class="btn btn-primary mb-4"> Nouveau Dossier</button>
                        <div class="main-header-center ms-3 d-none d-lg-block">
                            <input type="text" class="form-control" placeholder="Recherche..." autocomplete="off">
                            <button  class="btn px-0 pt-2"></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0"><b>Numéro</b></th>
                                    <th class="wd-15p border-bottom-0"><b>Client</b></th>
                                    <th class="wd-20p border-bottom-0"><b>Chauffeur</b></th>
                                    <th class="wd-15p border-bottom-0"><b>Véhicule</b></th>
                                    <th class="wd-10p border-bottom-0"><b>Itinéraire</b></th>
                                    <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dossiers as $dossier)
                                    <tr>
                                        <td>{{$dossier->numero}}</td>
                                        <td>{{$dossier->client->nom}}</td>
                                        <td>{{$dossier->chauffeur->nom}}</td>
                                        <td>{{$dossier->vehicule->immatriculation}}</td>
                                        <td></td>
                                        <td name="bstable-actions">
                                            <div class="btn-list">
                                                <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                                    <span class="fe fe-edit"> </span>
                                                </button>
                                                <button wire:click="$dispatch('openModal', {component: 'modals.view-transport-interne', arguments: { dossier : {{ $dossier->id }} }})" id="bAcep" type="button" class="btn  btn-sm btn-primary">
                                                    <span class="fe fe-eye"> </span>
                                                </button>
                                                <button id="bDel" type="button" class="btn  btn-sm btn-danger">
                                                    <span class="fe fe-trash-2"> </span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
