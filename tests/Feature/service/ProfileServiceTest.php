<?php

namespace Tests\Feature\service;

use App\Models\Profile;
use App\Service\ProfileService;
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
