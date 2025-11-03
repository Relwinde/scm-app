<?php

namespace App\Livewire\Modals\TransportInterne;

use App\Models\TransportInterne;
use LivewireUI\Modal\ModalComponent;

class ViewDocuments extends ModalComponent
{

    public TransportInterne $dossier;

    public function render()
    {

        $documents = $this->dossier->documents;
        
        return view('livewire.modals.transport-interne.view-documents', ['documents'=>$documents]);
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
