<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserHeader extends Component
{
    public function render()
    {
        return view('livewire.layout.user-header');
    }

    public function logout (){
        Auth::logout();

        Session::invalidate();

        Session::regenerateToken();

        $this->redirect('/login');
    }
}
