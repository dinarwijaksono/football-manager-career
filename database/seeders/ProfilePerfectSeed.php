<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Service\ClubService;
use App\Service\DateRunService;
use App\Service\DivisionService;
use App\Service\ProfileService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ProfilePerfectSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profileService = App::make(ProfileService::class);
        $dateRunService = App::make(DateRunService::class);
        $divisionService = App::make(DivisionService::class);
        $clubService = App::make(ClubService::class);

        $profile = Profile::select('*')->where('name', 'test')->get();
        $profile = collect($profile);

        if ($profile->isEmpty()) {
            $profileId = $profileService->create('test');
        } else {
            $profile = Profile::select('*')->where('name', 'test')->first();
            $profileId = $profile->id;
        }

        $dateRunService->create($profileId);
        $divisionService->makeALot($profileId);
        $clubService->makeALot($profileId);

        Log::info('profile perfect success', [
            'profile_id' => $profileId,
            'path' => "Database\Seeders\ProfilePerfectSeed"
        ]);
    }
}
