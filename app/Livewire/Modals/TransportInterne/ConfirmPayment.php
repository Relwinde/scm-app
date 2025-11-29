<?php

namespace App\Livewire\Modals\TransportInterne;

use App\Models\TransportInterne;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Symfony\Component\Mailer\Transport;

class ConfirmPayment extends ModalComponent
{
    public TransportInterne $dossier;

    public $date_paiement;

    public function render()
    {
        return view('livewire.modals.transport-interne.confirm-payment');
    }

    public function save (){
        $this->validate([
            'date_paiement' => 'required|string|max:255',
        ],
        [
            'date_paiement.required' => 'La date de paiement est requis.',
            'date_paiement.string' => 'La date de paiement doit être une chaîne de caractères.',
            'date_paiement.max' => 'La date de paiement ne doit pas dépasser 255 caractères.'
        ]);

        try {
            DB::beginTransaction();

            $this->dossier->date_paiement = $this->date_paiement;
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
