<?php

namespace App\Livewire;
use App\Models\Dossier;

use Livewire\Component;

class Dossiers extends Component
{
    public function render()
    {

        $dossiers = Dossier::where('numero', 'like', "%{$this->search}%")
            ->where('type', '=', "")
            ->orderBy('created_at', 'ASC')
            ->paginate(20, '*', 'dossier-pagination');

        return view('livewire.dossiers', [
            'dossiers' => $dossiers
        ]);
    }
}
