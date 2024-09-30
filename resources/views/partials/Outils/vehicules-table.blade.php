<div class="table-responsive">
    <table class="table table-bordered border text-nowrap mb-0">
        <thead>
            <tr>
                <th class="wd-15p border-bottom-0" style="max-width: 10px"><b></b></th>
                <th class="wd-15p border-bottom-0"><b>Immatriculation</b></th>
                <th class="wd-15p border-bottom-0"><b>Action</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicules as $vehicule)
                <tr wire:key='{{$vehicule->id}}'>
                    <td style="max-width: 10px">{{$loop->iteration}}</td>
                    <td> @if ($edit==true && $editId == $vehicule->id)
                        <input wire:model='immatriculation' type="text" class="form-control" name="nom" placeholder="Immatriculation du vehicule">
                    @else
                        {{$vehicule->immatriculation}}
                    @endif</td>
                    <td name="bstable-actions">
                        <div class="btn-list">
                            @if ($edit==true && $editId == $vehicule->id)
                                <button wire:click='update({{$vehicule->id}})' href="javascript:void(0);" class="btn btn-sm btn-primary">
                                    <span class="fe fe-check"> </span>
                                </button>
                                <button wire:click='setEdit({{$vehicule->id}})' type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-x"> </span>
                                </button>
                            @else
                                <button wire:click='setEdit({{$vehicule->id}})' type="button" class="btn btn-sm btn-primary">
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
        {{$vehicules->links()}}
    </div>
</div>