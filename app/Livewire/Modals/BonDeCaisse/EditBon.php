<?php

namespace App\Livewire\Modals\BonDeCaisse;

use App\Models\BonDeCaisse;
use LivewireUI\Modal\ModalComponent;

class EditBon extends ModalComponent
{
    public BonDeCaisse $bon;
    public $montant;
    public $depense;
    public $description;

    public function mount (){
        $this->montant = $this->bon->montant;
        $this->depense = $this->bon->depense; 
        $this->description = $this->bon->description;
    }

    public function render()
    {
        return view('livewire.modals.bon-de-caisse.edit-bon');
    }

    public function reformat_montant (){
        $this->montant = number_format(floatval( str_replace(' ', '',$this->montant)), 2, '.', ' ');
    }

    public function update(){
        $this->montant = str_replace(' ', '',$this->montant);
        $this->validate([
            'montant'=>'required|numeric|min:1',
            'depense'=>'required|string|max:40',
            'description'=>'nullable|string',
        ],
        [
            'montant.required'=>'Le montant est obligatoire',
            'montant.numeric'=>'Le montant doit être un nombre',
            'montant.min'=>'Le montant doit être supérieur ou égal à 1',
            'depense.required'=>'Le type de dépense est obligatoire',
            'depense.string'=>'Le type de dépense doit être une chaîne de caractères',
            'depense.max'=>'L\'intitulé de la dépense ne doit pas dépasser 40 caractères',
            'description.string'=>'La description doit être une chaîne de caractères',
        ]);

    
        $this->bon->montant_definitif = floatval(str_replace(' ', '',$this->montant));
        $this->bon->montant = floatval(str_replace(' ', '',$this->montant));
        $this->bon->depense = $this->depense;
        $this->bon->description = $this->description;
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
