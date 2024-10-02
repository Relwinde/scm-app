<div class="col-sm-12 col-md-12">
    <div class="card">
        <div class="card-header justify-content-between">
            <h3 class="card-title"> <b>Commentaires sur le dossier {{$dossier->numero}}</b></h3>

            <a wire:click="$dispatch('openModal', {component: 'modals.view-dossier', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-outline-primary">Retour</a>

        </div>
        <div class="card-body">
            <div class="example list-group-custom-content">
                <div class="list-group">

                    @foreach ($observations as $observation)
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"></h5>
                            <small class="text-muted">{{$observation->created_at}}</small>
                        </div>
                        <p class="mb-1">{!! $observation->content !!}</p>
                        <small class="text-muted">Nom De l'émeteur</small>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>