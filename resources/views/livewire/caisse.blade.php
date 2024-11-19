@extends('layouts.page-layout')

@section('content')

    <!-- ROW -->
    <div class="row">
        <div class="row">
            <div class="col-md-4">
                @can('Effectuer un dépôt')
                    <button wire:click="$dispatch('openModal', {component: 'modals.create-depot'})" class="btn btn-primary m-4"><i class="fa fa-dollar text-white"></i> Effectuer un dépôt</button>
                @endcan
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary img-card box-primary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font" style="font-size: 25px; font-weight:bold;">{{number_format($solde, 2, '.', ' ')}}CFA</h2>
                            <p class="text-white mb-0">Solde</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-database text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-secondary img-card box-secondary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font" style="font-size: 25px; font-weight:bold;">{{number_format($sommeAttente, 2, '.', ' ')}}  CFA</h2>
                            <p class="text-white mb-0">En attente de paiement</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-bars text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card  bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font" style="font-size: 25px; font-weight:bold;">{{number_format($sommeDepots, 2, '.', ' ')}} CFA</h2>
                            <p class="text-white mb-0">Dépots du jour</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-level-down text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-info img-card box-info-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font" style="font-size: 25px; font-weight:bold;">{{number_format($sommeDecaissements, 2, '.', ' ')}} CFA</h2>
                            <p class="text-white mb-0">Décaissements du jour</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-level-up text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div>
    <!-- ROW -->

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>En attente de paiement</b></h3>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-left">
                        <div class="main-header-center m-3 d-none d-lg-block">
                                <input   wire:model.live.debounce="search" type="text" class="form-control" placeholder="Recherche...">
                        </div>
                    </div>
                    <div>
                        <div wire:poll.5s class="table-responsive">
                            <table class="table table-striped table-bordered border text-nowrap mb-0">
                                <thead>
                                    <tr style="font-weight:700;">
                                        <th class="wd-15p border-bottom-0"><b>Numéro</b></th>
                                        <th class="wd-15p border-bottom-0"><b>Dossier</b></th>
                                        <th class="wd-20p border-bottom-0"><b>Emetteur</b></th>
                                        <th class="wd-20p border-bottom-0"><b>Montant</b></th>
                                        <th class="wd-20p border-bottom-0"><b>Dépenses engagées</b></th>
                                        <th class="wd-20p border-bottom-0"><b>Mode de paiement</b></th>
                                        <th class="wd-20p border-bottom-0"><b>Etape</b></th>
                                        <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bonsDeCaisse as $bon)
                                        <tr style="font-weight:600;" wire:key='{{$bon->id}}'>
                                            <td>{{$bon->numero}}</td>
                                            <td>{{$bon->dossier->numero ?? $bon->transport->numero ?? "AUTRES"}}</td>
                                            <td>{{$bon->user->name}}</td>
                                            <td>{{number_format($bon->montant_definitif, 2, '.', ' ')}}</td>
                                            <td>{{$bon->depense}}</td>
                                            <td>
                                                @switch($bon->type_paiement)
                                                    @case("ESPECE")
                                                        Espèces
                                                        @break
                                                    @case("CHEQUE")
                                                        Chèque
                                                        @break
                                                    @default
                                                @endswitch
                                            </td>
                                            <td>@switch($bon->etape)
                                                @case("EMETTEUR")
                                                    <span class="tag tag-azure">Emetteur</span>
                                                    @break
                                                @case("RESPONSABLE")
                                                    <span class="tag tag-indigo">Responsable</span>
                                                    @break
                                                @case("MANAGER")
                                                    <span class="tag tag-purple">Manager</span>
                                                    @break
                                                @case("RAF")
                                                    <span class="tag tag-blue">Responsable finance</span>
                                                    @break
                                                @case("CAISSE")
                                                    <span class="tag tag-red">Caisse</span>
                                                    @break
                                                @case("PAYE")
                                                    <span class="tag tag-orange">Payé</span>
                                                    @break
                                                @case("CLOS")
                                                    <span class="tag tag-gray-dark">Clos</span>
                                                    @break
                                                @default
                                                    
                                            @endswitch</td>
                                            <td name="bstable-actions">
                                                <div class="btn-list">
                                                    {{-- <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                                        <span class="fe fe-edit"> </span>
                                                    </button> --}}
                                                    {{-- <button wire:click="$dispatch('openModal', {component: 'modals.view-bon', arguments: { bon : {{ $bon->id }} }})" id="bAcep" type="button" class="btn  btn-sm btn-primary">
                                                        <span class="fe fe-eye"> </span>
                                                    </button> --}}
                                                    <button wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.view-bon', arguments: { bon : {{ $bon->id }} }})" type="button" class="btn  btn-sm btn-primary">
                                                        <span class="fe fe-eye"> </span>
                                                    </button> 
                                                    {{-- <button type="button" class="btn  btn-sm btn-danger">Payer
                                                            <span class="fa fa-ticket"> </span>
                                                    </button> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{$bonsDeCaisse->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
