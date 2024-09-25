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
                    <th class="wd-15p border-bottom-0">Numéro</th>
                    <th class="wd-15p border-bottom-0">Client</th>
                    <th class="wd-20p border-bottom-0">Fournisseur</th>
                    <th class="wd-15p border-bottom-0">Date de création</th>
                    <th class="wd-10p border-bottom-0">Numéro de déclaration</th>
                    <th class="wd-25p border-bottom-0">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dossiers as $dossier)
                    <tr>
                        <td>{{$dossier->numero}}</td>
                        <td>{{$dossier->client->nom}}</td>
                        <td>{{$dossier->fournisseur->nom}}</td>
                        <td>{{$dossier->created_at}}</td>
                        <td>{{$dossier->num_declaration}}</td>
                        <td>b.Chloe@datatables.net</td>
                        <td name="bstable-actions">
                            <div class="btn-list">
                                <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button>
                                <button id="bDel" type="button" class="btn  btn-sm btn-danger">
                                    <span class="fe fe-trash-2"> </span>
                                </button>
                                <button id="bAcep" type="button" class="btn  btn-sm btn-primary">
                                    <span class="fe fe-check-circle"> </span>
                                </button>
                                <button id="bCanc" type="button" class="btn  btn-sm btn-danger">
                                    <span class="fe fe-x-circle"> </span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

