<?php

namespace App\Livewire\Modals\Outils;

use App\Models\Fournisseur;
use LivewireUI\Modal\ModalComponent;

class CreateFournisseur extends ModalComponent
{
    public $nom;
    public $email;
    public $telephone;
    public $adresse;

    public function render()
    {
        return view('livewire.modals.outils.create-fournisseur', ['title'=>"Création d'un fournisseur"]);
    }

    public function create (){
        $fournisseur = Fournisseur::make([
            'nom'=>$this->nom,
            'email'=>$this->email,
            'telephone'=>$this->telephone,
            'adresse'=>$this->adresse,
        ]);

        if($fournisseur->save()){
            $this->dispatch('new-fournisseur');
            request()->session()->flash("success", "Fournisseur ajouté avec succès.");
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
