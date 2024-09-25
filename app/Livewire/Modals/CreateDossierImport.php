<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

class CreateDossierImport extends ModalComponent
{
    public function render()
    {
        return view('livewire.modals.create-dossier-import');
    }

/**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }
    public static function destroyOnClose(): bool
    {
        return true;
    }
}
