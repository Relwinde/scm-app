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
        $dossiers = Dossier::select(['id', 'numero', 'num_lta', 'num_sylvie', 'num_commande', 'created_at', 'num_declaration', 'client_id', 'fournisseur'])
        ->where('type', 'IMPORT') // Filtre général
        ->where(function ($query) {
            $query->where('numero', 'like', "%{$this->search}%")
                ->orWhere('num_facture', 'like', "%{$this->search}%")
                ->orWhere('num_commande', 'like', "%{$this->search}%")
                ->orWhere('num_sylvie', 'like', "%{$this->search}%");
        })
        ->orderBy('created_at', 'DESC')
        ->paginate(10, '*', 'dossier-pagination');

        return view('livewire.dossiers-import', [
            'dossiers' => $dossiers, 'header_title'=>'Dossiers d\'importation', 'create_modal'=>'modals.create-dossier-import', 'button_title'=>'Nouveau dossier'
        ]);
    }

}
