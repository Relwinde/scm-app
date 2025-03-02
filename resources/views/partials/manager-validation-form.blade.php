<form wire:submit.prevent="validateBon" wire:confirm="Souhaitez vous vraiment raméner le bon à l'étape suivante?">
    <div class="card form-input-elements">
        <div class="card-header justify-content-between">
            <h3 class="mb-0 card-title"><b>Envoi du bon de caisse au RAF</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="mb-0">
                        <label class="form-label">Commentaires<span class="required">*</span></label>
                        <textarea  required wire:model='commentaire' class="form-control" name="example-textarea-input" rows="3" placeholder="Votre commentaire..."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-list">
                <button class="btn btn-warning">Envoyer au RAF</button>
                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-primary">Annuler</a>
            </div>
        </div>
    </div>
</form>


@script
    <script>
        $wire.on('next-step', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le bon a été renvoyé à l'étape suivante"
                    });
                });
            }).call(this);
        });
    </script>
@endscript