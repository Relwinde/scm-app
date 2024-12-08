<div class="table-responsive">
    <table class="table table-striped table-bordered border text-nowrap mb-0">
        <thead>
            <tr style="font-weight:700;">
                <th class="wd-15p border-bottom-0" style="max-width: 10px"><b></b></th>
                <th class="wd-15p border-bottom-0"><b>Nom</b></th>
                <th class="wd-15p border-bottom-0"><b>Téléphone</b></th>
                <th class="wd-15p border-bottom-0"><b>Email</b></th>
                <th class="wd-15p border-bottom-0"><b>Adresse</b></th>
                <th class="wd-15p border-bottom-0"><b>Actions</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fournisseurs as $fournisseur)
                <tr style="font-weight:600;" wire:key='{{$fournisseur->id}}'>
                    <td style="max-width: 10px">{{$loop->iteration}}</td>
                    <td> @if ($edit==true && $editId == $fournisseur->id)
                        <input wire:model='nom' type="text" class="form-control" name="nom" placeholder="Nom du fournisseur">
                    @else
                        {{$fournisseur->nom}}
                    @endif</td>
                    <td> @if ($edit==true && $editId == $fournisseur->id)
                        <input wire:model='telephone' type="text" class="form-control" name="telephone" placeholder="N° de téléphone du fournisseur">
                    @else
                        {{$fournisseur->telephone}}
                    @endif</td>
                    <td> @if ($edit==true && $editId == $fournisseur->id)
                        <input wire:model='email' type="text" class="form-control" name="email" placeholder="Adresse électronique du fournisseur">
                    @else
                        {{$fournisseur->email}}
                    @endif</td>
                    <td> @if ($edit==true && $editId == $fournisseur->id)
                        <input wire:model='adresse' type="text" class="form-control" name="adresse" placeholder="Adresse du fournisseur">
                    @else
                        {{$fournisseur->adresse}}
                    @endif</td>
                    <td name="bstable-actions">
                        <div class="btn-list">
                            @if ($edit==true && $editId == $fournisseur->id)
                                <button wire:click='update({{$fournisseur->id}})' href="javascript:void(0);" class="btn btn-sm btn-primary">
                                    <span class="fe fe-check"> </span>
                                </button>
                                <button wire:click='setEdit({{$fournisseur->id}})' type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-x"> </span>
                                </button>
                            @else
                                <button wire:click='setEdit({{$fournisseur->id}})' type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button>
                            @endif
                            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{$fournisseurs->links()}}
    </div>
</div>