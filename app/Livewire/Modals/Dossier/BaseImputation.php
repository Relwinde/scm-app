<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use LivewireUI\Modal\ModalComponent;

class BaseImputation extends ModalComponent
{
    public Dossier $dossier;
    public $numero_bi;

    public function render()
    {
        return view('livewire.modals.dossier.base-imputation');
    }


    public function save (){
        if (! auth()->user()->can('Renseigner la base d\'imputation')) {
            $this->dispatch('not-allowed');
            return;
        }

        if ($this->dossier->status?->code != 'fm_def' || $this->dossier->regime != 'EXO'){
            $this->dispatch('not-allowed');
            return;
        }

        $this->validate([
            'numero_bi' => 'required|string|max:255',
        ],
        [
            'numero_bi.required' => 'Le numéro de base d\'imputation est requis.',
            'numero_bi.string' => 'Le numéro de base d\'imputation doit être une chaîne de caractères.',
            'numero_bi.max' => 'Le numéro de base d\'imputation ne doit pas dépasser 255 caractères.',
        ]);

        try { 
            $this->dossier->transitionTo('ba_imp', auth()->user()->id);
            $this->dossier->update([
                'numero_bi' => strtoupper($this->numero_bi),
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('status-transition-error');
            return;
        }

        $this->dispatch('base-imputation-saved');
        $this->dispatch('update-dossier');
        $this->dossier->refresh();
        $this->closeModal();
    }
}
