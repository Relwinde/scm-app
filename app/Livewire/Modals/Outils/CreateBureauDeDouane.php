<?php

namespace App\Livewire\Modals\Outils;

use App\Models\BureauDeDouane;
use LivewireUI\Modal\ModalComponent;

class CreateBureauDeDouane extends ModalComponent
{

    public $nom;
    public $code;

    public function render()
    {
        return view('livewire.modals.outils.create-bureau-de-douane', ['title'=>"Création d'un nouveau bureau de douane"]);
    }

    public function create (){
        $bureau = BureauDeDouane::make([
            'nom'=>$this->nom,
            'code'=>$this->code
        ]);

        if($bureau->save()){
            $this->dispatch('new-bureau-de-douane');
            request()->session()->flash("success", "Chauffeur ajouté avec succès.");
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
