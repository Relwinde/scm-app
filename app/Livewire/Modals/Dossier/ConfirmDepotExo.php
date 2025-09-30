<?php

namespace App\Livewire\Modals\Dossier;


use App\Models\Dossier;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ConfirmDepotExo extends ModalComponent
{

    use WithFileUploads;

    public Dossier $dossier;
    public $numero_decision_exo;
    public $file;


    public function render()
    {
        return view('livewire.modals.dossier.confirm-depot-exo');
    }

    public function save (){
        if (! auth()->user()->can('Enregistrer & déposer dossiers en douane')) {
            $this->dispatch('not-allowed');
            return;
        }

        if ($this->dossier->status?->code != 'di_dep' || $this->dossier->regime != 'EXO'){
            $this->dispatch('not-allowed');
            return;
        }

        $this->validate([
            'numero_decision_exo' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:2048', // 2MB Max
        ],
        [
            'numero_decision_exo.required' => 'Le numéro de la décision d\'éxonération est requis.',
            'numero_decision_exo.string' => 'Le numéro de la décision d\'éxonération doit être une chaîne de caractères.',
            'numero_decision_exo.max' => 'Le numéro de la décision d\'éxonération ne doit pas dépasser 255 caractères.',
            'file.required' => 'Le document d\'acceptation est requis.',
            'file.mimes' => 'Le fichier doit être un document PDF.',
            'file.max' => 'Le fichier ne doit pas dépasser 2MB.',
        ]);

        $originalName = strtoupper(preg_replace('/\.pdf$/i', '', $this->file->getClientOriginalName()));
        $fileName = 'DECISION_EXO_' . str_replace('/', '-', $this->dossier->numero) . '.' . $this->file->getClientOriginalExtension();

        try { 
            $this->dossier->transitionTo('eng_dep', auth()->user()->id);
            $this->dossier->update([
                'numero_decision_exo' => strtoupper($this->numero_decision_exo),
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('status-transition-error');
            return;
        }
        \App\Models\Document::create([
            'dossier_id' => $this->dossier->id,
            'path' => 'attachments/dossiers/' . str_replace('/', '-', $this->dossier->numero) . '/' . $fileName,
            'type' => 'DECISION D\'EXONERATION',
            'name' => $fileName,
            'user_id' => auth()->id(),
            'size' => $this->file->getSize(),
        ]);    
        $this->file->storeAs('attachments/dossiers/' . str_replace('/', '-', $this->dossier->numero) , $fileName);
        $this->dispatch('depot-exo-confirmed');
        $this->dispatch('update-dossier');
        $this->dossier->refresh();
        $this->closeModal();

    }
}
