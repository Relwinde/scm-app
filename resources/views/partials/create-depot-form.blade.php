<form wire:confirm="Êtes vous sûr de vouloir effectuer ce dépôt, cette action iréversible impactera votre caisse" wire:submit.prevent="create">
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>{{$title}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Libellé<span class="required">*</span></label>
                        <input required wire:model='libelle' type="text" class="form-control"  placeholder="Libellé du dépôt">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Montant<span class="required">*</span></label>
                        <input wire:focusout='reformat_montant()' required wire:model='montant' type="text" class="form-control"  placeholder="Montant">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Déposant<span class="required">*</span></label>
                        <input required wire:model='deposant' type="text" class="form-control"  placeholder="Nom du déposant">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Banque de provenance<span class="required">*</span></label>
                        <input required wire:model='banque' type="text" class="form-control"  placeholder="Nom du déposant">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Référence du chèque<span class="required">*</span></label>
                        <input required wire:model='ref_cheque' type="text" class="form-control"  placeholder="Nom du déposant">
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
        $wire.on('new-depot', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Dépôt de caisse effectué"
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