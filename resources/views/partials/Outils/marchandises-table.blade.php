<div class="table-responsive">
    <table class="table table-striped table-bordered border text-nowrap mb-0">
        <thead>
            <tr style="font-weight:700;">
                <th class="wd-15p border-bottom-0" style="max-width: 10px"><b></b></th>
                <th class="wd-15p border-bottom-0"><b>Nom</b></th>
                <th class="wd-15p border-bottom-0"><b>Action</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marchandises as $marchandise)
                <tr style="font-weight:600;" wire:key='{{$marchandise->id}}'>
                    <td style="max-width: 10px">{{$loop->iteration}}</td>
                    <td> @if ($edit==true && $editId == $marchandise->id)
                        <input wire:model='nom' type="text" class="form-control" name="nom" placeholder="nom du marchandise">
                    @else
                        {{$marchandise->nom}}
                    @endif</td>
                    <td name="bstable-actions">
                        <div class="btn-list">
                            @if ($edit==true && $editId == $marchandise->id)
                                <button wire:click='update({{$marchandise->id}})' href="javascript:void(0);" class="btn btn-sm btn-primary">
                                    <span class="fe fe-check"> </span>
                                </button>
                                <button wire:click='setEdit({{$marchandise->id}})' type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-x"> </span>
                                </button>
                            @else
                                <button wire:click='setEdit({{$marchandise->id}})' type="button" class="btn btn-sm btn-primary">
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
        {{$marchandises->links()}}
    </div>
</div>