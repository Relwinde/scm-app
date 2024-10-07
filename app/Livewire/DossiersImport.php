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
        $dossiers = Dossier::select(['dossiers.id', 'dossiers.numero', 'dossiers.num_lta', 'dossiers.num_sylvie', 'dossiers.num_commande', 'dossiers.created_at', 'dossiers.num_declaration', 'dossiers.client_id', 'dossiers.fournisseur'])
            ->join('clients', 'dossiers.client_id', '=', 'clients.id') 
            ->where('dossiers.type', 'IMPORT') 
            ->where(function ($query) {
                $query->where('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.num_facture', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.num_commande', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.num_sylvie', 'like', "%{$this->search}%")
                    ->orWhere('clients.nom', 'like', "%{$this->search}%");
            })
            ->orderBy('dossiers.created_at', 'DESC')
            ->paginate(10, '*', 'dossier-pagination');


        return view('livewire.dossiers-import', [
            'dossiers' => $dossiers, 'header_title'=>'Dossiers d\'importation', 'create_modal'=>'modals.create-dossier-import', 'button_title'=>'Nouveau dossier'
        ]);
    }

}
