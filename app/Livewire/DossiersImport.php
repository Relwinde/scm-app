<?php

namespace App\Livewire;

use App\Models\Dossier;
use Livewire\Component;
use Livewire\Attributes\On;

class DossiersImport extends Component
{

    public $search;

    #[On('new-dossier')]
    public function render()
    {
        $dossiers = Dossier::where('numero', 'like', "%{$this->search}%")
        ->where('num_facture', 'like', "%{$this->search}%")
        ->where('num_commande', 'like', "%{$this->search}%")
        ->where('type', '=', "IMPORT")
        ->orderBy('created_at', 'DESC')
        ->paginate(20, '*', 'dossier-pagination');
        return view('livewire.dossiers-import', [
            'dossiers' => $dossiers, 'header_title'=>'Dossiers d\'importation', 'create_modal'=>'modals.create-dossier-import'
        ]);
    }

}