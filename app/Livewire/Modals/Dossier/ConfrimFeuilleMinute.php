<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use Livewire\Component;
use App\Models\Document;
use App\Models\Repertoire;

class ConfirmFeuilleMinute extends Component
{

    public Dossier $dossier;
    public $file;

    public function render()
    {
        return view('livewire.modals.dossier.confirm-feuille-minute');
    }

    public function confirm()
    {
        $this->validate([
            'file' => 'required|mimes:pdf|max:5120', // 5MB Max
        ]);

        $repertoire = \App\Models\Repertoire::firstOrCreate(
            [
                'year' => date('Y'),
                'bureau_de_douane_id' => $this->dossier->bureau_de_douane->id,
            ],
            [
                'last_number' => 0,
            ]
        );
        $repertoire->last_number += 1;
        $repertoire->save();

        $this->dossier->num_repertoire = $this->dossier->bureau_de_douane->code.'-'.$repertoire->year . '/' . str_pad($repertoire->last_number, 5, '0', STR_PAD_LEFT);

        $originalName = strtoupper(preg_replace('/\.pdf$/i', '', $this->file->getClientOriginalName()));
        $fileName = 'FACTURE_COMMERCIALE_' . $this->dossier->num_repertoire . $this->file->getClientOriginalExtension();
        
        $this->file->storeAs('public/dossiers/' . $this->dossier->numero, $fileName);

        Document::create([
            'dossier_id' => $this->dossier->id,
            'path' => 'dossiers/' . $this->dossier->numero . '/' . $fileName,
            'name' => $originalName,
            'user_id' => auth()->id(),
            'size' => $this->file->getSize(),
        ]);

        $this->dossier->save();
        $this->dossier->refresh();
        $this->dossier->transitionTo('fm_def', Auth::user()->id);
        $this->dispatch('new-dossier');
        $this->dispatch('feuille-minute-confirmed');
        $this->dispatch('closeModal');

    }
}
