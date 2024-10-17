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
                        <input required wire:model='nom' type="text" class="form-control" name="example-text-input" placeholder="Nom du client">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Code client<span class="required">*</span></label>
                        <input required wire:model='code' type="text" class="form-control" name="example-text-input" placeholder="Code du client">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Téléphone</label>
                        <input wire:model='telephone' type="text" class="form-control" name="example-text-input" placeholder="N° de téléphone du client">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input wire:model='email' type="email" class="form-control" name="example-text-input" placeholder="Adresse électronique du client">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">N° IFU</label>
                        <input wire:model='ifu' type="text" class="form-control" name="example-text-input" placeholder="N° IFU du client">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° RCCM</label>
                        <input wire:model='rccm' type="text" class="form-control" name="example-text-input" placeholder="N° RCCM du client">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Adresse</label>
                        <textarea wire:model='adresse' class="form-control" name="example-textarea-input" rows="4" placeholder="Adresse du client"></textarea>
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
        $wire.on('new-client', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le client a été ajouté"
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

