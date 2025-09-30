<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use LivewireUI\Modal\ModalComponent;

class ViewDocuments extends ModalComponent
{

    public Dossier $dossier;

    public function render()
    {
        $documents = $this->dossier->documents;
        return view('livewire.modals.dossier.view-documents', ['documents'=>$documents]);
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
    
}
