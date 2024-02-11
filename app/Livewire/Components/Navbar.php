<?php

namespace App\Livewire\Components;

use App\Service\ProfileService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Navbar extends Component
{
    public $profile;

    public function boot()
    {
        $profileService = App::make(ProfileService::class);

        $this->profile = $profileService->getById(session()->get('profile_id'));
    }

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
