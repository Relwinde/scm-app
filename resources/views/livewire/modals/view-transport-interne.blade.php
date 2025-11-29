@php
    $destinations_number = $dossier->destinations->count()
@endphp
<div>
    <div class="row " >
        {{-- <div class="col-md-6 col-lg-6"> --}}
            {{-- @include('partials.create-dossier-form') --}}
            <div class="card form-input-elements">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="mb-0 card-title">N°: <b>{{$dossier->numero}}</b></h3>&nbsp; &nbsp;
                    <h2 class="text-primary" ><i class="fa fa-map-pin"></i> Statut: {{ mb_strtoupper($dossier->status?->name, 'UTF-8') }}&nbsp;&nbsp;&nbsp;&nbsp;</h2>

                    <h1 class="card-title">
                        <button class="btn btn-default-light" href="javascript:void(0);" wire:click="$dispatch('openModal', {component: 'modals.transport-interne.view-documents', arguments: { dossier : {{ $dossier->id }} }})"> <i class="fa fa-folder-open"></i> Documents</button>
                    </h1>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                    @can('Voir le total des dépenses du dossier')
                        <button wire:click="export" id="bAcep" type="button" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-download"></i>
                        </button>
                        <h3 class="card-title">Dépenses: <b>{{number_format($total_depenses, 2, '.', ' ')}} CFA</b></h3>&nbsp; &nbsp;
                    @endcan

                        
                    <div class="card-options">
                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fe fe-list me-2 d-inline-flex"></i>Itineraire ({{$destinations_number}})
                            </button>
                            <div class="dropdown-menu">
                                
                                @if ($destinations_number>0)
                                    <a wire:click="$dispatch('openModal', {component: 'modals.transport-interne.view-itineraires', arguments: { dossier : {{ $dossier->id }} }})" class="dropdown-item" href="javascript:void(0);">Voir</a>
                                    <a wire:click="$dispatch('openModal', {component: 'modals.transport-interne.create-itineraire', arguments: { dossier : {{ $dossier->id }} }})" class="dropdown-item" href="javascript:void(0);">Nouveau</a>
                                @else
                                    <a wire:click="$dispatch('openModal', {component: 'modals.transport-interne.create-itineraire', arguments: { dossier : {{ $dossier->id }} }})" class="dropdown-item" href="javascript:void(0);">Nouveau</a>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    

                </div>

                @if ($last_update > 7 && $dossier->status?->code=='arch')
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                            <span class="alert-inner--text"><strong>Attention !</strong> Le statut de ce dossier a été mis à jour il y'a <strong>{{$last_update}} jours</strong> ! </span>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button> --}}
                        </div>
                    </div> 
                @endif
                <div class="card-header">
                    <h3 class="card-title m-2"><a target="_blank"  href="{{route('print-transport', $dossier->id)}}" class="btn btn-sm btn-outline-primary"><i class="fe fe-file me-2 d-inline-flex"></i>Page de garde</a></h3>
                    {{-- <h3 class="card-title m-2"><a target="_blank"  href="{{route('print-transport', $dossier->id)}}" class="btn btn-sm btn-outline-primary"><i class="fe fe-file me-2 d-inline-flex"></i>Bordereau de livraison</a></h3> --}}
                    <div class="card-title m-2">

                        @if (!$dossier->hasPassedThroughAny (['lvr']))
                            <a wire:click="$dispatch('openModal', {component: 'modals.transport-interne.print-delivery-slip', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i class="fa fa-file-text"></i> Bordereau de livraison</a>   
                        @endif

                    </div>  
                    @if ($dossier->hasPassedThrough (['ecl']) && !$dossier->hasPassedThroughAny (['lvr']))
                        <div class="card-title m-2">
                            @can('Charger les bordereaux de livraison signés')
                                <a wire:click='uploadBordereauLivraison' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Charger le BL signé</a>
                            @endcan
                        </div>     
                    @endif 
                    
                    {{-- Gestion des statuts après livraison --}}
                        @if ($dossier->hasPassedThrough (['ecl','lvr']) && !$dossier->hasPassedThroughAny (['tr_fact']))
                            <div class="card-title m-2">
                                @can('Charger les bordereaux de livraison signés')
                                    <a wire:click='setFacturation' href="javascript:void(0);" wire:confirm='Êtes-vous sûr de vouloir transmettre ce dossier pour facturation ?' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Transmettre pour facturation</a>
                                @endcan
                            </div>     
                        @endif 

                        @if ($dossier->hasPassedThrough (['ecl','lvr','tr_fact']) && !$dossier->hasPassedThroughAny (['fact']))
                            <div class="card-title m-2">
                                @can('Charger les bordereaux de livraison signés')
                                    <a wire:click='setFacture' wire:confirm='Confirmez vous que ce dossier a bien été facturé ?' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Facturé</a>
                                @endcan
                            </div>     
                        @endif

                        @if ($dossier->hasPassedThrough (['ecl','lvr','tr_fact','fact']) && !$dossier->hasPassedThroughAny (['pay']))
                            <div class="card-title m-2">
                                @can('Charger les bordereaux de livraison signés')
                                    <a wire:click='setPayment' wire:confirm='Confirmez vous le paiement de ce dossier ?' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Confirmer paiement</a>
                                @endcan
                            </div>     
                        @endif

                        @if ($dossier->hasPassedThrough (['ecl','lvr','tr_fact','fact','pay']) && !$dossier->hasPassedThroughAny (['arch']))
                            <div class="card-title m-2">
                                @can('Charger les bordereaux de livraison signés')
                                    <a wire:click='setArchive' wire:confirm='Souhaitez vous vraiment archiver ce dossier ?' href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Archiver</a>
                                @endcan
                            </div>     
                        @endif

                    {{-- Fin gestion des statuts après livraison --}}

                    <div class="card-title m-2">
                        @can('Créer bons de caisse')
                            <button wire:click="$dispatch('openModal', {component: 'modals.transport-interne.create-bon', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-sm btn-warning">Créer un bon</button>    
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
                                    <label class="form-label">Client<span class="required">*</span></label>
                                    <select required  @if ($edit==false) readonly disabled="" @endif wire:model='client' name="client" class="form-control custom-select select2">
                                        <option value="" >Sélectionnez un client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{$client->id}}" >{{$client->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Chauffeur</label>
                                    <select  @if ($edit==false) readonly disabled="" @endif wire:model='chauffeur' name="country" id="select-countries" class="form-control custom-select select2">
                                        <option value="" >Sélectionnez un chauffeur</option>
                                        @foreach ($chauffeurs as $chauffeur)
                                            <option value="{{$chauffeur->id}}" >{{$chauffeur->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label">Nature du colis<span class="required">*</span></label>
                                    <select required wire:model='marchandise' name="country" id="select-countries" class="form-control custom-select select2 " @if ($edit==false) readonly disabled="" @endif>
                                        <option value="" >Sélectionnez une marchandise</option>
                                        @foreach ($marchandises ?? [] as $marchandise)
                                            <option value="{{$marchandise->id}}" >{{$marchandise->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Véhicule</label>
                                    <select  @if ($edit==false) readonly disabled="" @endif wire:model='vehicule' name="country" id="select-countries" class="form-control custom-select select2">
                                        <option>Selectionner un véhicule</option>
                                        @foreach ($vehicules as $vehicule)
                                            <option value="{{$vehicule->id}}" >{{$vehicule->immatriculation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label">Nombre de colis</label>
                                    <input @if ($edit==false) readonly disabled="" @endif wire:model='nombre_colis' type="number" class="form-control" name="example-text-input" placeholder="Nombre de colis">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Poids (KG)</label>
                                    <input @if ($edit==false) readonly disabled="" @endif wire:focusout='reformat_poids()' wire:model='poids' type="text" class="form-control" name="example-text-input" placeholder="Poids">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">N° BL/LTA</label>
                                    <input @if ($edit==false) readonly disabled="" @endif wire:model='num_lta_bl' type="text" class="form-control" name="num_lta_bl" placeholder="N° BL/LTA">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label">Volume</label>
                                    <input @if ($edit==false) readonly disabled="" @endif wire:focusout='reformat_volume()' wire:model='volume' type="text" class="form-control" name="example-text-input" placeholder="Volume">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Montant</label>
                                    <input wire:focusout='reformat_montant ()'  @if ($edit==false) readonly disabled="" @endif wire:model='montant' type="text" class="form-control" name="example-text-input" placeholder="">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">N° de commande</label>
                                    <input @if ($edit==false) readonly disabled="" @endif wire:model='num_commande' type="text" class="form-control" name="num_commande" placeholder="N° de commande">
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                {{-- <div class="mb-0">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" name="example-textarea-input" rows="4" placeholder="text here.."></textarea>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if ($edit==true)
                            <div class="btn-list">                                
                                @can('Modifier transport interne')
                                    <button type="submit" href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>                                
                                @endcan
                                <a href="javascript:void(0);" wire:click='setEdit' class="btn btn-danger">Annuler</a>
                            </div>
                        @else
                            <div class="btn-list">
                                @can('Modifier transport interne')
                                    <button wire:click='setEdit' href="javascript:void(0);" class="btn btn-primary">Modifier</button>  
                                @endcan
                                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
                            </div>
                        @endif
                    </div>
                </div>
            </form>

            @script
    <script>
        $wire.on('new-dossier', () => {
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
                        message: "Une erreur est survenue"
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
    </script>
@endscript

        {{-- </div> --}}
    </div>
</div>
