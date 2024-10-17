@if ($edit==true)
<form wire:submit.prevent="update" >
@endif
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>Détail du client {{$client->nom}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nom</label>
                        <input required wire:model='nom' type="text" class="form-control " @if ($edit==false) readonly @endif  name="nom">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Code client</label>
                        <input required wire:model='code' type="text" class="form-control " @if ($edit==false) readonly @endif  name="code">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Téléphone</label>
                        <input wire:model='telephone' type="text" class="form-control " @if ($edit==false) readonly @endif  name="telephone">
                        
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input wire:model='email' type="text" class="form-control " @if ($edit==false) readonly @endif  name="email">
                        
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Adresse</label>
                        <textarea @if ($edit==false) readonly @endif wire:model='adresse' class="form-control" name="adresse" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">N° IFU</label>
                        <input wire:model='ifu' type="text" class="form-control " @if($edit==false) readonly @endif name="ifu">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° RCCM</label>
                        <input wire:model='rccm' type="text" class="form-control " @if ($edit==false) readonly @endif name="rccm">
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
            @if ($edit==true)
                <div class="btn-list">
                    @can('Modifier client')                     
                        <button type="submit" href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>
                    @endcan
                    <a href="javascript:void(0);" wire:click='setEdit' class="btn btn-danger">Annuler</a>
                </div>
            @else
                <div class="btn-list">
                    @can('Modifier client')      
                        <button wire:click='setEdit' href="javascript:void(0);" class="btn btn-primary">Modifier</button>
                    @endcan
                    <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
                </div>
            @endif
        </div>
    </div>
@if ($edit==true)
</form>
@endif

@script
    <script>
        $wire.on('new-client', () => {
            (function () {
                $(function () {
                    return $.growl.notice({
                        message: "Les informations du client ont été mises à jour"
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

