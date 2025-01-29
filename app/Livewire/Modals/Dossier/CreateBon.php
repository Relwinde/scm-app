<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use App\Models\BonDeCaisse;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Modals\BonDeCaisse\ViewBon;

class CreateBon extends ModalComponent
{

    public Dossier $dossier;

    public $montant;

    public $depense;

    public $description;

    public function render()
    {
        return view('livewire.modals.dossier.create-bon', ['title'=>'Nouveau bon sur le dossier:']);
    }

    public function reformat_montant (){
        $this->montant = number_format(floatval( str_replace(' ', '',$this->montant)), 2, '.', ' ');
    }

    public function createBon(){
        $bon = BonDeCaisse::make([
            'depense'=> $this->depense,
            'montant'=> floatval(str_replace(' ', '',$this->montant)),
            'montant_definitif'=> floatval(str_replace(' ', '',$this->montant)),
            'dossier_id'=>$this->dossier->id,
            'description'=>$this->description,
            'user_id'=>Auth::user()->id
         ]);

         if(BonDeCaisse::latest()->first()==null){
            $bon->numero= date('Y').date('m').date('d').date('H').date('i').date('s').'0000001';
        }else {
            $bon->numero= date('Y').date('m').date('d').date('H').date('i').date('s').str_pad(BonDeCaisse::latest()->first()->id+1, 7, '0', STR_PAD_LEFT);
        }

        if ($bon->save()){
            $this->dispatch('new-bon-de-caisse');
            $this->reset(['montant', 'depense', 'description']);
        }else{
            $this->dispatch('error');
        }
    }
}
