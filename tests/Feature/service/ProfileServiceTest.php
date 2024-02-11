<?php

namespace Tests\Feature\service;

use App\Models\Club;
use App\Models\Profile;
use App\Service\ProfileService;
use Database\Seeders\ProfilePerfectSeed;
use Database\Seeders\ProfileSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileServiceTest extends TestCase
{
    public $profileService;

    public function setUp(): void
    {
        parent::setUp();

        $this->profileService = $this->app->make(ProfileService::class);
    }

    public function test_create_sucess(): void
    {
        $name = "example-name" . mt_rand(1, 999);

        $response = $this->profileService->create($name);

        $this->assertIsInt($response);
        $this->assertDatabaseHas('profiles', [
            'id' => $response,
            'name' => $name
        ]);
    }


    public function test_getById()
    {
        $this->seed(ProfilePerfectSeed::class);

        $profile = Profile::select('*')->where('name', 'test')->first();

        $response = $this->profileService->getById($profile->id);

        // var_dump($response);

        $this->assertIsObject($response);
        $this->assertEquals($response->name, $profile->name);
        $this->assertEquals($response->managed_club, $profile->managed_club);
    }


    public function test_getTheList()
    {
        $this->seed(ProfileSeeder::class);
        $this->seed(ProfileSeeder::class);
        $this->seed(ProfileSeeder::class);
        $this->seed(ProfileSeeder::class);
        $this->seed(ProfileSeeder::class);

        $response = $this->profileService->getTheList();

        $this->assertIsObject($response);

        $response = collect($response);
        $this->assertEquals(5, $response->count());
    }

    public function test_updateManagedClub_failed_ProfileIdAndClubIdEmptyInDB()
    {
        $this->seed(ProfilePerfectSeed::class);

        $profile = Profile::select('*')->where('name', 'test')->first();

        $this->profileService->updateManagedClub($profile->id, 9999999);

        $profile2 = Profile::select('*')->where('name', 'test')->first();

        $this->assertNull($profile2->managed_club);
    }


    public function test_updateManagedClub_success()
    {
        $this->seed(ProfilePerfectSeed::class);

        $profile = Profile::select('*')->where('name', 'test')->first();

        $clubs = Club::select('*')->where('profile_id', $profile->id)->first();

        $this->profileService->updateManagedClub($profile->id, $clubs->id);

        $profile2 = Profile::select('*')->where('name', 'test')->first();

        $this->assertNull($profile->managed_club);
        $this->assertEquals($profile2->managed_club, $clubs->id);
    }



    public function test_delete()
    {
        $this->seed(ProfileSeeder::class);

        $this->assertDatabaseHas('profiles', [
            'name' => 'test'
        ]);

        $profile = Profile::select('*')->where('name', 'test')->first();

        $this->profileService->delete($profile->id);

        $this->assertDatabaseMissing('profiles', [
            'id' => $profile->id,
            'name' => 'test'
        ]);
    }
}
