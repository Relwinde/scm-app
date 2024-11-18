@php
    $observations_number = $dossier->observations->count()
@endphp

<div class="card form-input-elements">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title"><a target="_blank"  href="{{route('print-dossier', $dossier->id)}}" class="btn btn-sm btn-outline-primary">Page de garde</a></b></h3>&nbsp; &nbsp;
        <h3 class="mb-0 card-title">Dossier N°: <b>{{$dossier->numero}}</b>&nbsp;&nbsp;</h3>
        @can('Voir le total des dépenses du dossier')
            <button wire:click="export" id="bAcep" type="button" class="btn btn-sm btn-outline-primary">
            <span class="fa fa-file-excel-o"></span>
            </button>
            <h3 class="card-title">Dépenses: <b>{{number_format($total_depenses, 2, '.', ' ')}} CFA</b></h3>&nbsp; &nbsp;
        @endcan
        <button wire:click="$dispatch('openModal', {component: 'modals.dossier.create-bon', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Créer un bon</button>

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
                            <option value="" >Sélectionnez une marchandise</option>
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
                        <input wire:model='num_declaration' type="text" class="form-control " @if ($edit==false) readonly @endif name="example-text-input" >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Valeur CAF</label>
                        <input wire:focusout='reformat_valeur_caf()' wire:model='valeur_caf' type="text" class="form-control" @if($edit==false) readonly @endif name="valeur_caf" >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Numéro de T1</label>
                        <input wire:model='num_t' type="text" class="form-control" name="num_t" @if($edit==false) readonly @endif>
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
                        title: "Succès :",
                        message: "Une erreur est survenue"
                    });
                });
            }).call(this);
        });
    </script>
@endscript


