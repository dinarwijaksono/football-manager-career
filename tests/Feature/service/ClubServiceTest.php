<?php

namespace Tests\Feature\service;

use App\Models\Profile;
use App\Service\ClubService;
use App\Service\DivisionService;
use Database\Seeders\ProfileSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClubServiceTest extends TestCase
{
    public $divisionService;
    public $clubService;

    public function setUp(): void
    {
        parent::setUp();

        $this->divisionService = $this->app->make(DivisionService::class);
        $this->clubService = $this->app->make(ClubService::class);

        $this->seed(ProfileSeeder::class);

        $profile = Profile::select('id', 'name')->first();

        $this->divisionService->makeALot($profile->id);

        session()->put('profileId', $profile->id);
        session()->put('profileName', $profile->name);
    }

    public function test_makeALot(): void
    {
        $profileId = session()->get('profileId');

        $this->clubService->makeALot($profileId);

        $this->assertDatabaseCount('clubs', 44);
    }


    public function test_getClubs()
    {
        $profileId = session()->get('profileId');

        $this->clubService->makeALot($profileId);

        $response = $this->clubService->getClubs($profileId);

        $this->assertIsObject($response);

        $clubs = collect($response);
        $this->assertTrue($clubs->isNotEmpty());
    }


    public function test_delete()
    {
        $profileId = session()->get('profileId');

        $this->clubService->makeALot($profileId);

        $this->assertDatabaseCount('clubs', 44);
        $this->assertDatabaseHas('clubs', [
            'profile_id' => $profileId
        ]);

        $this->clubService->delete($profileId);

        $this->assertDatabaseMissing('clubs', [
            'profile_id' => $profileId
        ]);
    }
}
