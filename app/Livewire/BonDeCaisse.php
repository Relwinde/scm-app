<?php

namespace App\Livewire;

use App\Models\BonDeCaisse as ModelsBonDeCaisse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class BonDeCaisse extends Component
{

    public $search;
    public $start_bon_rows;
    public $actual_bon_rows;

    use WithPagination;

    public function mount (){
        include(app_path() . '/Snippets/BonDeCaisseQuery.php');
        $this->start_bon_rows = $bonsDeCaisse->total();
    }

    #[On('new-bon-de-caisse')]
    public function render()
    {
        include(app_path() . '/Snippets/BonDeCaisseQuery.php');

        $this->actual_bon_rows = $bonsDeCaisse->total();
        return view('livewire.bon-de-caisse', [
            'bonsDeCaisse' => $bonsDeCaisse, 'header_title'=>'Bons de caisse', 'create_modal'=>'modals.create-bon-de-caisse', 'button_title'=>'Nouveau bon'
        ]);
    }

    public function delete (ModelsBonDeCaisse $bon){
        if ($bon->etape != "EMETTEUR"){
            $this->dispatch('bon-delete-error');
        } else {
            $bon->delete();
            $this->dispatch('bon-delete-success');
        }
    }

    public function notificate(){
        if ($this->start_bon_rows != $this->actual_bon_rows){
            $this->dispatch('notification');
            $this->start_bon_rows = $this->actual_bon_rows;
        }
    }
}
