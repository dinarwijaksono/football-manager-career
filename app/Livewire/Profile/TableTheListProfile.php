<?php

namespace App\Livewire\Profile;

use App\Service\ProfileService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class TableTheListProfile extends Component
{
    protected $profileService;

    public $profiles;

    public function boot()
    {
        $this->profileService = App::make(ProfileService::class);

        $this->profiles = $this->profileService->getTheList();
    }

    public function render()
    {
        return view('livewire.profile.table-the-list-profile');
    }
}
