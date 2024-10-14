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
                        <label class="form-label">Montant</label>
                        <input wire:focusout='reformat_montant()' required wire:model='montant' type="text" class="form-control"  placeholder="Montant">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Dépense engagée</label>
                        <input required wire:model='depense' type="text" class="form-control"  placeholder="Dépense engagée">
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