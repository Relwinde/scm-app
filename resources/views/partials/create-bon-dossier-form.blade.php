<form wire:submit.prevent="createBon">
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>{{$title}} {{$dossier->numero}}</b></h3>
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
                <div class="col-md-6">
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
                <div class="col-md-12 ">
                    <div class="mb-0">
                        <label class="form-label">Commentaire</label>
                        <textarea wire:model='description' class="form-control" rows="2" placeholder="Votre commentaire ici.."></textarea>
                    </div>
                    @error('description') <div class="error-message"> {{ $message }} </div> @enderror
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
