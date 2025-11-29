<form wire:submit.prevent="create">
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>{{$title}}</b></h3>
        </div>
        @if ($alert_fm)
            <div class="card-body">
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                    <span class="alert-inner--text"><strong>Attention ! </strong>Vous avez des feuilles minutes à régulariser, vous pourriez ne plus être autorisé à effectuer des opérations sur la plateforme</strong> ! Veillez les régulariser au plus vite.</span>
                    <button wire:click="$dispatch('openModal', {component: 'modals.dossier.view-alert-dossiers', arguments: { statut : 'fm' }})" type="button" class="btn-close">
                        <span aria-hidden="true"><span class="fe fe-eye"> </span></span>
                    </button>
                </div>
            </div> 
        @endif
        @if ($alert_dex)
            <div class="card-body">
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                    <span class="alert-inner--text"><strong>Attention ! </strong>Vous avez des dossiers en attente d'exonération à régulariser, vous pourriez ne plus être autorisé à effectuer des opérations sur la plateforme</strong> ! Veillez les régulariser au plus vite.</span>
                    <button wire:click="$dispatch('openModal', {component: 'modals.dossier.view-alert-dossiers', arguments: { statut : 'dex' }})" type="button" class="btn-close">
                        <span aria-hidden="true"><span class="fe fe-eye"> </span></span>
                    </button>
                </div>
            </div>
        @endif
        @if ($alert_bae)
            <div class="card-body">
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                    <span class="alert-inner--text"><strong>Attention ! </strong>Vous avez des dossiers en attente de bon à émettre à régulariser, vous pourriez ne plus être autorisé à effectuer des opérations sur la plateforme</strong> ! Veillez les régulariser au plus vite.</span>
                    <button wire:click="$dispatch('openModal', {component: 'modals.dossier.view-alert-dossiers', arguments: { statut : 'bae' }})" type="button" class="btn-close">
                        <span aria-hidden="true"><span class="fe fe-eye"> </span></span>
                    </button>
                </div>
            </div>
        @endif

        <div class="card-body">
            <div class="row">
                    <div class="mb-4 form-elements">
                        <div class="btn-list">
                            <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                                <input wire:model.live='surDossier' type="radio" class="custom-control-input" name="example-radios" value="1">
                                <span class="custom-control-label"><b>IMPORT / EXPORT</b></span>
                            </label>
                            <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                                <input wire:model.live='surDossier' type="radio" class="custom-control-input" name="example-radios" value="2">
                                <span class="custom-control-label"><b>TRANSPORT</b></span>
                            </label>
                            <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                                <input wire:model.live='surDossier' type="radio" class="custom-control-input" name="example-radios" value="4">
                                <span class="custom-control-label"><b>VEHICULE</b></span>
                            </label>
                            <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                                <input wire:model.live='surDossier' type="radio" class="custom-control-input" name="example-radios" value="3">
                                <span class="custom-control-label"><b>Autres</b></span>
                            </label>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    @if ($surDossier == 1 || $surDossier == 2 || $surDossier == 4)
                        <div class="mb-4">
                            @if ($surDossier == 1 || $surDossier == 2) 
                                <label class="form-label">Numéro de dossier<span class="required">*</span></label>
                            @endif
                            @if ($surDossier == 4)
                                <label class="form-label">Immatriculation du véhicule<span class="required">*</span></label>
                            @endif
                            @if ($surDossier == 1 || $surDossier == 2 || $surDossier == 4)
                                <input wire:model.live.debounce='search' type="text" class="form-control" placeholder="Filtre">
                            @endif
                            <select required wire:model='dossier' name="user_profile" class="form-control custom-select select2">
                                
                                @if ($surDossier == 1)
                                    <option value="">Sélectionnez un dossier</option>
                                    @foreach ($dossiers as $dossier)
                                        <option value="{{$dossier->id}}" >{{$dossier->numero}}</option>
                                    @endforeach  
                                @elseif ($surDossier == 2)
                                    <option value="">Sélectionnez un dossier</option>
                                    @foreach ($transports as $transport)
                                        <option value="{{$transport->id}}" >{{$transport->numero}}</option>
                                    @endforeach
                                @elseif ($surDossier == 4)
                                    <option value="">Sélectionnez un véhicule</option>
                                    @foreach ($vehicules as $vehicule)
                                        <option value="{{$vehicule->id}}" >{{$vehicule->immatriculation}} - {{$vehicule->description}}</option>
                                    @endforeach
                                @endif
                            </select>
                            
                        </div>
                    @endif
                    
                    <div class="mb-4">
                        <label class="form-label">Montant<span class="required">*</span></label>
                        <input wire:focusout='reformat_montant()' required wire:model='montant' type="text" class="form-control"  placeholder="Montant">
                        @error('montant') <div class="error-message"> {{ $message }} </div> @enderror
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Intitulé de la dépense<span class="required">*</span></label>
                        <input required wire:model='depense' type="text" class="form-control"  placeholder="Dépense engagée (40 caractères au maximum)">
                        @error('depense') <div class="error-message"> {{ $message }} </div> @enderror
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="mb-0">
                        <label class="form-label">Commentaire</label>
                        <textarea wire:model='description' class="form-control" rows="2" placeholder="Votre commentaire ici.."></textarea>
                        @error('description') <div class="error-message"> {{ $message }} </div> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-list">
                <button href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>
                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
            </div>
        </div>
    </div>


</form>

@script
    <script>
        $wire.on('new-bon-de-caisse', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Bon de caisse créé"
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
    </script>
@endscript