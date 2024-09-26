<?php

namespace App\Livewire;

use App\Models\Dossier;
use Livewire\Component;
use Livewire\Attributes\On;

class DossiersExport extends Component
{
    public $search;

    #[On('new-dossier')]
    public function render()
    {
        $dossiers = Dossier::where('numero', 'like', "%{$this->search}%")
        ->where('type', '=', "EXPORT")
        ->orderBy('created_at', 'DESC')
        ->paginate(20, '*', 'dossier-pagination');
        return view('livewire.dossiers-export', [
            'dossiers' => $dossiers
        ]);
    }
}
