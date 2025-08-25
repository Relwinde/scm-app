<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use LivewireUI\Modal\ModalComponent;

class FeuilleMinute extends ModalComponent
{

    public Dossier $dossier;

    public function render()
    {
        return view('livewire.modals.dossier.feuille-minute');
    }
}
