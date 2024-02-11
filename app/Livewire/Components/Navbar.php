<?php

namespace App\Livewire\Components;

use App\Service\DateRunService;
use App\Service\ProfileService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;

class Navbar extends Component
{
    public $profile;

    protected $profileService;
    protected $dateRunService;

    public function boot()
    {
        $this->profileService = App::make(ProfileService::class);

        $this->dateRunService = App::make(DateRunService::class);

        $this->profile = $this->profileService->getById(session()->get('profile_id'));
    }

    public function doLogout()
    {
        Log::info("do logout success", [
            'profile_id' => $this->profile->id,
            'class' => "App\Livewire\Navbar"
        ]);

        session()->forget('profile_id');

        return redirect('/');
    }

    public function doNextDay()
    {
        try {
            DB::beginTransaction();

            $this->dateRunService->update($this->profile->id);

            Log::info("do next day success", [
                'profile_id' => $this->profile->id,
                'class' => "App\Livewire\Navbar"
            ]);

            $this->dispatch("do-next-day");

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("do next day failed", [
                'profile_id' => $this->profile->id,
                'class' => "App\Livewire\Navbar",
                'message' => $th->getMessage()
            ]);
        }
    }


    #[On('do-next-day')]
    public function render()
    {
        return view('livewire.components.navbar');
    }
}
