<div>
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>Feuille minute du dossier {{$dossier->numero}}</b></h3>
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
                        <label class="form-label">Intitulé de la dépense<span class="required">*</span></label>
                        <input required wire:model='depense' type="text" class="form-control"  placeholder="Dépense engagée">
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="mb-0">
                        <label class="form-label">Commentaire</label>
                        <textarea wire:model='description' class="form-control" rows="2" placeholder="Votre commentaire ici.."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-list">
                <button href="javascript:void(0);" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button>
                <button href="javascript:void(0);" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Enregistrer et imprimer</button>
                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
            </div>
        </div>
    </div>
</div>