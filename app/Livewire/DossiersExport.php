<?php

namespace App\Livewire;

use App\Models\Dossier;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class DossiersExport extends Component
{
    public $search;

    use WithPagination;

    #[On('new-dossier')]
    public function render()
    {
        $dossiers = Dossier::select(['numero', 'num_lta', 'num_sylvie', 'num_commade', 'created_at', 'num_declaration'])
            ->where('type', '=', "EXPORT")
            ->where('numero', 'like', "%{$this->search}%")
            ->where('num_facture', 'like', "%{$this->search}%")
            ->where('num_commande', 'like', "%{$this->search}%")
            ->where('num_sylvie', 'like', "%{$this->search}%")
            ->orderBy('created_at', 'DESC')
            ->paginate(20, '*', 'dossier-pagination');

        return view('livewire.dossiers-export', [
            'dossiers' => $dossiers, 'header_title'=>'Dossiers d\'exportation', 'create_modal'=>'modals.create-dossier-export', 'button_title'=>'Nouveau dossier'
        ]);
    }
}
