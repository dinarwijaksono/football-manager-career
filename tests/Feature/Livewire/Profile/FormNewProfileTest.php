<?php

namespace Tests\Feature\Livewire\Profile;

use App\Livewire\Profile\FormNewProfile;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FormNewProfileTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(FormNewProfile::class)
            ->assertStatus(200);

        $this->get('/Home/new-profile')->assertSeeLivewire(FormNewProfile::class);
    }

    public function test_doCreateProfile_validateError()
    {
        Livewire::test(FormNewProfile::class)
            ->set('name', "te")
            ->call("doCreateProfile")
            ->assertHasErrors('name');

        $this->assertDatabaseMissing('profiles', ['name' => "test"]);
    }

    public function test_doCreateProfile()
    {
        Livewire::test(FormNewProfile::class)
            ->set('name', "test")
            ->call("doCreateProfile");

        $profile = Profile::select('*')->where('name', 'test')->first();

        $this->assertDatabaseHas('profiles', ['name' => "test"]);
        $this->assertDatabaseHas('date_runs', ['profile_id' => $profile->id]);
        $this->assertDatabaseHas('divisions', ['profile_id' => $profile->id]);
        $this->assertDatabaseHas('clubs', ['profile_id' => $profile->id]);
    }
}
