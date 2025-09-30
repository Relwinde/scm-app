<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class UploadDemandeExo extends ModalComponent
{

    use WithFileUploads;

    public Dossier $dossier;
    public $file;
    public $numero_demande_exo;

    public function render()
    {
        return view('livewire.modals.dossier.upload-demande-exo');
    }

    public function save (){
        if (! auth()->user()->can('Déposer le DI')) {
            $this->dispatch('not-allowed');
            return;
        }

        if ($this->dossier->status?->code != 'ba_imp' || $this->dossier->regime != 'EXO'){
            $this->dispatch('not-allowed');
            return;
        }

        $this->validate([
            'file' => 'required|mimes:pdf|max:2048', // 2MB Max
            'numero_demande_exo' => 'required|string|max:255|unique:dossiers,numero_demande_exo',
        ],
        [
            'file.mimes' => 'Le fichier doit être un document PDF.',
            'file.max' => 'Le fichier ne doit pas dépasser 2MB.',
            'numero_demande_exo.required' => 'Le numéro de la demande d\'éxonération est requis.',
            'numero_demande_exo.string' => 'Le numéro de la demande d\'éxonération doit être une chaîne de caractères.',
            'numero_demande_exo.max' => 'Le numéro de la demande d\'éxonération ne doit pas dépasser 255 caractères.',
        ]);

        $originalName = strtoupper(preg_replace('/\.pdf$/i', '', $this->file->getClientOriginalName()));
        $fileName = 'DEMANDE_EXO_' . str_replace('/', '-', $this->dossier->numero) . '.' . $this->file->getClientOriginalExtension();

        try { 
            $this->dossier->transitionTo('di_dep', auth()->user()->id);
            $this->dossier->update([
                'numero_demande_exo' => strtoupper($this->numero_demande_exo),
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('status-transition-error');
            return;
        }

        \App\Models\Document::create([
            'dossier_id' => $this->dossier->id,
            'path' => 'attachments/dossiers/' . str_replace('/', '-', $this->dossier->numero) . '/' . $fileName,
            'type' => 'DEMANDE D\'EXONERATION',
            'name' => $fileName,
            'user_id' => auth()->id(),
            'size' => $this->file->getSize(),
        ]);    
        $this->file->storeAs('attachments/dossiers/' . str_replace('/', '-', $this->dossier->numero) , $fileName);
        $this->dispatch('update-dossier');
        $this->dispatch('demande-exo-saved');
        $this->dossier->refresh();
        $this->closeModal();    
    } 
}
