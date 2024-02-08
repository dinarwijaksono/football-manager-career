<?php

namespace Tests\Feature\Livewire\Profile;

use App\Livewire\Profile\TableTheListProfile;
use App\Models\Profile;
use Database\Seeders\ProfilePerfectSeed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TableTheListProfileTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(TableTheListProfile::class)
            ->assertStatus(200);

        $this->get('Profile/load-profile')
            ->assertSeeLivewire(TableTheListProfile::class);
    }

    public function test_delete_failed()
    {
        Livewire::test(TableTheListProfile::class)
            ->call('doDelete', 1234123);

        $this->assertDatabaseMissing('profiles', ['id' => 1234123]);
        $this->assertDatabaseMissing('date_runs', ['profile_id' => 1234123]);
        $this->assertDatabaseMissing('divisions', ['profile_id' => 1234123]);
        $this->assertDatabaseMissing('clubs', ['profile_id' => 1234123]);
    }


    public function test_delete_success()
    {
        $this->seed(ProfilePerfectSeed::class);

        $profile = Profile::select('*')->where('name', 'test')->first();

        Livewire::test(TableTheListProfile::class)
            ->call('doDelete', $profile->id);

        $this->assertDatabaseMissing('profiles', ['id' => $profile->id]);
        $this->assertDatabaseMissing('date_runs', ['profile_id' => $profile->id]);
        $this->assertDatabaseMissing('divisions', ['profile_id' => $profile->id]);
        $this->assertDatabaseMissing('clubs', ['profile_id' => $profile->id]);
    }


    public function test_doCreateSession()
    {
        $this->seed(ProfilePerfectSeed::class);

        $profile = Profile::select('*')->where('name', 'test')->first();

        Livewire::test(TableTheListProfile::class)
            ->call('doCreateSession', $profile->id)
            ->assertRedirect('/FMC');

        $this->assertEquals('test', session()->get('profile_name'));
        $this->assertEquals($profile->id, session()->get('profile_id'));
    }
}
