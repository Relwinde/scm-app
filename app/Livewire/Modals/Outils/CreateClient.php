<?php

namespace App\Livewire\Modals\Outils;

use App\Models\Client;
use LivewireUI\Modal\ModalComponent;

class CreateClient extends ModalComponent
{

    public $nom;
    public $telephone;
    public $email;
    public $adresse;
    public $ifu;
    public $rccm;

    public function render()
    {
        return view('livewire.modals.outils.create-client', ["title"=>"Création d'un nouveau client"]);
    }

    public function create(){
        $client = Client::make([
            'nom'=>$this->nom,
            'telephone'=>$this->telephone,
            'email'=>$this->email,
            'adresse'=>$this->adresse,
            'ifu'=>$this->ifu,
            'rccm'=>$this->rccm
        ]);

        if($client->save()){
            $this->dispatch('new-client');
            request()->session()->flash("success", "Client ajouté avec succès.");
            $this->reset();
        } else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
            
        }
    } 

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
