<form wire:submit.prevent="update">
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title">Modification du bon N° <b>{{$bon->numero}}</b></h3> &nbsp;&nbsp;
            <h3 class="mb-0 card-title">Sur dossier <b>{{$bon->dossier->numero ?? $bon->transport->numero ?? "AUTRES"}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Montant<span class="required">*</span></label>
                        <input wire:focusout='reformat_montant()' required wire:model='montant' type="text" class="form-control"  placeholder="Montant">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Dépense engagée<span class="required">*</span></label>
                        <input required wire:model='depense' type="text" class="form-control"  placeholder="Dépense engagée">
                    </div>
                </div>
                @if ($bon->user->id = Auth::user()->id)
                    <div class="col-md-12 ">
                        <div class="mb-0">
                            <label class="form-label">Commentaire</label>
                            <textarea wire:model='description' class="form-control" rows="2" placeholder="Votre commentaire ici.."></textarea>
                        </div>
                    </div>
                @endif
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
                        message: "Le bon de caisse a été modifié"
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