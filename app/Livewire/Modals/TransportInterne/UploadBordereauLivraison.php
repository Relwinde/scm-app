<?php

namespace App\Livewire\Modals\TransportInterne;

use App\Models\Document;
use Livewire\WithFileUploads;
use App\Models\TransportInterne;
use LivewireUI\Modal\ModalComponent;

class UploadBordereauLivraison extends ModalComponent
{

    public TransportInterne $dossier;
    public $file;

    use WithFileUploads;


    public function render()
    {
        return view('livewire.modals.transport-interne.upload-bordereau-livraison');
    }

    public function save (){
        $this->validate([
            'file' => 'required|mimes:pdf|max:5120', // 5MB Max
        ],
        [
            'file.mimes' => 'Le fichier doit être un document PDF.',
            'file.max' => 'Le fichier ne doit pas dépasser 5MB.',
        ]);


        $originalName = strtoupper(preg_replace('/\.pdf$/i', '', $this->file->getClientOriginalName()));
        $fileName = 'BORDEREAU_LIVRAISON_' . str_replace('/', '-', $this->dossier->numero) . '.' . $this->file->getClientOriginalExtension();

        try { 
            $this->dossier->transitionTo('lvr', auth()->user()->id);
        } catch (\Throwable $th) {
            $this->dispatch('status-transition-error');
            return;
        }

        $path = $this->file->storeAs('attachments/dossiers/' . str_replace('/', '-', $this->dossier->numero), $fileName);

        Document::create([
            'transport_interne_id' => $this->dossier->id,
            'path' => $path,
            'type' => 'BORDEREAU DE LIVRAISON',
            'name' => $fileName,
            'user_id' => auth()->id(),
            'size' => $this->file->getSize(),
        ]);


        $this->dispatch('update-dossier');
        $this->dispatch('bl-confirmed');
        $this->closeModal();

    }
}
