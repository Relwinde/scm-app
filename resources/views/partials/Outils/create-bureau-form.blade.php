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
                        <input required wire:model='nom' type="text" class="form-control" name="nom" placeholder="Nom du bureau de douane">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Code<span class="required">*</span></label>
                        <input required wire:model='code' type="text" class="form-control" name="code" placeholder="Code du bureau de douane">
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

@script
    <script>
        $wire.on('new-bureau-de-douane', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le bureau de douane a été ajouté"
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