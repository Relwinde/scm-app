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
    public $type_transport;

    public $edit = false;


    public function render()
    {
        $clients = Client::all(['id', 'nom']);
        $chauffeurs = Chauffeur::all(['id', 'nom']);
        $vehicules = Vehicule::all(['id', 'immatriculation']);

        $this->client = $this->dossier->client_id;
        $this->vehicule = $this->dossier->vehicule_id;
        $this->chauffeur = $this->dossier->chauffeur_id;
        $this->montant = $this->dossier->montant;
        $this->type_transport = $this->dossier->type_transport;

        return view('livewire.modals.view-transport-interne',["clients"=>$clients, "chauffeurs"=>$chauffeurs, "vehicules"=>$vehicules, "title"=>"de transport interne"]);
    }

    public function setEdit(){
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->edit=true;
        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function update (){
        $this->dossier->client_id = $this->client;
        $this->dossier->vehicule_id = $this->vehicule;
        $this->dossier->chauffeur_id = $this->chauffeur;
        $this->dossier->montant = $this->montant;
        $this->dossier->type_transport = $this->type_transport;

        if($this->dossier->save()){
            $this->dispatch('new-dossier');
            $this->edit=false;
            request()->session()->flash("success", "Dossier modifié avec succès.");
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
        }

    }
}
