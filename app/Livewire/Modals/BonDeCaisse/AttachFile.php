<?php

namespace App\Livewire\Modals\BonDeCaisse;

use App\Models\BonDeCaisse;
use App\Models\Document;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class AttachFile extends ModalComponent
{
    use WithFileUploads;
    
    public BonDeCaisse $bon;

    #[Validate('file|mimes:pdf|max:5120')] // 5MB Max
    public $file;

    public function render()
    {
        return view('livewire.modals.bon-de-caisse.attach-file');
    }

    public function save()
    {
        $this->validate();
        $originalName = strtoupper(preg_replace('/\.pdf$/i', '', $this->file->getClientOriginalName()));
        $customFileName = 'BON_DE_CAISSE_'.$this->bon->numero.'_'.$originalName.'_'.time().'.'.$this->file->getClientOriginalExtension();
        $this->file->storeAs('public/attachments', $customFileName);

        Document::create([
            'bon_de_caisse_id' => $this->bon->id,
            'path' => $customFileName,
            'name' => $originalName,
            'user_id' => auth()->id(),
            'size' => $this->file->getSize(),
        ]);
        $this->dispatch('new-attachment');
        $this->reset('file');
        $this->closeModal();
    }
}
