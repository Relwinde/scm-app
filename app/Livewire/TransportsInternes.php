<?php

namespace App\Livewire;

use App\Models\Dossier;
use Livewire\Component;

class TransportsInternes extends Component
{
    public $search;
    public function render()
    {
        $dossiers = Dossier::where('numero', 'like', "%{$this->search}%")
        ->where('type', '=', "INTERN")
        ->orderBy('created_at', 'ASC')
        ->paginate(20, '*', 'dossier-pagination');
        return view('livewire.transports-internes', [
            'dossiers' => $dossiers
        ]);
    }
}
