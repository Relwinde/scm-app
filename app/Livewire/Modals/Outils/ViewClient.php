<?php

namespace App\Livewire\Modals\Outils;

use App\Models\Client;
use LivewireUI\Modal\ModalComponent;

class ViewClient extends ModalComponent
{

    public Client $client;
    public $nom;
    public $telephone;
    public $email;
    public $adresse;
    public $ifu;
    public $rccm;
    public $code;

    public $edit = false;

    public function render()
    {
        
        $this->nom =         $this->client->nom;
        $this->telephone =         $this->client->telephone;
        $this->email =         $this->client->email;
        $this->adresse =         $this->client->adresse;
        $this->ifu =         $this->client->ifu;
        $this->rccm =         $this->client->rccm;
        $this->code =         $this->client->code;

        return view('livewire.modals.outils.view-client');
    }

    public function setEdit(){
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->edit=true;
        }
    }

    public function update (){
        $this->client->nom = $this->nom;
        $this->client->telephone = $this->telephone;
        $this->client->email = $this->email;
        $this->client->adresse = $this->adresse;
        $this->client->ifu = $this->ifu;
        $this->client->rccm = $this->rccm;
        $this->client->code = $this->code;

        if($this->client->save()){
            $this->dispatch('new-client');
            $this->edit=false;
            request()->session()->flash("success", "Client modifié avec succès.");
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
