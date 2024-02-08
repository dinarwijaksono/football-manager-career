<?php

namespace Tests\Feature\service;

use App\Models\Profile;
use App\Service\DivisionService;
use Database\Seeders\ProfileSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DivisionServiceTest extends TestCase
{
    public $divisionService;

    public function setUp(): void
    {
        parent::setUp();

        $this->divisionService = $this->app->make(DivisionService::class);

        $this->seed(ProfileSeeder::class);

        $profile = Profile::select('id', 'name')->first();

        session()->put('profileId', $profile->id);
        session()->put('profileName', $profile->name);
    }


    public function test_makeALot(): void
    {
        $userId = session()->get('profileId');

        $this->divisionService->makeALot($userId);

        $this->assertDatabaseHas('divisions', [
            'profile_id' => $userId,
            'region' => 'Asia',
            'country' => 'Indonesia',
            'name' => 'Indonesia Super liga'
        ]);

        $this->assertDatabaseHas('divisions', [
            'profile_id' => $userId,
            'region' => 'Asia',
            'country' => 'Indonesia',
            'name' => 'Indonesia liga 2',
        ]);
    }


    public function test_delete()
    {
        $profileId = session()->get('profileId');

        $this->divisionService->makeALot($profileId);

        $this->assertDatabaseHas('divisions', [
            'profile_id' => $profileId,
            'region' => 'Asia',
            'country' => 'Indonesia',
            'name' => 'Indonesia Super liga'
        ]);

        $this->assertDatabaseHas('divisions', [
            'profile_id' => $profileId,
            'region' => 'Asia',
            'country' => 'Indonesia',
            'name' => 'Indonesia liga 2',
        ]);


        $this->divisionService->delete($profileId);

        $this->assertDatabaseMissing('divisions', [
            'profile_id' => $profileId
        ]);
    }
}
