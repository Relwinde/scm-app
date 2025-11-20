<form wire:submit.prevent="save">
    <div class="card form-input-elements">
        <div class="card-header justify-content-between">
            <h3 class="mb-0 card-title"><b>Nouveau fichier joint</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Selectionner la pièce</label>
                        <input class="form-control" type="file" accept=".pdf" wire:model="file">
                        @error('file')<div class="error-message"> {{ $message !="validation.uploaded" ? $message : '' }} </div>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-list">
                <button class="btn btn-primary" wire:loading.class="disabled" wire:target="file" >Enregistrer</button>
                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
            </div>
        </div>
    </div>
</form>


@script
    <script>
        $wire.on('new-attachment', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Nouvelle pièce ajoutée avec succès."
                    });
                });
            }).call(this);
        });
    </script>
@endscript