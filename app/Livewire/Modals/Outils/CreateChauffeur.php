<?php

namespace App\Livewire\Modals\Outils;

use App\Models\Chauffeur;
use LivewireUI\Modal\ModalComponent;

class CreateChauffeur extends ModalComponent
{

    public $nom;
    public $contact;

    public function render()
    {
        return view('livewire.modals.outils.create-chauffeur', ['title'=>"Création d'un nouveau Chauffeur"]);
    }

    public function create (){
        $chauffeur = Chauffeur::make([
            'nom'=>$this->nom,
            'contact'=>$this->contact
        ]);

        if($chauffeur->save()){
            $this->dispatch('new-chauffeur');
            $this->reset();
        }else{
            $this->dispatch('error');
        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
    
}
