<div class="card form-input-elements">
    <div class="card-header justify-content-between">
        <h3 class="mb-0 card-title"><b>Ajoutez un commentaire</b></h3>
    </div>
    <form wire:submit.prevent="create" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="mb-0">
                        <label class="form-label">Commentaire<span class="required">*</span></label>
                        <textarea  required wire:model='commentaire' class="form-control" name="example-textarea-input" rows="2" placeholder="Votre commentaire..."></textarea>
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
    </form>
    </div>
