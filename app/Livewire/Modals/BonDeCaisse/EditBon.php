<?php

namespace App\Livewire\Modals\BonDeCaisse;

use App\Models\BonDeCaisse;
use LivewireUI\Modal\ModalComponent;

class EditBon extends ModalComponent
{
    public BonDeCaisse $bon;
    public $montant;
    public $depense;

    public function mount (){
        $this->montant = $this->bon->montant;
        $this->depense = $this->bon->depense; 
    }

    public function render()
    {
        return view('livewire.modals.bon-de-caisse.edit-bon');
    }

    public function reformat_montant (){
        $this->montant = number_format(floatval( str_replace(' ', '',$this->montant)), 2, '.', ' ');
    }

    public function update(){
        $this->bon->montant = floatval(str_replace(' ', '',$this->montant));
        $this->bon->depense = $this->depense;
        if ($this->bon->save()){
            $this->dispatch('new-bon-de-caisse');
            request()->session()->flash("success", "Utilisateur ajuoté avec succès.");
            $this->closeModal();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
