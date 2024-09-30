<?php

namespace App\Livewire\Modals\Outils;

use App\Models\Marchandise;
use LivewireUI\Modal\ModalComponent;

class CreateMarchandise extends ModalComponent
{

    public $nom;

    public function render()
    {
        return view('livewire.modals.outils.create-marchandise', ['title'=>"Création d'une nouvelle marchandise"]);
    }

    public function create() {
        $marchandise = Marchandise::make([
            'nom'=>$this->nom
        ]);

        if($marchandise->save()){
            $this->dispatch('new-marchandise');
            request()->session()->flash("success", "Marchandise ajouté avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");

        }
    }
}
