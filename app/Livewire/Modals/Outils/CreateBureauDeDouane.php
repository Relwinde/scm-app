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
