<?php

namespace Tests\Feature\Livewire\Club;

use App\Livewire\Club\TableTheListClub;
use App\Models\Club;
use App\Models\Profile;
use Database\Seeders\ProfilePerfectSeed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TableTheListClubTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(ProfilePerfectSeed::class);

        $profile = Profile::select('*')->where('name', 'test')->first();

        session()->put('profile_id', $profile->id);
        session()->put('profile_name', $profile->name);
    }


    /** @test */
    public function renders_successfully()
    {
        Livewire::test(TableTheListClub::class)
            ->assertStatus(200);
    }


    public function test_doSelectClub()
    {
        $club = Club::select('*')->where('profile_id', session()->get('profile_id'))->first();

        Livewire::test(TableTheListClub::class)
            ->call('doSelectClub', $club->id)
            ->assertRedirect("/FMC");

        $this->assertDatabaseHas('profiles', [
            'id' => session()->get('profile_id'),
            'managed_club' => $club->id
        ]);
    }
}
