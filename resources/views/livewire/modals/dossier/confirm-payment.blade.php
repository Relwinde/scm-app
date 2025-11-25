<div>
    <div class="card form-input-elements">
        <div class="card-header justify-content-between">
            <h3 class="mb-0 card-title"><b>Confirmer le paiement de la facture du dossier {{ $dossier->numero }}</b></h3>
        </div>
        <form wire:submit.prevent="save">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 ">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Date de paiement</label>
                            <input class="form-control" type="date" wire:model="date_paiement" required>
                            @error('date_paiement')<div class="error-message"> {{ $message }} </div>@enderror
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
        $wire.on('paiement-confirmed', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Paiement confirmé avec succès"
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
