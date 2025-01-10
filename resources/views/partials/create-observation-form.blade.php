<div class="card form-input-elements">
    <div class="card-header justify-content-between">
        <h3 class="mb-0 card-title"><b>{{$title}} {{$dossier->numero}}</b></h3>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a wire:click="$dispatch('openModal', {component: 'modals.view-dossier', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-outline-primary">Retour au dossier</a>
            <a wire:click="$dispatch('openModal', {component: 'modals.dossier.view-observations', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-outline-primary">Retour aux commentaires</a>
        </div>
    </div>
    <form wire:submit.prevent="create" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="mb-0">
                        <label class="form-label">Commentaire<span class="required">*</span></label>
                        <textarea  required wire:model='observation' class="form-control" name="example-textarea-input" rows="2" placeholder="Votre commentaire..."></textarea>
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
