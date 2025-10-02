@php
    $observations_number = $dossier->observations->count()
@endphp

<div class="card form-input-elements">
    <div class="card-header d-flex justify-content-between">
        <h1 class="mb-0 card-title"><b>{{$dossier->numero}}</b>&nbsp;&nbsp;&nbsp;&nbsp;</h1>
        @if ($dossier->regime)
            <h2 class="text-danger" ><i class="fa fa-map-signs"></i> {{ mb_strtoupper($dossier->regime, 'UTF-8') }}&nbsp;&nbsp;&nbsp;&nbsp;</h2>
        @endif
        <h2 class="text-primary" ><i class="fa fa-map-pin"></i> Statut: {{ mb_strtoupper($dossier->status?->name, 'UTF-8') }}&nbsp;&nbsp;&nbsp;&nbsp;</h2>

        <h1 class="card-title">
            <button class="btn btn-default-light" href="javascript:void(0);" wire:click="$dispatch('openModal', {component: 'modals.dossier.view-documents', arguments: { dossier : {{ $dossier->id }} }})"> <i class="fa fa-folder-open"></i> Documents</button>
        </h1>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        @can('Voir le total des dépenses du dossier')
            <button wire:click="export" id="bAcep" type="button" class="btn btn-sm btn-outline-primary">
            <i class="fa fa-download"></i>
            </button>
            <h1 class="card-title"><b>&nbsp;Dépenses: {{number_format($total_depenses, 2, '.', ' ')}} CFA</b></h1>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endcan

        <div class="card-options">
            <div class="dropdown">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fe fe-list me-2 d-inline-flex"></i>Commentaires ({{$observations_number}})
                </button>
                <div class="dropdown-menu">
                    
                    @if ($observations_number>0)
                        <a wire:click="$dispatch('openModal', {component: 'modals.dossier.view-observations', arguments: { dossier : {{ $dossier->id }} }})" class="dropdown-item" href="javascript:void(0);">Voir</a>
                        <a wire:click="$dispatch('openModal', {component: 'modals.dossier.create-observation', arguments: { dossier : {{ $dossier->id }} }})" class="dropdown-item" href="javascript:void(0);">Nouveau</a>
                    @else
                        <a wire:click="$dispatch('openModal', {component: 'modals.dossier.create-observation', arguments: { dossier : {{ $dossier->id }} }})" class="dropdown-item" href="javascript:void(0);">Nouveau</a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    <div class="card-header">
        <h3 class="card-title m-2"><a target="_blank"  href="{{route('print-dossier', $dossier->id)}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-file"></i> Page de garde</a></b></h3>
        {{-- <h3 class="card-title m-2"><a target="_blank"  href="{{route('print-dossier', $dossier->id)}}" class="btn btn-sm btn-outline-primary">Bordereau de livraison</a></b></h3> --}}

        <div class="card-title m-2">
            {{-- @can('Créer bons de caisse') --}}
                <a wire:click="$dispatch('openModal', {component: 'modals.dossier.print-delivery-slip', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i class="fa fa-file-text"></i> Bordereau de livraison</a>  
            {{-- @endcan --}}
        </div>
        <div class="card-title m-2">
            @can('Etablir la feuille minute')
                {{-- <a wire:click="$dispatch('openModal', {component: 'modals.dossier.feuille-minute', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i class="fa fa-file-text-o"></i> Feuille minute</a>   --}}
                <a @if ($dossier->status?->code == 'ssi' || $dossier->dossier_status_id == null)
                    wire:confirm='Êtes-vous sûr de vouloir établir la feuille minute ? Cette action suppose que le dossier est codifié.'
                @endif  wire:click="feuilleMinute" href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i class="fa fa-file-text-o"></i> Feuille minute</a>  
            @endcan
        </div>

        {{-- Gestion des status TTC --}}
            @if ($dossier->regime == "TTC" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def']) && !$dossier->hasPassedThroughAny (['eng_dep']))
                <div class="card-title m-2">
                    @can('Enregistrer & déposer dossiers en douane')
                        <a wire:click='confirmDeposit' wire:confirm='Ce dossier a-t-il bien été enregistré et déposé en douane ?' href="javascript:void(0);" class="btn btn-sm btn-outline-primary"> @if ($declaration_error)
                            <span class="alert-inner--icon">
                            <i class="fe fe-info" style="font-size: 1.5em; animation: flash 1s infinite alternate;"></i>
                            </span>
                            <style> 
                                @keyframes flash {
                                    0% { opacity: 1; }
                                    50% { opacity: 0.2; }
                                    100% { opacity: 1; }
                                }
                            </style>
                        @endif Confirmer le dépôt en douane</a>
                    @endcan
                </div>
            @endif

            @if ($dossier->regime == "TTC" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def', 'eng_dep']) && ! $dossier->hasPassedThroughAny (['bae']))
                <div class="card-title m-2">
                    @can('Charger le BAE')
                        <a wire:click='uploadBae' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Charger le BAE</a>
                    @endcan
                </div>
            @endif

            @if ($dossier->regime == "TTC" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def', 'eng_dep', 'bae']) && !$dossier->hasPassedThroughAny (['lvr']))
                <div class="card-title m-2">
                    @can('Charger les bordereaux de livraison signés')
                        <a wire:click='uploadBordereauLivraison' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Charger le BL signé</a>
                    @endcan
                </div>
            @endif

            {{-- Fin gestion des status TTC --}}

        {{-- Gestion des status EXO --}}
            @if ($dossier->regime == "EXO" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def']) && !$dossier->hasPassedThroughAny (['ba_imp']))
                <div class="card-title-m-2">
                    @can('Renseigner la base d\'imputation')
                        <a wire:click='openBaseImputationModal' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Renseigner la base d'imputation</a> 
                    @endcan
                </div>
            @endif

            @if ($dossier->regime == "EXO" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def', 'ba_imp']) && !$dossier->hasPassedThroughAny (['di_dep']))
                <div class="card-title-m-2">
                    @can('Renseigner la base d\'imputation')
                        <a wire:click='openDemandeExoModal' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Charger la demande d'exonération</a> 
                    @endcan
                </div>
            @endif
            @if ($dossier->regime == "EXO" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def', 'ba_imp', 'di_dep']) && !$dossier->hasPassedThroughAny (['rep_exo']))
                <div class="card-title-m2">
                    @can('Confirmer la reponse de la DE')
                        <a wire:click='openDecisionExoModal' class="btn btn-sm btn-outline-primary">
                            Confirmer la reception de la décision d'exonération
                        </a>   
                    @endcan
                </div>
            @endif
            @if ($dossier->regime == "EXO" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def', 'ba_imp', 'di_dep', 'rep_exo']) && !$dossier->hasPassedThroughAny (['eng_dep']))
                <div class="card-title-m-2">
                    @can('Charger les bordereaux de livraison signés')
                        <a wire:confirm='Ce dossier a-t-il bien été enregistré et déposé en douane ?' wire:click='confirmDepositExo' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">@if ($declaration_error)
                            <span class="alert-inner--icon">
                            <i class="fe fe-info" style="font-size: 1.5em; animation: flash 1s infinite alternate;"></i>
                            </span>
                            <style> 
                                @keyframes flash {
                                    0% { opacity: 1; }
                                    50% { opacity: 0.2; }
                                    100% { opacity: 1; }
                                }
                            </style>
                        @endif Confirmer le dépôt en douane</a>
                    @endcan
                </div>
            @endif

            @if ($dossier->regime == "EXO" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def', 'ba_imp', 'di_dep', 'eng_dep']) && ! $dossier->hasPassedThroughAny (['bae']))
                <div class="card-title m-2">
                    @can('Charger le BAE')
                        <a wire:click='uploadBae' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Charger le BAE</a>
                    @endcan
                </div>
            @endif

            @if ($dossier->regime == "EXO" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def', 'ba_imp', 'di_dep', 'eng_dep', 'bae']) && !$dossier->hasPassedThroughAny (['lvr']))
                <div class="card-title m-2">
                    @can('Charger les bordereaux de livraison signés')
                        <a wire:click='uploadBordereauLivraison' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Charger le BL signé</a>
                    @endcan
                </div>
            @endif
            {{-- Fin gestion des status EXO --}}
        <div class="card-title m-2">
            @can('Créer bons de caisse')
                <a wire:click="$dispatch('openModal', {component: 'modals.dossier.create-bon', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-sm btn-warning"><i class="fa fa-money"></i> Créer un bon</a>  
            @endcan
        </div>
    </div>
    @if ($edit==true)
    <form wire:submit.prevent="update" >
    @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Client</label>
                        <select required wire:model='client' name="client" class="form-control custom-select select2" @if ($edit==false) readonly disabled="" @endif>
                            <option value="" >Sélectionnez un client</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}" >{{$client->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de Commande</label>
                        <input wire:model='num_commande' type="text" class="form-control " @if ($edit==false) readonly @endif  name="example-text-input" >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Fournisseur</label>
                        <input wire:model='fournisseur' type="text" class="form-control " @if ($edit==false) readonly @endif  name="example-text-input" >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de Facture</label>
                        <input wire:model='num_facture' type="text" class="form-control" @if ($edit==false) readonly @endif name="example-text-input" >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Nature du colis</label>
                        <select wire:model='marchandise' name="country" id="select-countries" class="form-control custom-select select2 " @if ($edit==false) readonly disabled="" @endif>
                            <option value="" >Sélectionnez une marchandise</option>
                            @foreach ($marchandises as $marchandise)
                                <option value="{{$marchandise->id}}" >{{$marchandise->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° SYLVIE</label>
                        <input wire:model='num_sylvie' type="text" class="form-control" @if($edit==false) readonly @endif name="num_sylvie" >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de décision EXO</label>
                        <input wire:model='num_exo' type="text" class="form-control"  @if($edit==false) readonly @endif>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nombre de colis</label>
                        <input wire:focusout='reformat_nombre_colis()' wire:model='nombre_colis' type="text" class="form-control" @if($edit==false) readonly @endif >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Bureau de douane</label>
                        <select wire:model='bureau_de_douane' name="bureau_de_douane" class="form-control custom-select select2" @if ($edit==false) readonly disabled="" @endif >
                            <option value="" >Sélectionnez un bureau de douane</option>
                            @foreach ($bureau_de_douanes as $bureau_de_douane)
                                <option value="{{$bureau_de_douane->id}}" >{{$bureau_de_douane->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° BL/LTA</label>
                        <input wire:model='num_lta_bl' type="text" class="form-control" @if($edit==false) readonly @endif>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Poids (KG)</label>
                        <input wire:focusout='reformat_poids()' wire:model='poids' type="text" class="form-control " @if($edit==false) readonly @endif name="example-text-input">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de déclaration</label>
                        <input wire:model='num_declaration' type="text" class="form-control " @if ($edit==false || $dossier->hasPassedThroughAny(['eng_dep'])) readonly @endif name="example-text-input" >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Numéro de T1</label>
                        <input wire:model='num_t' type="text" class="form-control" name="num_t" @if($edit==false) readonly @endif>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Provenance</label>
                        <input wire:model='origine' type="text" class="form-control" placeholder="Provenance" @if($edit==false) readonly @endif name="origine">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">
                            @if($value_error)
                                <span class="alert-inner--icon">
                                <i class="fe fe-info" style="font-size: 1.5em; animation: flash 1s infinite alternate;"></i>
                                </span> &nbsp;&nbsp;
                                <style> 
                                    @keyframes flash {
                                        0% { opacity: 1; }
                                        50% { opacity: 0.2; }
                                        100% { opacity: 1; }
                                    }
                                </style>
                            @endif
                            Valeur CAF 
                        </label>
                        <input wire:focusout='reformat_valeur_caf()' wire:model='valeur_caf' type="text" class="form-control" @if($edit==false || $dossier->hasPassedThroughAny(['fm_def'])) readonly @endif name="valeur_caf" >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">
                             @if($value_error)
                                <span class="alert-inner--icon">
                                <i class="fe fe-info" style="font-size: 1.5em; animation: flash 1s infinite alternate;"></i>
                                </span> &nbsp;&nbsp;
                                <style> 
                                    @keyframes flash {
                                        0% { opacity: 1; }
                                        50% { opacity: 0.2; }
                                        100% { opacity: 1; }
                                    }
                                </style>
                            @endif
                            Valeur FOB Devise
                        </label>
                        <input wire:focusout='reformat_fob_devis()' wire:model='fob_devis' type="text" class="form-control" placeholder="Valeur FOB Devise" @if($edit==false || $dossier->hasPassedThroughAny(['fm_def'])) readonly @endif name="fob_devis" >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">
                             @if($value_error)
                                <span class="alert-inner--icon">
                                <i class="fe fe-info" style="font-size: 1.5em; animation: flash 1s infinite alternate;"></i>
                                </span> &nbsp;&nbsp;
                                <style> 
                                    @keyframes flash {
                                        0% { opacity: 1; }
                                        50% { opacity: 0.2; }
                                        100% { opacity: 1; }
                                    }
                                </style>
                            @endif
                            Fret
                        </label>
                        <input wire:focusout='reformat_fret()' wire:model='fret' type="text" class="form-control" placeholder="Fret" @if($edit==false || $dossier->hasPassedThroughAny(['fm_def'])) readonly @endif name="fret" >
                    </div>
                    <div class="mb-4">
                        <label class="form-label"> N° Sommier </label>
                        <input wire:model='sommier' type="text" class="form-control" placeholder="N° Sommier" @if($edit==false || $dossier->hasPassedThroughAny(['fm_def'])) readonly @endif name="sommier">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">
                             @if($value_error)
                                <span class="alert-inner--icon">
                                <i class="fe fe-info" style="font-size: 1.5em; animation: flash 1s infinite alternate;"></i>
                                </span> &nbsp;&nbsp;
                                <style> 
                                    @keyframes flash {
                                        0% { opacity: 1; }
                                        50% { opacity: 0.2; }
                                        100% { opacity: 1; }
                                    }
                                </style>
                            @endif
                            Valeur FOB XOF
                        </label>
                        <input wire:focusout='reformat_fob_xof()' wire:model='fob_xof' type="text" class="form-control" placeholder="Valeur FOB XOF" name="fob_xof" @if($edit==false || $dossier->hasPassedThroughAny(['fm_def'])) readonly @endif>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                             @if($value_error)
                                <span class="alert-inner--icon">
                                <i class="fe fe-info" style="font-size: 1.5em; animation: flash 1s infinite alternate;"></i>
                                </span> &nbsp;&nbsp;
                                <style> 
                                    @keyframes flash {
                                        0% { opacity: 1; }
                                        50% { opacity: 0.2; }
                                        100% { opacity: 1; }
                                    }
                                </style>
                            @endif
                            Assurance
                        </label>
                        <input wire:focusout='reformat_assurance()' wire:model='assurance' type="text" class="form-control" placeholder="Assurance" name="assurance" @if($edit==false || $dossier->hasPassedThroughAny(['fm_def'])) readonly @endif>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">
                             @if($value_error)
                                <span class="alert-inner--icon">
                                <i class="fe fe-info" style="font-size: 1.5em; animation: flash 1s infinite alternate;"></i>
                                </span> &nbsp;&nbsp;
                                <style> 
                                    @keyframes flash {
                                        0% { opacity: 1; }
                                        50% { opacity: 0.2; }
                                        100% { opacity: 1; }
                                    }
                                </style>
                            @endif
                            Autres frais
                        </label>
                        <input wire:focusout='reformat_autre_frais()' wire:model='autre_frais' type="text" class="form-control" @if($edit==false || $dossier->hasPassedThroughAny(['fm_def'])) readonly @endif name="autre_frais" >
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if ($edit==true)
                <div class="btn-list">
                    @can('Modifier dossier')
                        <button type="submit" href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>
                    @endcan
                    <a href="javascript:void(0);" wire:click='setEdit' class="btn btn-danger">Annuler</a>
                </div>
            @else
                <div class="btn-list">
                    @can('Modifier dossier')
                        <button wire:click='setEdit' href="javascript:void(0);" class="btn btn-primary">Modifier</button>       
                    @endcan
                    <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
                </div>
            @endif
        </div>
    </div>
@if ($edit==true)
</form>
@endif

@script
    <script>
        $wire.on('update-dossier', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le dossier a été modifié"
                    });
                });
            }).call(this);
        });

        $wire.on('error', () => {
            (function () {
                $(function () {
                    return $.growl.warning({
                        title: "Succès :",
                        message: "Une erreur est survenue, veuillez réessayez !"
                    });
                });
            }).call(this);
        });

        $wire.on('feuille-minute-novalue', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        title: "Erreur de valeur",
                        message: "Pour établir la feuille minute, remplissez tous les champs requis :\n                        Valeur CAF, Valeur FOB XOF, Fret, Assurance.",
                        icon: "warning",
                        duration: 10000,
                    });
                });
            }).call(this);
        });

        $wire.on('not-allowed', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        message: "Action non autorisée."
                    });
                });
            }).call(this);
        });

        $wire.on('deposit-confirmed', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le dépôt en douane a été confirmé."
                    });
                });
            }).call(this);
        });

        $wire.on('bae-confirmed', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le BAE a été enregistré avec succès."
                    });
                });
            }).call(this);
        });

        $wire.on('declaration-error', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        title: "Erreur :",
                        message: "Le numéro de déclaration est obligatoire pour valider cette étape."
                    });
                });
            }).call(this);
        });

        $wire.on('status-transition-error', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        title: "Erreur de statut",
                        message: "Le dossier ne peut pas passer au statut suivant. Veuillez vérifier le statut actuel du dossier et les conditions requises pour la transition."
                    });
                });
            }).call(this);
        });

        $wire.on('bae-already-uploaded', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        title: "Erreur :",
                        message: "Le BAE a déjà été importé pour ce dossier."
                    });
                });
            }).call(this);
        });
    </script>
@endscript


