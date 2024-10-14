<?php

namespace App\Livewire\Modals\BonDeCaisse;

use App\Models\BonDeCaisse;
use LivewireUI\Modal\ModalComponent;

class ViewBon extends ModalComponent
{
    public BonDeCaisse $bon;

    public function render()
    {

        return view('livewire.modals.bon-de-caisse.view-bon', ['bon'=>$this->bon]);
    }
}
