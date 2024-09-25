<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;

class Login extends Component
{
    #[Rule(['required'])]
    public $userName;

    #[Rule(['required'])]
    public $password;

    public function render()
    {
        return view('livewire.login')->layout('layouts.custom-master');
    }
}
