<?php

namespace App\Livewire\Modals\Depot;

use App\Models\Depot;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ViewDepot extends ModalComponent
{

    public Depot $depot;

    public function render()
    {
        return view('livewire.modals.depot.view-depot');
    }
}
