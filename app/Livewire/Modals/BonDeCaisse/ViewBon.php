<?php

namespace App\Livewire\Modals\BonDeCaisse;

use App\Models\Caisse;
use App\Models\EtapeBon;
use App\Models\BonDeCaisse;
use App\Models\SuiviCaisse;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ViewBon extends ModalComponent
{
    public BonDeCaisse $bon;

    #[Validate('required')]
    public $method;

    public $viewComments = false;

    public $viewFiles = false;

    #[On('new-ajustement')]
    #[On('new-status')]
    public function render()
    {

        return view('livewire.modals.bon-de-caisse.view-bon', ['bon'=>$this->bon]);
    }

    public function nextStep (){
        switch($this->bon->etape){
            case "EMETTEUR": 
                if ($this->bon->etape != "EMETTEUR" || Auth::user()->id != $this->bon->user->id) {
                    $this->dispatch('not-allowed');
                    return;
                }
                $this->bon->etape = "RESPONSABLE";
                if ($this->bon->save()){
                    $this->createEtapeBon("EMETTEUR", "RESPONSABLE", 'next-step');
                }
            break;

            case "RESPONSABLE":
                if(! ($this->bon->etape == "RESPONSABLE" && Auth::user()->can('Envoyer bon de caisse au manager'))){
                    $this->dispatch('not-allowed');
                    return;
                }
                $this->bon->etape = "MANAGER";
                if ($this->bon->save()){
                    $this->createEtapeBon("RESPONSABLE", "MANAGER", 'next-step');
                }
            break;

            case "MANAGER":
                if(! ($this->bon->etape == "MANAGER" && Auth::user()->can('Envoyer bon de caisse au RAF'))){
                    $this->dispatch('not-allowed');
                    return;
                }
                $this->bon->etape = "RAF";
                if ($this->bon->save()){
                    $this->createEtapeBon("MANAGER", "RAF", 'next-step');
                }
            break;

            case "RAF":
                if(! ($this->bon->etape == "RAF" && Auth::user()->can('Envoyer bon de caisse à la caisse'))){
                    $this->dispatch('not-allowed');
                    return;
                }
                if ($this->method == "ESPECE" || $this->method == "CHEQUE"){
                    $this->bon->etape = "CAISSE";
                    $this->bon->type_paiement = $this->method;
                    if ($this->bon->save()){
                        $this->createEtapeBon("RAF", "CAISSE", 'next-step');
                    }
                } else {
                    $this->dispatch('invalid-method');
                }
            break;

            case "CAISSE": 
                if(! ($this->bon->etape == "CAISSE" && Auth::user()->can('Payer bon de caisse'))){
                    $this->dispatch('not-allowed');
                    return;
                }
                if($this->bon->type_paiement == "ESPECE"){
                    $this->cashPayment();
                } else if ($this->bon->type_paiement == "CHEQUE"){

                    $this->dispatch('openModal', ChequePayment::class, ['bon'=>$this->bon->id]);
                } 
            break;

        }
    }

    private function createEtapeBon($previous, $current, $event) {
        EtapeBon::create([
            'etape_precedente' => $previous,
            'etape_actuelle' => $current,
            'montant' => $this->bon->montant_definitif,
            'bon_de_caisse_id' => $this->bon->id,
            'user_id' => Auth::user()->id,
        ]);
        $this->dispatch($event);
    }


    private function cashPayment (){
        if ($this->bon->montant > Caisse::find(1)->solde){
            $this->dispatch('insufficient-funds');
            $this->closeModal();
        } else {
            $montantBon = $this->bon->montant_definitif;
            $caisse = Caisse::find(1);
            $soldeBefore = $caisse->solde;
            
            $caisse->solde = $caisse->solde - $montantBon;

            if($caisse->save()){
                SuiviCaisse::create([
                    'bon_de_caisse_id'=>$this->bon->id,
                    'solde_before'=>$soldeBefore,
                    'montant'=>$montantBon,
                    'solde_after'=>$caisse->solde,
                    'user_id'=> Auth::user()->id
                ]);

                $this->bon->etape = "PAYE";

                if ($this->bon->save()){
                    $this->createEtapeBon("CAISSE", "PAYE", 'operation-success');
                }
                
            }

        }
    }

    public function close (){
        $this->bon->etape = "CLOS";

        if ($this->bon->save()){
            EtapeBon::create([
                'etape_precedente'=>"PAYE",
                'etape_actuelle'=>"CLOS",
                'montant'=>$this->bon->montant_definitif,
                'bon_de_caisse_id'=>$this->bon->id,
                'user_id'=>Auth::user()->id,
            ]);
        }
        
        $this->dispatch('closed');
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
    

    
}
