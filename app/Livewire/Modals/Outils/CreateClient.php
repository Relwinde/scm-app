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
    public $code;

    public function render()
    {
        return view('livewire.modals.outils.create-client', ["title"=>"Création d'un nouveau client"]);
    }

    public function create(){
        $client = Client::make([
            'nom'=>$this->nom,
            'code'=>$this->code,
            'telephone'=>$this->telephone,
            'email'=>$this->email,
            'adresse'=>$this->adresse, 
            'ifu'=>$this->ifu,
            'rccm'=>$this->rccm,
            'created_by'=>auth()->id(),
            'updated_by'=>auth()->id(),
        ]);

        if($client->save()){
            $this->dispatch('new-client');
            $this->reset();
        } else{
            $this->dispatch('error');            
        }
    } 

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
