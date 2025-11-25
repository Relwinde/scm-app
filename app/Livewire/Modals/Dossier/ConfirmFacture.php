<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ConfirmFacture extends ModalComponent
{
    use WithFileUploads;

    public Dossier $dossier;
    public $numero_facture; 
    public $file; 


    public function render()
    {
        return view('livewire.modals.dossier.confirm-facture');
    }

    public function save (){
        if (! auth()->user()->can('Facturer un dossier')) {
            $this->dispatch('not-allowed');
            return;
        }

        $this->validate([
            'file' => 'required|mimes:pdf|max:5120', // 5MB Max
            'numero_facture' => 'required|string|max:255',
        ],
        [
            'file.mimes' => 'Le fichier doit être un document PDF.',
            'file.max' => 'Le fichier ne doit pas dépasser 5MB.',
            'numero_facture.required' => 'Le numéro de la facture est requis.',
            'numero_facture.string' => 'Le numéro de la facture doit être une chaîne de caractères.',
            'numero_facture.max' => 'Le numéro de la facture ne doit pas dépasser 255 caractères.'
        ]);


        $originalName = strtoupper(preg_replace('/\.pdf$/i', '', $this->file->getClientOriginalName()));
        $fileName = 'FACTURE-SCM_' . str_replace('/', '-', $this->dossier->numero) . '.' . $this->file->getClientOriginalExtension();

        
        try {
            DB::beginTransaction();
            $this->dossier->numero_facture_scm = $this->numero_facture;

            try { 
                $this->dossier->transitionTo('fact', auth()->user()->id);
            } catch (\Throwable $th) {
                $this->dispatch('status-transition-error');
                return;
            }

            $path = $this->file->storeAs('attachments/dossiers/' . str_replace('/', '-', $this->dossier->numero), $fileName);

            Document::create([
                'dossier_id' => $this->dossier->id,
                'path' => $path,
                'type' => 'FACTURE SCM',
                'name' => $fileName,
                'user_id' => auth()->id(),
                'size' => $this->file->getSize(),
            ]);

            $this->dossier->save();
            $this->dossier->refresh();

            DB::commit();

            $this->dispatch('update-dossier');
            $this->dispatch('facture-confirmed');
            $this->dispatch('closeModal');

        } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }


    }
}
