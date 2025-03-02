<?php

namespace App\Livewire\Modals\BonDeCaisse;


use App\Models\EtapeBon;
use App\Models\BonDeCaisse;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ManagerValidation extends ModalComponent
{
    public BonDeCaisse $bon;
    public $commentaire;
    
    public function render()
    {
        return view('livewire.modals.bon-de-caisse.manager-validation');
    }

    public function validateBon (){
        $this->bon->etape = "RAF";

        if($this->bon->save()){
            if ($this->commentaire != "FYI" && $this->commentaire != "fyi" && $this->commentaire != " " && $this->commentaire != null && $this->commentaire != ""){
                
                $this->createEtapeBon("MANAGER", "RAF", 'next-step', $this->commentaire);
            }
        }
       
        $this->closeModal();
    }

    private function createEtapeBon($previous, $current, $event) {
        EtapeBon::create([
            'etape_precedente' => $previous,
            'etape_actuelle' => $current,
            'montant' => $this->bon->montant_definitif,
            'manager_validation_comment' => $this->commentaire,
            'bon_de_caisse_id' => $this->bon->id,
            'user_id' => Auth::user()->id,
        ]);
        $this->dispatch($event);
        $this->dispatch("new-status");
    }
}
