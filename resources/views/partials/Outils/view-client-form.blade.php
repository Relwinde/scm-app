@if ($edit==true)
<form wire:submit.prevent="update" >
@endif
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>Détail du client</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nom</label>
                        <input wire:model='nom' type="text" class="form-control " @if ($edit==false) readonly @endif  name="nom" placeholder="Nom du client">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Téléphone</label>
                        <input wire:model='telephone' type="text" class="form-control " @if ($edit==false) readonly @endif  name="telephone" placeholder="N° de téléphone du client">
                        
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input wire:model='email' type="text" class="form-control " @if ($edit==false) readonly @endif  name="email" placeholder="Adresse électronique du client">
                        
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Adresse</label>
                        <textarea @if ($edit==false) readonly @endif wire:model='adresse' class="form-control" name="adresse" rows="4" placeholder="Adresse du client"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">N° IFU</label>
                        <input wire:model='ifu' type="text" class="form-control " @if($edit==false) readonly @endif name="ifu" placeholder="N° IFU du client">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° RCCM</label>
                        <input wire:model='rccm' type="text" class="form-control " @if ($edit==false) readonly @endif name="rccm" placeholder="N° RCCM du client">
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
                    <button type="submit" href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>
                    <a href="javascript:void(0);" wire:click='setEdit' class="btn btn-danger">Annuler</a>
                </div>
            @else
                <div class="btn-list">
                    <button wire:click='setEdit' href="javascript:void(0);" class="btn btn-primary">Modifier</button>
                    <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
                </div>
            @endif
        </div>
    </div>
@if ($edit==true)
</form>
@endif


