<div class="card">
    <div class="card-header">
        <h3 class="card-title">Bon De: <b>{{$bon->user->name}}</b></h3>&nbsp; &nbsp; 
        <h3 class="card-title">Pour: <b>{{$bon->depense}}</b></h3>&nbsp; &nbsp;
        <h3 class="card-title">Position: <b>{{$bon->etape}}</b></h3>&nbsp; &nbsp;
        <div class="card-options">
            @if ($bon->etape == "EMETTEUR" && Auth::user()->id == $bon->user->id)
                <a wire:click='nextStep' wire:confirm="Souhaitez vous vraiment exécuter cette action?"  href="javascript:void(0);" class="btn btn-primary btn-sm m-1">Envoyer au responsable</a>
            @elseif ($bon->etape == "RESPONSABLE" && Auth::user()->can('Envoyer bon de caisse au manager'))
                <a wire:click='nextStep' wire:confirm="Souhaitez vous vraiment exécuter cette action?"  href="javascript:void(0);" class="btn btn-primary btn-sm m-1">Envoyer au manager</a>       
            @elseif ($bon->etape == "MANAGER" && Auth::user()->can('Envoyer bon de caisse au RAF'))
                <a wire:click='nextStep' wire:confirm="Souhaitez vous vraiment exécuter cette action?"  href="javascript:void(0);" class="btn btn-primary btn-sm m-1">Envoyer au RAF</a>
            @elseif ($bon->etape == "RAF" && Auth::user()->can('Envoyer bon de caisse à la caisse'))

            <div class="custom-controls-stacked">
                <form wire:confirm="Souhaitez vous vraiment exécuter cette action?" wire:submit.prevent="nextStep">
                        <div class="row m-1 form-elements">
                            <div class="col">
                                <label class="custom-control custom-radio">
                                    <input wire:model='method' required type="radio" class="custom-control-input" name="method" value="ESPECE">
                                    <span style="color: black;" class="custom-control-label">Espèces</span>
                                </label>
                            </div>
                            <div class="col">
                                <label class="custom-control custom-radio">
                                    <input wire:model='method' required type="radio" class="custom-control-input" name="method" value="CHEQUE">
                                    <span style="color: black;" class="custom-control-label">Chèque</span>
                                </label>
                            </div>
                        </div>
                        <button href="javascript:void(0);" class="btn btn-primary btn-sm m-1">Envoyer pour paiement</button>
                    </form>
                </div>
            @elseif ($bon->etape == "CAISSE" && Auth::user()->can('Payer bon de caisse'))
                <a wire:click='nextStep' wire:confirm="Êtes vous sûr de vouloir payer ce bon, cette action iréversible impactera votre caisse"  href="javascript:void(0);" class="btn btn-danger btn-sm m-1"><span class="fa fa-ticket"></span> Payer</a>
            @elseif ($bon->etape == "PAYE" || $bon->etape == "CLOS" && Auth::user()->can('Payer bon de caisse'))
                <a target="_blank"  href="{{route('print-bon', $bon->id)}}" class="btn btn-primary btn-sm m-1">Imprimer le reçu</a>      
            @endif
            @if ($bon->etape == "PAYE" && $bon->type_paiement == "ESPECE" && Auth::user()->can('Effectuer un ajustement de bon'))
                <a wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.create-ajustement', arguments: { bon : {{ $bon->id }} }})" href="javascript:void(0);" class="btn btn-danger btn-sm m-1"><span class="fa fa-ticket"></span> Ajuster le bon</a>      
            @endif
            @if ($bon->etape == "PAYE" && Auth::user()->can('Clore un bon'))
                <a wire:click="close" href="javascript:void(0);" class="btn btn-danger btn-sm m-1" wire:confirm="Êtes vous sûr de vouloir clore ce bon, vous ne pourrez plus effectuer d'ajustement">Clore ce bon</a>      
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="row m-2">
            @if ($bon->commentaires->count() > 0)
                <div class="custom-controls-stacked">
                    <label class="custom-control custom-checkbox">
                        <input wire:model.live='viewComments' type="checkbox" class="custom-control-input">
                        <span class="custom-control-label">Commentaires de retour</span>
                    </label>
                </div>

                @if ($viewComments == true)
                    @foreach ($bon->commentaires as $comment)
                        <div class="alert alert-primary" >   
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>{{$comment->user->name}}: <br> {{$comment->content}} <br> <span>{{strftime("%e %B %Y %H:%M", strtotime($comment->created_at));}} -- {{$comment->etape}}</span>
                        </div>
                    @endforeach
                @endif

            @endif
            
            
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4 col-md-4 ">
                <div class="card">
                    <div class="card-body">
                        <h4>Montant du bon de caisse:</h4>
                        <h1 class="mb-1 number-font" style="font-size: 17px;">{{number_format($bon->montant_definitif, 2, '.', ' ')}} CFA</h1>
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
                        <h4>Client:</h4>
                        <h1 class="mb-1 number-font" style="font-size: 17px;">{{$bon->dossier->client->nom ?? $bon->transport->client->nom ?? "AUTRES"}}</h1>
                    </div>
                </div>
            </div>
            @can('Voir le total des dépenses du dossier')
                 @if ($bon->dossier != null || $bon->transport != null)
                    <div class="col-sm-6 col-lg-4 col-md-4 ">
                        <div class="card">
                            <div class="card-body">
                                <h4>Dépenses sur le dossier à ce jour: </h4>
                                <h1 class="mb-1 number-font" style="font-size: 17px;">{{ $bon->dossier ? number_format($bon->dossier->bon_de_caisse()->where('etape', 'PAYE')->orWhere('etape', 'CLOS')->sum('montant_definitif'), 2, '.', ' ') : number_format($bon->transport->bon_de_caisse()->where('etape', 'PAYE')->orWhere('etape', 'CLOS')->sum('montant_definitif'), 2, '.', ' ') }} CFA</h1>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan
               
            @if ($bon->dossier != null)
                <div class="col-sm-6 col-lg-4 col-md-4 ">
                    <div class="card">
                        <div class="card-body">
                            <h4>Poids: </h4>
                            <h1 class="mb-1 number-font" style="font-size: 17px;">{{number_format($bon->dossier->poids, 2, '.', ' ')}} KG</h1>
                            {{-- <div class="progress progress-sm ">
                                <div class="progress-bar bg-primary @if ($bon->etape == "EMETTEUR")
                                    w-10
                                @endif " role="progressbar"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endif
            @if ($bon->type_paiement != null)
                <div class="col-sm-6 col-lg-4 col-md-4 ">
                    <div class="card">
                        <div class="card-body">
                            <h4>Mode de règlement: </h4>
                            <h1 class="mb-1 number-font" style="font-size: 17px;">{{$bon->type_paiement}}</h1>
                            {{-- <div class="progress progress-sm ">
                                <div class="progress-bar bg-primary @if ($bon->etape == "EMETTEUR")
                                    w-10
                                @endif " role="progressbar"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <hr>

        @if ($bon->ajustements->count() > 0)
            <div class="card m-b-20">
                <div class="card-header">
                    <h3 class="card-title">Ajustements (Montant initial: {{number_format($bon->montant, 2, '.', ' ')}} CFA): </h3>
                    <div class="card-options">
                        {{-- <a href="javascript:void(0);" class="btn btn-primary btn-sm">Ajouter un commentaire</a> --}}
                        <a href="javascript:void(0);" class="card-options-collapse" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    </div>
                </div>
                <div class="card-body">
                        <div class="visitor-list">
                            <div class="m-0 mt-0 pb-2 border-bottom align-items-center">
                            
                                @foreach ($bon->ajustements as $ajustement)
                                    <div class="">
                                        <a href="javascript:void(0);" class="text-default fw-semibold"> {{number_format($ajustement->montant, 2, '.', ' ')}} CFA</a>
                                        <p class="text-muted mb-0">{{$ajustement->type}} :  {{$ajustement->libelle}}, {{ strftime("%e %B %Y", strtotime($ajustement->created_at)); }}</p>
                                    </div>
                                @endforeach
                            
                            </div>
                        </div>
                        
                </div>
            </div>
        @endif


    </div>

    <div class="card-footer">
        @if (($bon->etape == "RESPONSABLE" && Auth::user()->can('Envoyer bon de caisse au manager') && Auth::user()->can('Retourner bon de caisse')) || ($bon->etape == "MANAGER" && Auth::user()->can('Envoyer bon de caisse au RAF') && Auth::user()->can('Retourner bon de caisse')) || ($bon->etape == "RAF" && Auth::user()->can('Envoyer bon de caisse à la caisse') && Auth::user()->can('Retourner bon de caisse')) || ($bon->etape == "CAISSE" && Auth::user()->can('Payer bon de caisse') && Auth::user()->can('Retourner bon de caisse')))
            <a wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.return-bon', arguments: { bon : {{ $bon->id }} }})"  href="javascript:void(0);" class="btn btn-secondary btn-sm m-1">
                        Retourner le bon  
                    </a>
        @endif
    </div>
</div>

@script
    <script>
        $wire.on('insufficient-funds', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        message: "Le solde de votre caisse est insuffisant pour effectuer cette opération"
                    });
                });
            }).call(this);
        });

        $wire.on('operation-success', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le paiement a été effectué avec succès"
                    });
                });
            }).call(this);
        });
        $wire.on('next-step', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le bon a été envoyé à la prochaine étape"
                    });
                });
            }).call(this);
        });
        $wire.on('back-step', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le bon a été renvoyé à l'étape précédente"
                    });
                });
            }).call(this);
        });
        $wire.on('closed', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le bon a été clos et archivé"
                    });
                });
            }).call(this);
        });
    </script>
@endscript