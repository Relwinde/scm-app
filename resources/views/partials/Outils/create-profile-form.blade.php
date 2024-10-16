<form wire:submit.prevent="create" >
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>{{$title}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nom<span class="required">*</span></label>
                        <input required wire:model='name' type="text" class="form-control" placeholder="Nom du profile">
                    </div>
                </div>
                <div class="col-md-12 ">
                    {{-- <div class="mb-0">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="example-textarea-input" rows="4" placeholder="text here.."></textarea>
                    </div> --}}
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