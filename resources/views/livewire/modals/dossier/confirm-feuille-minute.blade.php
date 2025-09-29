<div>
    <form wire:submit.prevent="confirm">
        <div class="card form-input-elements">
            <div class="card-header justify-content-between">
                <h3 class="mb-0 card-title"><b>Confirmation de la feuille minute du dossier {{ $dossier->numero }}</b></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Selectionnez le régime douanier</label>
                            <select class="form-control" wire:model="regime" required>
                                <option value="" selected>-- Selectionnez le régime --</option>
                                <option value="TTC">TTC</option>
                                <option value="EXO">EXO</option>
                            </select>
                            @error('regime')<div class="error-message"> {{ $message }} </div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                         <div class="mb-3">
                            <label for="formFile" class="form-label">Selectionnez la facture commerciale (format PDF)</label>
                            <input class="form-control" type="file" accept=".pdf" wire:model="file" required>
                            @error('file')<div class="error-message"> {{ $message }} </div>@enderror
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
        </div>
    </form>
</div>

@script

    <script>
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
        $wire.on('feuille-minute-confirmed', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Feuille minute confirmée avec succès."
                    });
                });
            }).call(this);
        });
    </script>

@endscript
