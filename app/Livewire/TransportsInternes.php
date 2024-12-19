<?php

namespace App\Livewire;

use App\Models\Dossier;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\TransportInterne;

class TransportsInternes extends Component
{
    public $search;

    use WithPagination;

    #[On('new-dossier')]
    public function render()
    {
        $dossiers = TransportInterne::select(['transport_internes.id', 'transport_internes.numero', 'transport_internes.client_id', 'transport_internes.chauffeur_id', 'transport_internes.vehicule_id', 'transport_internes.created_at'])
            ->leftjoin('clients', 'transport_internes.client_id', '=', 'clients.id') 
            ->leftjoin('vehicules', 'transport_internes.vehicule_id', '=', 'vehicules.id') 
            ->leftjoin('chauffeurs', 'transport_internes.chauffeur_id', '=', 'chauffeurs.id') 
            ->leftjoin('numero_transports', 'transport_internes.id', '=', 'numero_transports.transport_interne_id') 
            ->where(function ($query){
                $query->where('transport_internes.numero', 'like', "%{$this->search}%")
                ->orWhere('clients.nom', 'like', "%{$this->search}%")
                ->orWhere('chauffeurs.nom', 'like', "%{$this->search}%")
                ->orWhere('vehicules.immatriculation', 'like', "%{$this->search}%")
                ->orWhere('numero_transports.numero', 'like', "%{$this->search}%");

            })
            ->orderBy('created_at', 'DESC')
            ->groupBy('numero')
            ->paginate(20, '*', 'dossier-pagination');

            return view('livewire.transports-internes', [
                'dossiers' => $dossiers, 'header_title'=>'Dossiers de transports internes', 'create_modal'=>'modals.create-transport-interne', 'button_title'=>'Nouveau dossier'
            ]);
    }

    public function delete (TransportInterne $dossier){

        $bons_dossier = $dossier->bon_de_caisse()->where('deleted_at', NULL)->count();
        if ($bons_dossier > 0){
            $this->dispatch('dossier-delete-error');
        } else {
            $dossier->delete();
            $this->dispatch('dossier-delete-success');
        }
    }
}
