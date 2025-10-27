<form wire:submit.prevent="printDeliverySlip">
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>Bordereau de livraison du dossier : {{$dossier->numero}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label">Date<span class="required">*</span></label>
                        <input required wire:model='date' class="form-control" placeholder="Date" type="date" style="max-width: 200px;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nom<span class="required">*</span></label>
                        <input required wire:model='first_name' type="text" class="form-control"  placeholder="Nom de l'agent livreur">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Prénom (s)<span class="required">*</span></label>
                        <input required wire:model='last_name' type="text" class="form-control"  placeholder="Prénom(s) de l'agent livreur">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 ">
                    <div class="mb-4">
                        <label class="form-label">Observations</label>
                        <textarea wire:model='observation' class="form-control" rows="3" placeholder="Vos observation ici.."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-list">
                <button href="javascript:void(0);" class="btn btn-primary">Enregistrer et imprimer</button>
                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
            </div>
        </div>
    </div>
</form>

