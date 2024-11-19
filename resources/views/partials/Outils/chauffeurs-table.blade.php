<div class="table-responsive">
    <table class="table table-bordered table-striped border text-nowrap mb-0">
        <thead>
            <tr style="font-weight:700;">
                <th class="wd-15p border-bottom-0" style="max-width: 10px"><b></b></th>
                <th class="wd-15p border-bottom-0"><b>Nom</b></th>
                <th class="wd-15p border-bottom-0"><b>Contact</b></th>
                <th class="wd-15p border-bottom-0"><b>Actions</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chauffeurs as $chauffeur)
                <tr style="font-weight:600;" wire:key='{{$chauffeur->id}}'>
                    <td style="max-width: 10px">{{$loop->iteration}}</td>
                    <td> @if ($edit==true && $editId == $chauffeur->id)
                        <input wire:model='nom' type="text" class="form-control" name="nom" placeholder="Nom du chauffeur">
                    @else
                        {{$chauffeur->nom}}
                    @endif</td>
                    <td> @if ($edit==true && $editId == $chauffeur->id)
                        <input wire:model='contact' type="text" class="form-control" name="contact" placeholder="Contact du chauffeur">
                    @else
                        {{$chauffeur->contact}}
                    @endif</td>
                    <td name="bstable-actions">
                        <div class="btn-list">
                            @if ($edit==true && $editId == $chauffeur->id)
                                <button wire:click='update({{$chauffeur->id}})' href="javascript:void(0);" class="btn btn-sm btn-primary">
                                    <span class="fe fe-check"> </span>
                                </button>
                                <button wire:click='setEdit({{$chauffeur->id}})' type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-x"> </span>
                                </button>
                            @else
                                <button wire:click='setEdit({{$chauffeur->id}})' type="button" class="btn btn-sm btn-primary">
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
        {{$chauffeurs->links()}}
    </div>
</div>