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

class FormNewProfile extends Component
{
    public $name;

    protected $profileService;
    protected $dateRunService;
    protected $divisionService;
    protected $clubService;

    public function boot()
    {
        $this->profileService = App::make(ProfileService::class);
        $this->dateRunService = App::make(DateRunService::class);
        $this->divisionService = App::make(DivisionService::class);
        $this->clubService = App::make(ClubService::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|min:4|unique:profiles,name'
        ];
    }

    public function doCreateProfile()
    {
        try {
            DB::beginTransaction();

            $validate = $this->validate();

            $profileId = $this->profileService->create($this->name);
            $this->dateRunService->create($profileId);
            $this->divisionService->makeALot($profileId);
            $this->clubService->makeALot($profileId);

            session()->put('profile_id', $profileId);

            Log::info('create profile success', [
                'profile_id' => $profileId,
                'profile_name' => $this->name,
                'path' => 'App\Livewire\Profile\FormNewProfile'
            ]);

            DB::commit();

            return redirect('/Profile/select-club');
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error('create profile failed', [
                'profile_name' => $this->name,
                'path' => 'FormNewProfile livewire class',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.profile.form-new-profile');
    }
}
