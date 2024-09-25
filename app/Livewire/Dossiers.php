<?php

namespace App\Livewire;
use App\Models\Dossier;

use Livewire\Component;

class Dossiers extends Component
{
    public function render()
    {

        $dossiers = Dossier::where('num_commande', 'like', "%{$this->search}%")
            ->orderBy('date_chargement', 'ASC') 
            ->paginate(20, '*', 'dossier-pagination');

        return view('livewire.dossiers', [
            'dossiers' => $dossiers
        ]);
    }
}
