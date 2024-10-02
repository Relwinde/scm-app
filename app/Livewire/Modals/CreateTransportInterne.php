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
    public $type_transport;

    public function render()
    {
        $clients = Client::all(['id', 'nom']);
        $chauffeurs = Chauffeur::all(['id', 'nom']);
        $vehicules = Vehicule::all(['id', 'immatriculation']);

        return view('livewire.modals.create-transport-interne',["clients"=>$clients, "chauffeurs"=>$chauffeurs, "vehicules"=>$vehicules, "title"=>"de transport interne"]);
    }

    public function create(){
        $dossier = TransportInterne::make([
        'montant'=>$this->montant,
        'type_transport'=>$this->type_transport,
        'client_id'=>$this->client,
        'vehicule_id'=>$this->vehicule,
        'chauffeur_id'=>$this->chauffeur
        ]);

        if(TransportInterne::latest()->first()==null){

            $numero = "TP".$this->type_transport.strtoupper(substr($dossier->client->nom, 0, 3))."/".substr(date('Y'), -2).'0001';
        }else {
            $numero = "TP".$this->type_transport.strtoupper(substr($dossier->client->nom, 0, 3))."/".substr(date('Y'), -2).str_pad(TransportInterne::latest()->first()->id+1, 4, '0', STR_PAD_LEFT);
        }

        $dossier->numero = $numero;
    
        if($dossier->save()){
            $this->dispatch('new-dossier');
            request()->session()->flash("success", "Dossier ajouté avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");

        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
