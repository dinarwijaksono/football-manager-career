<?php

namespace Tests\Feature\service;

use App\Models\Profile;
use App\Service\DateRunService;
use Database\Seeders\ProfileSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DateRunServiceTest extends TestCase
{
    public $dateRunService;

    public function setUp(): void
    {
        parent::setUp();

        $this->dateRunService = $this->app->make(DateRunService::class);

        $this->seed(ProfileSeeder::class);

        $profile = Profile::select('id', 'name')->first();

        session()->put('profileId', $profile->id);
        session()->put('profileName', $profile->name);
    }

    public function test_create_success(): void
    {
        $profileId = session()->get('profileId');

        $this->dateRunService->create($profileId);

        $this->assertDatabaseHas('date_runs', [
            'profile_id' => $profileId,
            'date' => mktime(0, 0, 0, 1, 1, 2000)
        ]);
    }

    public function test_delete()
    {
        $profileId = session()->get('profileId');

        $this->dateRunService->create($profileId);

        $this->assertDatabaseHas('date_runs', [
            'profile_id' => $profileId,
            'date' => mktime(0, 0, 0, 1, 1, 2000)
        ]);

        $this->dateRunService->delete($profileId);

        $this->assertDatabaseMissing('date_runs', [
            'profile_id' => $profileId
        ]);
    }
}
