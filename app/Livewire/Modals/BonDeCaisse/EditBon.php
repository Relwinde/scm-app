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
        $this->bon->montant_definitif = floatval(str_replace(' ', '',$this->montant));
        $this->bon->montant = floatval(str_replace(' ', '',$this->montant));
        $this->bon->depense = $this->depense;
        if ($this->bon->save()){
            $this->dispatch('new-bon-de-caisse');
            $this->closeModal();
        }else{
            $this->dispatch('error');
        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
