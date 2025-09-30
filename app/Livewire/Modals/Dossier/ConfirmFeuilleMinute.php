<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use App\Models\Document;
use App\Models\Repertoire;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ConfirmFeuilleMinute extends ModalComponent
{
    use WithFileUploads;

    public Dossier $dossier;
    public $file;
    public $regime;

    public function render()
    {
        return view('livewire.modals.dossier.confirm-feuille-minute');
    }

    public function confirm()
    {
        if (! Auth::user()->can('Confirmer une feuille minute')) {
            $this->dispatch('not-allowed');
            return;
        }

        if ($this->dossier->status?->code != 'fm_prov'){
            $this->dispatch('not-allowed');
            return;
        }

        $this->validate([
            'file' => 'required|mimes:pdf|max:5120', // 5MB Max
            'regime' => 'required|in:TTC,EXO',
        ],[
            'file.required' => 'Le fichier est obligatoire',
            'file.mimes' => 'Le fichier doit être un fichier PDF',
            'file.max' => 'Le fichier ne doit pas dépasser 5MB',
            'regime.required' => 'Le régime douanier est obligatoire',
            'regime.in' => 'Le régime douanier doit être TTC ou EXO',
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

        $this->dossier->num_repertoire = $this->dossier->bureau_de_douane->code.'-'.$repertoire->year . '/' . str_pad($repertoire->last_number, 5, '0', STR_PAD_LEFT);

        $originalName = strtoupper(preg_replace('/\.pdf$/i', '', $this->file->getClientOriginalName()));
        $fileName = 'FACTURE_COMMERCIALE_' .str_replace('/', '-', $this->dossier->num_repertoire) .'.'. $this->file->getClientOriginalExtension();
        
        
        try {
            $this->dossier->transitionTo('fm_def', Auth::user()->id);
        } catch (\Throwable $th) {
            $this->dispatch('status-transition-error');
            return;
        }
        $path = $this->file->storeAs('attachments/dossiers/' . str_replace('/', '-', $this->dossier->numero), $fileName);
        Document::create([
            'dossier_id' => $this->dossier->id,
            'path' => $path,
            'type' => 'FACTURE COMMERCIALE',
            'name' => $fileName,
            'user_id' => auth()->id(),
            'size' => $this->file->getSize(),
        ]);


        $repertoire->save();
        $this->dossier->regime = $this->regime;
        $this->dossier->save();
        $this->dossier->refresh();
        $this->dispatch('update-dossier');
        $this->dispatch('feuille-minute-confirmed');
        $this->dispatch('closeModal');

    }
}
