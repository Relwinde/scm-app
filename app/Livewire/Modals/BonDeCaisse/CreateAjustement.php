<?php

namespace App\Livewire\Modals\BonDeCaisse;

use App\Models\Caisse;
use App\Models\BonDeCaisse;
use App\Models\SuiviCaisse;
use App\Models\AjustementBon;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class CreateAjustement extends ModalComponent
{
    public BonDeCaisse $bon;
    public $libelle;
    public $type;
    public $montant;
    public $montantAfter;

    public function render()
    {
        switch($this->type){
            case 1: 
                $this->montantAfter = $this->bon->montant_definitif + floatval(str_replace(' ', '',$this->montant));
                break;
                
            case 2: 
                $this->montantAfter = $this->bon->montant_definitif - floatval(str_replace(' ', '',$this->montant));
                break;
        }

        return view('livewire.modals.bon-de-caisse.create-ajustement');
    }

    public function create (){
        switch($this->type){
            case 1:
                $montantBefore = $this->bon->montant_definitif;
                $ajustement = AjustementBon::make([
                    'bon_de_caisse_id' => $this->bon->id,
                    'libelle' => $this->libelle,
                    'type' => 'EXCEDANT',
                    'montant'=> floatval(str_replace(' ', '',$this->montant)),
                    'montant_bon_before' => $this->bon->montant_definitif,
                    'montant_bon_after' => $this->bon->montant_definitif + floatval(str_replace(' ', '',$this->montant)),
                    'user_id' => Auth::user()->id,
                ]);

                $this->bon->montant_definitif = $this->bon->montant_definitif + floatval(str_replace(' ', '',$this->montant));

                if ($this->bon->save()){

                    if ($ajustement->save()){

                        $caisse = Caisse::find(1);
                        $soldeBefore = $caisse->solde;
                        $caisse->solde = $caisse->solde - floatval(str_replace(' ', '',$this->montant));

                        if ($caisse->save()){
                            SuiviCaisse::create([
                                'ajustement_bon_id'=> $ajustement->id,
                                'solde_before' => $soldeBefore,
                                'montant' => $ajustement->montant,
                                'solde_after'=>$caisse->solde,
                                'user_id'=> Auth::user()->id
                            ]);

                            $this->dispatch('new-ajustement');
                            $this->closeModal();
                        }

                    }

                }
            break;

            case 2: 
                if(floatval(str_replace(' ', '',$this->montant)) > $this->bon->montant_definitif){
                    $this->dispatch('insufficient-funds');
                    $this->reset();
                    $this->closeModal();
                    break;
                }

                $montantBefore = $this->bon->montant_definitif;
                $ajustement = AjustementBon::make([
                    'bon_de_caisse_id' => $this->bon->id,
                    'libelle' => $this->libelle,
                    'type' => 'RESTITUTION',
                    'montant'=> floatval(str_replace(' ', '',$this->montant)),
                    'montant_bon_before' => $this->bon->montant_definitif,
                    'montant_bon_after' => $this->bon->montant_definitif - floatval(str_replace(' ', '',$this->montant)),
                    'user_id' => Auth::user()->id,
                ]);

                $this->bon->montant_definitif = $this->bon->montant_definitif - floatval(str_replace(' ', '',$this->montant));

                if ($this->bon->save()){

                    if ($ajustement->save()){

                        $caisse = Caisse::find(1);
                        $soldeBefore = $caisse->solde;
                        $caisse->solde = $caisse->solde + $ajustement->montant;

                        if ($caisse->save()){
                            SuiviCaisse::create([
                                'ajustement_bon_id'=> $ajustement->id,
                                'solde_before' => $soldeBefore,
                                'montant' => $ajustement->montant,
                                'solde_after'=>$caisse->solde,
                                'user_id'=> Auth::user()->id
                            ]);
                            $this->dispatch('new-ajustement');
                            $this->closeModal();
                        }

                    }

                }
            break;

        }
    }

    public function reformat_montant (){
        
        $this->montant = number_format(floatval( str_replace(' ', '',$this->montant)), 2, '.', ' ');
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
