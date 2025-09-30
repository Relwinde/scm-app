<div class="col-sm-12 col-md-12">
    <div class="card">
        <div class="card-header justify-content-between">
            <h3 class="card-title"> <b>Documents du dossier {{$dossier->numero}}</b></h3>

            <a wire:click="$dispatch('openModal', {component: 'modals.view-dossier', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-outline-primary">Retour</a>

        </div>
        <div class="card-body">
            <div class="example list-group-custom-content">
                <div class="list-group">
                    @foreach ($documents as $document)
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><a href="{{ route('dossiers.files.download', $document) }}" target="_blank" class="mb-1"><i class="fa fa-file-pdf-o" style="font-size:24px;color:red"></i> </a>{{$document->type}}</h5>
                            <small class="text-muted">{{$document->created_at->locale(app()->getLocale())->translatedFormat('j F Y à H:i:s')}}</small>  
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
