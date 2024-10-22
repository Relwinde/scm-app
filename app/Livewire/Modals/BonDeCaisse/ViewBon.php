<?php

namespace App\Livewire\Modals\BonDeCaisse;

use App\Models\Caisse;
use App\Models\EtapeBon;
use App\Models\BonDeCaisse;
use App\Models\SuiviCaisse;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ViewBon extends ModalComponent
{
    public BonDeCaisse $bon;

    #[On('new-ajustement')]
    public function render()
    {

        return view('livewire.modals.bon-de-caisse.view-bon', ['bon'=>$this->bon]);
    }

    public function nextStep (){
        switch($this->bon->etape){
            case "EMETTEUR": 
                $this->bon->etape = "RESPONSABLE";
                if ($this->bon->save()){
                    EtapeBon::create([
                        'etape_precedente'=>"EMETTEUR",
                        'etape_actuelle'=>"RESPONSABLE",
                        'montant'=>$this->bon->montant_definitif,
                        'bon_de_caisse_id'=>$this->bon->id,
                        'user_id'=>Auth::user()->id,
                    ]);
                }
                $this->dispatch('next-step');
            break;

            case "RESPONSABLE":
                $this->bon->etape = "MANAGER";
                if ($this->bon->save()){
                    EtapeBon::create([
                        'etape_precedente'=>"RESPONSABLE",
                        'etape_actuelle'=>"MANAGER",
                        'montant'=>$this->bon->montant_definitif,
                        'bon_de_caisse_id'=>$this->bon->id,
                        'user_id'=>Auth::user()->id,
                    ]);
                }
                $this->dispatch('next-step');
            break;

            case "MANAGER":
                $this->bon->etape = "CAISSE";
                if ($this->bon->save()){
                    EtapeBon::create([
                        'etape_precedente'=>"MANAGER",
                        'etape_actuelle'=>"CAISSE",
                        'montant'=>$this->bon->montant_definitif,
                        'bon_de_caisse_id'=>$this->bon->id,
                        'user_id'=>Auth::user()->id,
                    ]);
                }
                $this->dispatch('next-step');
            break;

            case "CAISSE": 
                
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
                            EtapeBon::create([
                                'etape_precedente'=>"CAISSE",
                                'etape_actuelle'=>"PAYE",
                                'montant'=>$this->bon->montant_definitif,
                                'bon_de_caisse_id'=>$this->bon->id,
                                'user_id'=>Auth::user()->id,
                            ]);
                        }
                        
                        $this->dispatch('operation-success');
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
