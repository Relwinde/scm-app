<div>
    <div class="card form-input-elements">
        <div class="card-header justify-content-between">
            <h3 class="mb-0 card-title"><b>Renseignement de la base d'imputation du dossier {{ $dossier->numero }}</b></h3>
        </div>
        <form wire:submit.prevent="save">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Entrez le numéro de la base d'imputation</label>
                            <input class="form-control" type="text" wire:model="numero_bi" required>
                            @error('numero_bi')<div class="error-message"> {{ $message }} </div>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-list">
                    <button class="btn btn-primary">Enregistrer</button>
                    <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>

@script
    <script>
        $wire.on('base-imputation-saved', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "La base d'imputation a été enregistrée avec succès."
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
    </script>
@endscript
