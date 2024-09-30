<?php

namespace App\Livewire;

use App\Models\Dossier;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class DossiersImport extends Component
{

    public $search;

    use WithPagination;

    #[On('new-dossier')]
    public function render()
    {
        $dossiers = Dossier::select(['numero', 'num_lta', 'num_sylvie', 'num_commande', 'created_at', 'num_declaration'])
            ->where('type', '=', "IMPORT")
            ->where('numero', 'like', "%{$this->search}%")
            ->where('num_facture', 'like', "%{$this->search}%")
            ->where('num_commande', 'like', "%{$this->search}%")
            ->where('num_sylvie', 'like', "%{$this->search}%")
            ->orderBy('created_at', 'DESC')
            ->paginate(10, '*', 'dossier-pagination');

        return view('livewire.dossiers-import', [
            'dossiers' => $dossiers, 'header_title'=>'Dossiers d\'importation', 'create_modal'=>'modals.create-dossier-import'
        ]);
    }

}
