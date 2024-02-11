<?php

namespace App\Livewire\Club;

use App\Service\ClubService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class TableTheListClub extends Component
{
    public $clubs;

    protected $clubService;

    function boot()
    {
        $this->clubService = App::make(ClubService::class);

        $this->clubs = $this->clubService->getTheList(session()->get('profile_id'));
    }

    public function render()
    {
        return view('livewire.club.table-the-list-club');
    }
}
