<form wire:submit.prevent="create" >
    <div class="card form-input-elements">
        <div class="card-header justify-content-between">
            <h3 class="mb-0 card-title"><b>{{$title}} {{$dossier->numero}}</b></h3>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a wire:click="$dispatch('openModal', {component: 'modals.view-transport-interne', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-outline-primary">Retour au dossier</a>
                {{-- <a wire:click="$dispatch('openModal', {component: 'modals.dossier.view-observations', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-outline-primary">Retour aux commentaires</a> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="mb-4">
                        <label class="form-label">Lieu de départ</label>
                        <select wire:model='depart' name="destination" class="form-control custom-select select2">
                            <option value="" >Sélectionnez un client</option>
                            @foreach ($destinations as $destination)
                                <option value="{{$destination->id}}" >{{$destination->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="mb-4">
                        <label class="form-label">Lieu d'arrivée</label>
                        <select wire:model='arrivee' name="destination" class="form-control custom-select select2">
                            <option value="" >Sélectionnez un client</option>
                            @foreach ($destinations as $destination)
                                <option value="{{$destination->id}}" >{{$destination->nom}}</option>
                            @endforeach
                        </select>
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
