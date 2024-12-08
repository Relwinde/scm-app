<?php

namespace App\Livewire\Modals;

use App\Models\Depot;
use App\Models\Caisse;
use App\Models\SuiviCaisse;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class CreateDepot extends ModalComponent
{

    #[Validate('Required', 'Le montant est obligatoire pour effectuer un dépôt')]
    public $montant;

    #[Validate('required', 'L\'identité du déposant est obligatoire pour effectue un dépôt')]
    public $deposant;

    #[Validate('required', 'Renseignez un libellé pour effectuer le dépôt')]
    public $libelle;

    #[Validate('required', 'Renseignez la banque de provénance pour effectuer le dépôt')]
    public $banque;

    #[Validate('required', 'Renseignez la banque de provénance pour effectuer le dépôt')]
    public $ref_cheque;

    public function render()
    {
        return view('livewire.modals.create-depot', ['title'=>'Nouveau dépôt']);
    }

    public function reformat_montant (){
        $this->montant = number_format(floatval( str_replace(' ', '',$this->montant)), 2, '.', ' ');
    }

    public function create (){
        
        $depot = Depot::make([
            'deposant'=>$this->deposant,
            'montant'=>floatval(str_replace(' ', '',$this->montant)), 
            'libelle'=>$this->libelle,
            'banque'=>$this->banque,
            'ref_cheque'=>$this->ref_cheque,
            'user_id'=>Auth::user()->id
        ]);

        if($depot->save()){
            $caisse = Caisse::find(1);
            $soldeBefore = $caisse->solde;
            $caisse->solde = $caisse->solde + $depot->montant;
            $caisse->last_updated_by = Auth::user()->id;

            if ($caisse->save()){
                SuiviCaisse::create([
                    'depot_id'=> $depot->id,
                    'solde_before'=> $soldeBefore, 
                    'montant'=>$depot->montant,
                    'solde_after'=>$caisse->solde,
                    'user_id'=>Auth::user()->id
                ]);

                $this->dispatch('new-depot');
                $this->closeModal();
            }
            
        }

    }
    
}
