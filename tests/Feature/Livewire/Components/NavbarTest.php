<?php

namespace Tests\Feature\Livewire\Components;

use App\Livewire\Components\Navbar;
use App\Models\DateRun;
use App\Models\Profile;
use Database\Seeders\ProfilePerfectSeed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NavbarTest extends TestCase
{
    public $profile;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(ProfilePerfectSeed::class);

        $this->profile = Profile::select('*')->where('name', 'test')->first();

        session()->put('profile_id', $this->profile->id);
        session()->put('profile_name', $this->profile->name);
    }


    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Navbar::class)
            ->assertStatus(200);
    }

    public function test_doNextDay_success()
    {
        $dateRun = DateRun::select('*')->where('profile_id', $this->profile->id)->first();

        Livewire::test(Navbar::class)
            ->call('doNextDay');

        // cek date_run
        $dateRun2 = DateRun::select('*')->where('profile_id', $this->profile->id)->first();

        $this->assertNotEquals($dateRun->date, $dateRun2->date);
        $this->assertEquals($dateRun->date + 24 * 60 * 60, $dateRun2->date);
    }
}
