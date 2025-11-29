<?php

namespace App\Livewire\Modals\BonDeCaisse;

use Exception;
use App\Models\BonDeCaisse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use App\Models\BonDeCaisseCommentaire;

class AddComment extends ModalComponent
{

    public BonDeCaisse $bon;
    public $commentaire;

    public function render()
    {
        return view('livewire.modals.bon-de-caisse.add-comment');
    }

    public function create (){

        try{
            DB::beginTransaction();
            BonDeCaisseCommentaire::create([
                'etape' => "EMETTEUR",
                'content' => $this->commentaire,
                'bon_de_caisse_id' => $this->bon->id,
                'user_id' => Auth::user()->id,
            ]);
            DB::commit();
            $this->dispatch('vente-created');
            $this->reset();
            $this->closeModal();

        }
        catch(Exception $ex){
            DB::rollBack();
            throw $ex;
        }

    }
}
