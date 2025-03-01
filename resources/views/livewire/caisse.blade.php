@extends('layouts.page-layout')

@section('content')

    <!-- ROW -->
    <div class="row" wire:poll.keep-alive.3s="notificate">
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
                            <h2 class="mb-0 number-font" style="font-size: 25px; font-weight:bold;">{{number_format($solde, 2, '.', ' ')}} F CFA</h2>
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
                            <h2 class="mb-0 number-font" style="font-size: 25px; font-weight:bold;">{{number_format($sommeAttente, 2, '.', ' ')}} F CFA</h2>
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
                            <h2 class="mb-0 number-font" style="font-size: 25px; font-weight:bold;">{{number_format($sommeDepots, 2, '.', ' ')}} F CFA</h2>
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
                            <h2 class="mb-0 number-font" style="font-size: 25px; font-weight:bold;">{{number_format($sommeDecaissements, 2, '.', ' ')}} F CFA</h2>
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
                            <label class="custom-control custom-radio m-2">
                                <input wire:model.live='pick' required type="radio" class="custom-control-input" name="method" value="0">
                                <span style="color: black; font-size: 1.1em;" class="custom-control-label"><b>Bons à la caisse</b></span>
                            </label>
                            <label class="custom-control custom-radio m-2">
                                <input wire:model.live='pick' required type="radio" class="custom-control-input" name="method" value="1">
                                <span style="color: black; font-size: 1.1em;" class="custom-control-label"><b>Mouvements de la caisse</b></span>
                            </label>
                </div>
                <div class="card-body">
                    @if ($pick == 0)
                        <livewire:caisse-bons />
                        
                    @endif
                    @if ($pick == 1)
                        <livewire:mouvement-caisse />
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->


    @script
        <script>
            $wire.on('notification', () => {
                (function () {
                    $(function () {
                        var audio = new Audio('/public/audio/notify.mp3');
                        audio.play();
                        return $.growl({
                            title: "Notification :",
                            message: "Vous avez un nouveau bon de caisse."
                        });
                    });

                    
                }).call(this);

                
            });
        </script>
    @endscript
@endsection
