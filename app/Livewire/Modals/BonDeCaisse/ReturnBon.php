<?php

namespace App\Livewire\Modals\BonDeCaisse;

use App\Models\EtapeBon;
use App\Models\BonDeCaisse;
use App\Models\BonDeCaisseCommentaire;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ReturnBon extends ModalComponent
{

    public BonDeCaisse $bon;
    public $commentaire;
    public function render()
    {
        return view('livewire.modals.bon-de-caisse.return-bon');
    }

    public function backStep() {
        switch ($this->bon->etape) {
            case "CAISSE":
                $this->bon->etape = "RAF";
                $this->bon->type_paiement = null;  
                if ($this->bon->save()) {
                    $this->createBonCommentaire("CAISSE");
                    $this->createEtapeBon("CAISSE", "RAF", 'back-step');
                }
                $this->closeModal();
                break;
    
            case "RAF":
                $this->bon->etape = "MANAGER";
                if ($this->bon->save()) {
                    $this->createBonCommentaire("RAF");
                    $this->createEtapeBon("RAF", "MANAGER", 'back-step');
                }
                $this->closeModal();
                break;
    
            case "MANAGER":
                $this->bon->etape = "RESPONSABLE";
                if ($this->bon->save()) {
                    $this->createBonCommentaire("MANAGER");
                    $this->createEtapeBon("MANAGER", "RESPONSABLE", 'back-step');
                }
                $this->closeModal();
                break;
    
            case "RESPONSABLE":
                $this->bon->etape = "EMETTEUR";
                if ($this->bon->save()) {
                    $this->createBonCommentaire("RESPONSABLE");
                    $this->createEtapeBon("RESPONSABLE", "EMETTEUR", 'back-step');
                }
                $this->closeModal();
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
        $this->dispatch("new-status");
    }

    private function createBonCommentaire($etape) {
        BonDeCaisseCommentaire::create([
            'etape' => $etape,
            'content' => $this->commentaire,
            'bon_de_caisse_id' => $this->bon->id,
            'user_id' => Auth::user()->id,
        ]);
    }



}
