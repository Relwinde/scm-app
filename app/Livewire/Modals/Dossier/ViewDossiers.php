<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DossierStatus;
use App\Models\TransportInterne;
use App\Models\TransportStatus;
use LivewireUI\Modal\ModalComponent;

class ViewDossiers extends ModalComponent
{
    public DossierStatus $statut;
    public $search = '';

    public $name;

    use WithPagination;


    public function render()
    {
        $transports = null;

        $dossiers = Dossier::select(['dossiers.id','dossiers.numero','dossiers.dossier_status_id','dossiers.created_at', 'dossiers.client_id', 'dossiers.num_lta_bl', 'dossiers.num_sylvie', 'dossiers.num_commande', 'dossiers.num_declaration'])
        ->join('clients', 'dossiers.client_id', '=', 'clients.id') 
        ->join('numero_dossiers', 'dossiers.id', '=', 'numero_dossiers.dossier_id') 
        ->where('dossier_status_id', $this->statut->id)
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

        if ($this->statut->code == 'fm_prov'){
            $this->name = 'ayant des feuilles minutes à valider';
        }elseif ($this->statut->code == 'fm_def'){
            $this->name = 'à enregistrer et déposer en douane';
        } elseif ($this->statut->code == 'di_dep'){
            $this->name = "en attente de la reponse à la demande d'exonération";
        } elseif ($this->statut->code == 'bae'){
            $this->name = 'en attente de livraison';

            $transports = TransportInterne::select(['transport_internes.id', 'transport_internes.numero', 'transport_internes.client_id', 'transport_internes.created_at', 'transport_status_id'])
            ->leftjoin('clients', 'transport_internes.client_id', '=', 'clients.id') 
            ->leftjoin('vehicules', 'transport_internes.vehicule_id', '=', 'vehicules.id') 
            ->leftjoin('chauffeurs', 'transport_internes.chauffeur_id', '=', 'chauffeurs.id') 
            ->leftjoin('numero_transports', 'transport_internes.id', '=', 'numero_transports.transport_interne_id') 
            ->where('transport_status_id', TransportStatus::where('code', 'ecl')->first()->id)
            ->where(function ($query){
                $query->where('transport_internes.numero', 'like', "%{$this->search}%")
                ->orWhere('clients.nom', 'like', "%{$this->search}%")
                ->orWhere('chauffeurs.nom', 'like', "%{$this->search}%")
                ->orWhere('vehicules.immatriculation', 'like', "%{$this->search}%")
                ->orWhere('numero_transports.numero', 'like', "%{$this->search}%");

            })

            ->orderBy('created_at', 'DESC')
            ->groupBy('numero')
            ->paginate(10, '*', 'trasports-pagination');
            
        }

        

        return view('livewire.modals.dossier.view-dossiers', ['dossiers'=>$dossiers, 'transports'=>$transports]);
    }
}
