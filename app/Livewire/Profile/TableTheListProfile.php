<?php

namespace App\Livewire\Profile;

use App\Service\ClubService;
use App\Service\DateRunService;
use App\Service\DivisionService;
use App\Service\ProfileService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TableTheListProfile extends Component
{
    protected $profileService;
    protected $dateRunService;
    protected $divisionService;
    protected $clubService;

    protected $listeners = [
        'do-delete' => 'render'
    ];

    public $profiles;

    public function boot()
    {
        $this->profileService = App::make(ProfileService::class);
        $this->dateRunService = App::make(DateRunService::class);
        $this->divisionService = App::make(DivisionService::class);
        $this->clubService = App::make(ClubService::class);

        $this->profiles = $this->profileService->getTheList();
    }

    public function doDelete(int $profileId)
    {
        try {
            DB::beginTransaction();

            $this->clubService->delete($profileId);
            $this->divisionService->delete($profileId);
            $this->dateRunService->delete($profileId);
            $this->profileService->delete($profileId);

            Log::info('Delete profile success', [
                'profile_id' => $profileId,
                'path' => "App\Livewire\Profile\TableTheListProfile"
            ]);

            DB::commit();

            $this->dispatch('do-delete');
        } catch (\Throwable $th) {

            Log::error('Delete profile failed', [
                'profile_id' => $profileId,
                'path' => "App\Livewire\Profile\TableTheListProfile",
                'message' => $th->getMessage(),
            ]);

            DB::rollBack();
        }
    }

    public function doCreateSession(int $profileId)
    {
        $profile = $this->profileService->getById($profileId);

        session()->put('profile_id', $profile->id);
        session()->put('profile_name', $profile->name);

        return redirect('/FMC');
    }

    public function render()
    {
        return view('livewire.profile.table-the-list-profile');
    }
}
