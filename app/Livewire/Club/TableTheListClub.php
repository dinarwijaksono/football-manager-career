<?php

namespace App\Livewire\Club;

use App\Service\ClubService;
use App\Service\ProfileService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TableTheListClub extends Component
{
    public $clubs;

    protected $profileService;
    protected $clubService;

    function boot()
    {
        $this->profileService = App::make(ProfileService::class);
        $this->clubService = App::make(ClubService::class);

        $this->clubs = $this->clubService->getTheList(session()->get('profile_id'));
    }


    public function doSelectClub(int $clubId)
    {
        $this->profileService->updateManagedClub(session()->get('profile_id'), $clubId);

        Log::info("doSelectClub success", [
            'profile_id' => session()->get('profile_id'),
            'class' => "App\Livewire\TableTheListClub",
        ]);

        return redirect("/FMC");
    }


    public function render()
    {
        return view('livewire.club.table-the-list-club');
    }
}
