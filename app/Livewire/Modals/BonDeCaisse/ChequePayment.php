<?php

namespace App\Livewire\Modals\BonDeCaisse;

use App\Models\EtapeBon;
use App\Models\BonDeCaisse;
use App\Models\ChequePayment as ModelsChequePayment;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ChequePayment extends ModalComponent
{

    public BonDeCaisse $bon;

    public $banque;

    public $benef;

    public $reference;

    public function render()
    {
        return view('livewire.modals.bon-de-caisse.cheque-payment');
    }

    public function pay (){
        $this->bon->etape = "PAYE";
        if ($this->bon->save()){
            $this->createCheque();
            $this->createEtapeBon("CAISSE", "PAYE", 'operation-success');
            $this->closeModal();
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

    private function createCheque (){
        ModelsChequePayment::create([
            'banque' => $this->banque,
            'benef' => $this->benef,
            'reference' => $this->reference,
            'bon_de_caisse_id' => $this->bon->id
        ]);
    }
}
