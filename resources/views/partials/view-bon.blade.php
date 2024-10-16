<div class="card">
    <div class="card-header">
        <h3 class="card-title">Bon De: <b>{{$bon->user->name}}</b></h3>&nbsp; &nbsp; 
        <h3 class="card-title">Pour: <b>{{$bon->depense}}</b></h3> 
        <div class="card-options">
            @if ($bon->etape != "PAYE")
                <a9 wire:click='nextStep' wire:confirm="Souhaitez vous vraiment exécuter cette action?"  href="javascript:void(0);" class="btn btn-primary btn-sm">Envoyer à l'étape suivante</a>      
            @endif
            @if ($bon->etape != "PAYE")
                <a href="javascript:void(0);" class="btn btn-secondary btn-sm ms-2">Retourner</a>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-lg-4 col-md-4 ">
                <div class="card">
                    <div class="card-body">
                        <h4>Montant:</h4>
                        <h1 class="mb-1 number-font" style="font-size: 17px;">{{number_format($bon->montant, 2, '.', ' ')}} CFA</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-md-4 ">
                <div class="card">
                    <div class="card-body">
                        <h4>Dossier:</h4>
                        <h1 class="mb-1 number-font" style="font-size: 17px;">{{$bon->dossier->numero ?? $bon->transport->numero ?? "AUTRES"}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-md-4 ">
                <div class="card">
                    <div class="card-body">
                        <h4>Position: </h4>
                        <h1 class="mb-1 number-font" style="font-size: 17px;">{{$bon->etape}}</h1>
                        {{-- <div class="progress progress-sm ">
                            <div class="progress-bar bg-primary @if ($bon->etape == "EMETTEUR")
                                w-10
                            @endif " role="progressbar"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="card m-b-20">
            <div class="card-header">
                <h3 class="card-title">Commentaires</h3>
                <div class="card-options">
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm">Ajouter un commentaire</a>
                    <a href="javascript:void(0);" class="card-options-collapse" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="visitor-list">
                    <div class="media m-0 mt-0 pb-2 border-bottom align-items-center">
                        <div class="media-body">
                            <a href="javascript:void(0);" class="text-default fw-semibold">John Paige</a>
                            <p class="text-muted mb-0">Uploaded new invoices for RedBus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
