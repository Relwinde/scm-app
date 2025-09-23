<div>
    <form wire:submit.prevent="save">
        <div class="card form-input-elements">
            <div class="card-header justify-content-between">
                <h3 class="mb-0 card-title"><b>Confirmation de la feuille minute du dossier {{ $dossier->numero }}</b></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Selectionnez la facture commerciale</label>
                            <input class="form-control" type="file" accept=".pdf" wire:model="file">
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
