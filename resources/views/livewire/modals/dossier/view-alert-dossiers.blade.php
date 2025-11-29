<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des dosssier : <b> {{ mb_strtoupper($name, 'UTF-8') }}</b></h3>&nbsp; &nbsp;
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered border text-wrap mb-0" id="bonsDeCaisseTable">
                <thead>
                    <tr style="font-weight:700;">
                        <th class="text-nowrap" style="max-width: 30px;"></th>
                        <th class="wd-15p border-bottom-0 text-nowrap"><b>Numéro</b></th>
                        <th class="wd-15p border-bottom-0 text-nowrap"><b>Client</b></th>
                        <th class="wd-20p border-bottom-0"><b>Créé le</b></th>
                        <th class="wd-25p border-bottom-0"><b>Actions</b></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($dossiers as $dossier)
                        <tr style="font-weight:600;" wire:key='{{$dossier->id}}'>
                            <td></td>
                                <td wire:click="$dispatch('openModal', {component: 'modals.view-dossier', arguments: { dossier : {{ $dossier->id }} }})" style="cursor:pointer;"> <h1>{{$dossier->numero}}
                                </h1> <h6 class="text-primary" style="font-size: 13px;">{{ mb_strtoupper($dossier->status?->name, 'UTF-8') }}</h6>
                            </td>
                            <td>{{$dossier->client->nom}}</td>
                            <td>{{$dossier->created_at->locale(app()->getLocale())->translatedFormat('j F Y') }}</td>
                            <td name="bstable-actions">
                                <div class="btn-list">
                                    <button wire:click="$dispatch('openModal', {component: 'modals.view-dossier', arguments: { dossier : {{ $dossier->id }} }})" type="button" class="btn  btn-sm btn-primary">
                                        <span class="fe fe-eye"> </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{$dossiers->links()}}
            </div>
        </div>
        
        @if ($transports)
            <hr>

            <div class="table-responsive">
                <table class="table table-striped table-bordered border text-wrap mb-0" id="bonsDeCaisseTable">
                    <thead>
                        <tr style="font-weight:700;">
                            <th class="text-nowrap" style="max-width: 30px;"></th>
                            <th class="wd-15p border-bottom-0 text-nowrap"><b>Numéro</b></th>
                            <th class="wd-15p border-bottom-0 text-nowrap"><b>Client</b></th>
                            <th class="wd-20p border-bottom-0"><b>Créé le</b></th>
                            <th class="wd-25p border-bottom-0"><b>Actions</b></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transports as $transport)
                            <tr style="font-weight:600;" wire:key='{{$transport->id}}'>
                                <td></td>
                                    <td wire:click="$dispatch('openModal', {component: 'modals.view-transport-interne', arguments: { dossier : {{ $transport->id }} }})" style="cursor:pointer;"> <h1>{{$transport->numero}}
                                    </h1> <h6 class="text-primary" style="font-size: 13px;">{{ mb_strtoupper($transport->status?->name, 'UTF-8') }}</h6>
                                </td>
                                <td>{{$transport->client->nom}}</td>
                                <td>{{$transport->created_at->locale(app()->getLocale())->translatedFormat('j F Y') }}</td>
                                <td name="bstable-actions">
                                    <div class="btn-list">
                                        <button wire:click="$dispatch('openModal', {component: 'modals.view-transport-interne', arguments: { dossier : {{ $transport->id }} }})" type="button" class="btn  btn-sm btn-primary">
                                            <span class="fe fe-eye"> </span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$transports->links()}}
                </div>
            </div>
            
        @endif
        
    </div>

    <div class="card-footer">
        
    </div>
</div>
