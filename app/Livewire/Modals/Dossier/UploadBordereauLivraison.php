<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use App\Models\Document;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class UploadBordereauLivraison extends ModalComponent
{

    use WithFileUploads;

    public Dossier $dossier;
    public $file;

    public function render()
    {
        return view('livewire.modals.dossier.upload-bordereau-livraison');
    }

    public function save (){
        if (! auth()->user()->can('Charger les bordereaux de livraison signés')) {
            $this->dispatch('not-allowed');
            return;
        }

        if ($this->dossier->status?->code != 'bae'){
            $this->dispatch('not-allowed');
            return;
        }

        $this->validate([
            'file' => 'required|mimes:pdf|max:2048', // 2MB Max
        ],
        [
            'file.mimes' => 'Le fichier doit être un document PDF.',
            'file.max' => 'Le fichier ne doit pas dépasser 2MB.',
        ]);

        $originalName = strtoupper(preg_replace('/\.pdf$/i', '', $this->file->getClientOriginalName()));
        $fileName = 'BORDEREAU_LIVRAISON_' . $this->dossier->numero . '.' . $this->file->getClientOriginalExtension();

        try { 
            $this->dossier->transitionTo('lvr', auth()->user()->id);
        } catch (\Throwable $th) {
            $this->dispatch('status-transition-error');
            return;
        }

        Document::create([
            'dossier_id' => $this->dossier->id,
            'path' => 'attachments/dossiers/' . $this->dossier->numero . '/' . $fileName,
            'type' => 'BORDEREAU DE LIVRAISON',
            'name' => $fileName,
            'user_id' => auth()->id(),
            'size' => $this->file->getSize(),
        ]);

        $this->file->storeAs('attachments/dossiers/' . $this->dossier->numero, $fileName, 'public');

        $this->dispatch('update-dossier');
        $this->dispatch('bae-confirmed');
        $this->closeModal();
    }   
}
