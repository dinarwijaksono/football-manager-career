<?php

namespace Tests\Feature\service;

use App\Models\DateRun;
use App\Models\Profile;
use App\Service\DateRunService;
use Database\Seeders\ProfilePerfectSeed;
use Database\Seeders\ProfileSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DateRunServiceTest extends TestCase
{
    public $dateRunService;
    public $profile;

    public function setUp(): void
    {
        parent::setUp();

        $this->dateRunService = $this->app->make(DateRunService::class);

        $this->seed(ProfileSeeder::class);

        $this->profile = Profile::select('id', 'name')->where('name', 'test')->first();

        session()->put('profileId', $this->profile->id);
        session()->put('profileName', $this->profile->name);
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


    public function test_update_success()
    {
        $this->seed(ProfilePerfectSeed::class);

        $dateRun = DateRun::select('*')->where('profile_id', $this->profile->id)->first();

        $this->dateRunService->update($this->profile->id);

        $dateRun2 = DateRun::select('*')->where('profile_id', $this->profile->id)->first();

        $dateNew = $dateRun->date + 24 * 60 * 60;

        $this->assertNotEquals($dateRun->date, $dateRun2->date);
        $this->assertEquals($dateRun2->date, $dateNew);
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
