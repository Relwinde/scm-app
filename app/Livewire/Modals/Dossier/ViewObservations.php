<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use LivewireUI\Modal\ModalComponent;

class ViewObservations extends ModalComponent
{
    public Dossier $dossier;

    public function render()
    {
        $observations = $this->dossier->observations;
        return view('livewire.modals.dossier.view-observations', ['observations'=>$observations]);
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
