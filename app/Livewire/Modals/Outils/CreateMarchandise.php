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
