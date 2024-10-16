<?php

namespace App\Livewire\Modals\BonDeCaisse;

use App\Models\BonDeCaisse;
use App\Models\EtapeBon;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ViewBon extends ModalComponent
{
    public BonDeCaisse $bon;

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
                        'bon_de_caisse_id'=>$this->bon->id,
                        'user_id'=>Auth::user()->id,
                    ]);
                }
            break;

            case "RESPONSABLE":
                $this->bon->etape = "MANAGER";
                if ($this->bon->save()){
                    EtapeBon::create([
                        'etape_precedente'=>"RESPONSABLE",
                        'etape_actuelle'=>"MANAGER",
                        'bon_de_caisse_id'=>$this->bon->id,
                        'user_id'=>Auth::user()->id,
                    ]);
                }
            break;

            case "MANAGER":
                $this->bon->etape = "CAISSE";
                if ($this->bon->save()){
                    EtapeBon::create([
                        'etape_precedente'=>"MANAGER",
                        'etape_actuelle'=>"CAISSE",
                        'bon_de_caisse_id'=>$this->bon->id,
                        'user_id'=>Auth::user()->id,
                    ]);
                }
            break;

        }
    }
}
