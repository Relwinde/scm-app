<?php

namespace App\Livewire\Modals\Dossier;

use Mpdf\Mpdf;
use App\Models\Dossier;
use App\Models\DeliverySlip;
use LivewireUI\Modal\ModalComponent;

class PrintDeliverySlip extends ModalComponent
{

    public Dossier $dossier;

    public $observation;

    public $date;

    public $first_name;

    public $last_name;
    
    public function mount()
    {
        if ($this->dossier->delivery_slip) {
            $this->observation = $this->dossier->delivery_slip->observation;
            $this->date = $this->dossier->delivery_slip->date;
            $this->first_name = $this->dossier->delivery_slip->first_name;
            $this->last_name = $this->dossier->delivery_slip->last_name;
        } else {
            $this->observation = '';
            $this->date = now()->format('Y-m-d');
        }
    }

    public function render()
    {
        return view('livewire.modals.dossier.print-delivery-slip', ['dossier'=>$this->dossier]);
    }


    public function printDeliverySlip()
    {
        if ($this->dossier->delivery_slip) {
            $slip = $this->dossier->delivery_slip;
        } else {
            $slip = new DeliverySlip();
            if (DeliverySlip::latest()->first())
            {$slip->numero = date('Y').str_pad(DeliverySlip::latest()->first()->id+1, 7, '0', STR_PAD_LEFT);
            } else {
                $slip->numero = date('Y').str_pad(1, 7, '0', STR_PAD_LEFT);
            }
        }

        $slip->dossier_id = $this->dossier->id;
        $slip->date = $this->date;
        $slip->user_id = auth()->user()->id;
        $slip->observation = $this->observation;
        $slip->first_name = $this->first_name;
        $slip->last_name = $this->last_name;
        $slip->save();
        return redirect()->route('print-delivery', ['dossier' => $this->dossier->id]);
        $this->closeModal();

    }
}
