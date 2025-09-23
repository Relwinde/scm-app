<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use Livewire\Component;

class ConfirmFeuilleMinute extends Component
{

    public Dossier $dossier;

    public function render()
    {
        return view('livewire.modals.dossier.confirm-feuille-minute');
    }

    public function confirm()
    {
        // Logic to confirm the action
        $this->dispatch('closeModal');
        $this->dispatch('feuilleMinuteConfirmed');
    }
}
