<div class="col-sm-12 col-md-12">
    <div class="card">
        <div class="card-header justify-content-between">
            <h3 class="card-title"> <b>Documents du dossier {{$dossier->numero}}</b></h3>

            <a wire:click="$dispatch('openModal', {component: 'modals.view-dossier', arguments: { dossier : {{ $dossier->id }} }})" href="javascript:void(0);" class="btn btn-outline-primary">Retour</a>

        </div>
        <div class="card-body">
            <div class="example list-group-custom-content">
                <div class="list-group">
                    <div class="">
                        <div class="row">
                            @foreach ($documents as $document)
                                <div class="border-0 p-0 mb-4 pt-4">
                                    <div class="media mt-0 border br-7">
                                        <div class="ps-0 me-3"><i class="fa fa-file-pdf-o shared-files"></i></div>
                                        <div class="media-body">
                                            <div class="d-flex align-items-center">
                                                <div class="mt-0">
                                                    <a href="{{ route('dossiers.files.download', $document) }}" target="_blank">
                                                        <h1 class="mb-1 fs-13 fw-semibold text-dark"> {{$document->type}}</h1>
                                                    </a>
                                                    <p class="mb-0 fs-13 text-muted d-inline-flex lh-0">{{$document->created_at->locale(app()->getLocale())->translatedFormat('j F Y à H:i:s')}}<span class="fs-11 ms-2">{{$document->size}}</span></p>
                                                </div>
                                                <span class="ms-auto fs-14">
                                                    <span class="float-end">
                                                        <a href="{{ route('dossiers.files.download', $document) }}" target="_blank">
                                                            <span class="op-7 text-muted"><i class="fe fe-download"></i></span>
                                                        </a>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

