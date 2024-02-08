<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Navbar extends Component
{
    public function doLogout()
    {
        session()->forget('profile_id');

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.components.navbar');
    }
}
