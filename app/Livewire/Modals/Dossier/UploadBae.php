<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use App\Models\Document;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class UploadBae extends ModalComponent
{

    use WithFileUploads;

    public Dossier $dossier;
    public $file;
    public $bae_number;

    
    public function render()
    {
        return view('livewire.modals.dossier.upload-bae');
    }

    public function save (){
        if (! auth()->user()->can('Charger le BAE')) {
            $this->dispatch('not-allowed');
            return;
        }

        $this->validate([
            'file' => 'required|mimes:pdf|max:2048', // 2MB Max
            'bae_number' => 'required|string|max:255',
        ],
        [
            'file.mimes' => 'Le fichier doit être un document PDF.',
            'file.max' => 'Le fichier ne doit pas dépasser 2MB.',
            'bae_number.required' => 'Le numéro BAE est requis.',
            'bae_number.string' => 'Le numéro BAE doit être une chaîne de caractères.',
            'bae_number.max' => 'Le numéro BAE ne doit pas dépasser 255 caractères.'
        ]);

        $originalName = strtoupper(preg_replace('/\.pdf$/i', '', $this->file->getClientOriginalName()));
        $fileName = 'BAE_' . str_replace('/', '-', $this->dossier->numero) . '.' . $this->file->getClientOriginalExtension();

        $this->dossier->bae_number = $this->bae_number;

        try { 
            $this->dossier->transitionTo('bae', auth()->user()->id);
        } catch (\Throwable $th) {
            $this->dispatch('status-transition-error');
            return;
        }

        Document::create([
            'dossier_id' => $this->dossier->id,
            'path' => 'attachments/dossiers/' . str_replace('/', '-', $this->dossier->numero) . '/' . $fileName,
            'type' => 'BAE',
            'name' => $fileName,
            'user_id' => auth()->id(),
            'size' => $this->file->getSize(),
        ]);

        $this->file->storeAs('attachments/dossiers/' . str_replace('/', '-', $this->dossier->numero), $fileName);

        $this->dossier->save();
        $this->dossier->refresh();
        $this->dispatch('update-dossier');
        $this->dispatch('bae-confirmed');
        $this->dispatch('closeModal');
        
    }
}
