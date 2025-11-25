<div>
    <div class="card form-input-elements">
        <div class="card-header justify-content-between">
            <h3 class="mb-0 card-title"><b>Renseignement de la demande d'exonération du dossier {{ $dossier->numero }}</b></h3>
        </div>
        <form wire:submit.prevent="save">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Entrez le numéro de la demande d'exonération</label>
                            <input class="form-control" type="text" wire:model="numero_demande_exo" required>
                            @error('numero_demande_exo')<div class="error-message"> {{ $message }} </div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Selectionnez la demande d'exonération (format PDF)</label>
                            <input class="form-control" type="file" accept=".pdf" wire:model="file" required>
                            @error('file')<div class="error-message"> {{ $message !="validation.uploaded" ? $message : '' }} </div>@enderror
                        </div>
                    </div>
                </div>

                <div wire:loading wire:target="file">
                    <div class="dimmer active overlay-spinner" style="position:fixed; inset:0; z-index:9999; display:flex; align-items:center; justify-content:center; background:rgba(255,255,255,0.6);">
                        <div class="lds-ring" aria-hidden="true"><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>
                
            </div>
            <div class="card-footer">
                <div class="btn-list">
                    <button class="btn btn-primary" wire:loading.class="disabled" wire:target="file" >Enregistrer <span wire:loading >Chargement...</span> </button>
                    <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>

@script
    <script>
        $wire.on('demande-exo-saved', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "La demande d'exonération a été enregistrée avec succès."
                    });
                });
            }).call(this);
        });
        $wire.on('status-transition-error', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        title: "Erreur :",
                        message: "Une erreur s'est produite lors de la transition."
                    });
                });
            }).call(this);
        });
        $wire.on('not-allowed', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        title: "Erreur :",
                        message: "Vous n'êtes pas autorisé à effectuer cette action."
                    });
                });
            }).call(this);
        });
    </script>
@endscript
