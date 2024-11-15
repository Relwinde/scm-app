<form wire:confirm="Êtes vous sûr de vouloir payer ce bon, cette action iréversible impactera votre caisse" wire:submit.prevent="pay">
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>Paiement par chèque du bon N° {{$bon->numero}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Référence du chèque<span class="required">*</span></label>
                        <input required wire:model='reference' type="text" class="form-control"  placeholder="Libellé du dépôt">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Banque<span class="required">*</span></label>
                        <input required wire:model='banque' type="text" class="form-control"  placeholder="Banque de provenance des fonds">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Bénéficiaire<span class="required">*</span></label>
                        <input required wire:model='benef' type="text" class="form-control"  placeholder="Nom du bénéficiaire">
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
        $wire.on('operation-success', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le paiement a été effectué avec succès"
                    });
                });
            }).call(this);
        });
    </script>
@endscript