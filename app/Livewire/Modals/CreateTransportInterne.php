<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\TransportInterne;
use LivewireUI\Modal\ModalComponent;

class CreateTransportInterne extends ModalComponent
{
    public $client;
    public $vehicule;
    public $chauffeur;
    public $montant;

    public function render()
    {
        $clients = Client::all(['id', 'nom']);
        $chauffeurs = Chauffeur::all(['id', 'nom']);
        $vehicules = Vehicule::all(['id', 'immatriculation']);

        return view('livewire.modals.create-transport-interne',["clients"=>$clients, "chauffeurs"=>$chauffeurs, "vehicules"=>$vehicules, "title"=>"de transport interne"]);
    }

    public function create(){
        $dossier = TransportInterne::make([
        'numero'=>"NUMERO-TRANS-INTERNE",
        'montant'=>$this->montant,
        'client_id'=>$this->client,
        'vehicule_id'=>$this->vehicule,
        'chauffeur_id'=>$this->chauffeur
        ]);

        if($dossier->save()){
            $this->dispatch('new-dossier');
            request()->session()->flash("success", "Dossier ajouté avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");

        }
    }
}
