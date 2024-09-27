<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use Livewire\Component;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\TransportInterne;
use LivewireUI\Modal\ModalComponent;


class ViewTransportInterne extends ModalComponent
{

    public TransportInterne $dossier;
    public $client;
    public $vehicule;
    public $chauffeur;
    public $montant;

    public function render()
    {
        $clients = Client::all(['id', 'nom']);
        $chauffeurs = Chauffeur::all(['id', 'nom']);
        $vehicules = Vehicule::all(['id', 'immatriculation']);

        $this->client = $this->dossier->client_id;
        $this->vehicule = $this->dossier->vehicule_id;
        $this->chauffeur = $this->dossier->chauffeur_id;
        $this->montant = $this->dossier->montant;

        return view('livewire.modals.view-transport-interne',["clients"=>$clients, "chauffeurs"=>$chauffeurs, "vehicules"=>$vehicules, "title"=>"de transport interne"]);
    }
}
