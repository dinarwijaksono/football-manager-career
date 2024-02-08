<?php

namespace Tests\Feature\Livewire\Profile;

use App\Livewire\Profile\TableTheListProfile;
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
}
