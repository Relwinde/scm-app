<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class ConfirmPayment extends ModalComponent
{

    public Dossier $dossier;

    public $date_paiement;
    public $mode_paiement;


    public function render()
    {
        return view('livewire.modals.dossier.confirm-payment');
    }


    public function save (){
        $this->validate([
            'date_paiement' => 'required|string|max:255',
            'mode_paiement' => 'required|in:ESPECE,CHEQUE,VIREMENT',
        ],
        [
            'date_paiement.required' => 'La date de paiement est requis.',
            'date_paiement.string' => 'La date de paiement doit être une chaîne de caractères.',
            'date_paiement.max' => 'La date de paiement ne doit pas dépasser 255 caractères.', 
            'mode_paiement.required' => 'Le mode de paiement est requis.',
            'mode_paiement.in' => 'Le mode de paiement sélectionné est invalide.',
        ]);

        try {
            DB::beginTransaction();

            $this->dossier->date_paiement = $this->date_paiement;
            $this->dossier->mode_paiement = $this->mode_paiement;
            try { 
                $this->dossier->transitionTo('pay', auth()->user()->id);
            } catch (\Throwable $th) {
                $this->dispatch('status-transition-error');
                return;
            }

            $this->dossier->save();
            $this->dossier->refresh();

            DB::commit();

            $this->dispatch('update-dossier');
            $this->dispatch('paiement-confirmed');
            $this->dispatch('closeModal');


        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


    }
}
