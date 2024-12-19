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
        $dossiers = Dossier::select(['dossiers.id', 'dossiers.numero', 'dossiers.num_lta_bl', 'dossiers.num_sylvie', 'dossiers.num_commande', 'dossiers.created_at', 'dossiers.num_declaration', 'dossiers.client_id', 'dossiers.fournisseur'])
            ->join('clients', 'dossiers.client_id', '=', 'clients.id')
            ->join('numero_dossiers', 'dossiers.id', '=', 'numero_dossiers.dossier_id') 
            ->where('dossiers.type', 'EXPORT') 
            ->where(function ($query) {
                $query->where('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.num_facture', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.num_commande', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.num_sylvie', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.num_lta_bl', 'like', "%{$this->search}%")
                    ->orWhere('clients.nom', 'like', "%{$this->search}%")
                    ->orWhere('numero_dossiers.numero', 'like', "%{$this->search}%");
            })
            ->orderBy('dossiers.created_at', 'DESC')
            ->groupBy('numero')
            ->paginate(10, '*', 'dossier-pagination');


        return view('livewire.dossiers-export', [
            'dossiers' => $dossiers, 'header_title'=>'Dossiers d\'exportation', 'create_modal'=>'modals.create-dossier-export', 'button_title'=>'Nouveau dossier'
        ]);
    }

    public function delete (Dossier $dossier){

        $bons_dossier = $dossier->bon_de_caisse()->where('deleted_at', NULL)->count();
        if ($bons_dossier > 0){
            $this->dispatch('dossier-delete-error');
        } else {
            $dossier->delete();
            $this->dispatch('dossier-delete-success');
        }
    }
}
