<div>
    <div class="table-responsive">
        <table class="table table-bordered border text-nowrap mb-0">
            <thead>
                {{-- <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Position</th>
                    <th>Start date</th>
                    <th>Salary</th>
                    <th>E-mail</th>
                    <th>Actions</th>
                </tr> --}}
                <tr>
                    <th class="wd-15p border-bottom-0"><b>Numéro</b></th>
                    <th class="wd-15p border-bottom-0"><b>Client</b></th>
                    <th class="wd-20p border-bottom-0"><b>Fournisseur</b></th>
                    <th class="wd-20p border-bottom-0"><b>N° LTA</b></th>
                    <th class="wd-20p border-bottom-0"><b>N° DPI</b></th>
                    <th class="wd-20p border-bottom-0"><b>N° de commande</b></th>
                    <th class="wd-15p border-bottom-0"><b>Date de création</b></th>
                    <th class="wd-10p border-bottom-0"><b>N° de déclaration</b></th>
                    <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dossiers as $dossier)
                    <tr>
                        <td>{{$dossier->numero}}</td>
                        <td>{{$dossier->client->nom}}</td>
                        <td>{{$dossier->fournisseur->nom}}</td>
                        <td>{{$dossier->num_lta}}</td>
                        <td>{{$dossier->num_dpi}}</td>
                        <td>{{$dossier->num_commande}}</td>
                        <td>{{$dossier->created_at}}</td>
                        <td>{{$dossier->num_declaration}}</td>
                        <td name="bstable-actions">
                            <div class="btn-list">
                                <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button>
                                <button wire:click="$dispatch('openModal', {component: 'modals.view-dossier', arguments: { dossier : {{ $dossier->id }} }})" id="bAcep" type="button" class="btn  btn-sm btn-primary">
                                    <span class="fe fe-eye"> </span>
                                </button>
                                <button id="bDel" type="button" class="btn  btn-sm btn-danger">
                                    <span class="fe fe-trash-2"> </span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
