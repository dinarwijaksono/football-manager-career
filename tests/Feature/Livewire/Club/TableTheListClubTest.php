<?php

namespace Tests\Feature\Livewire\Club;

use App\Livewire\Club\TableTheListClub;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TableTheListClubTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(TableTheListClub::class)
            ->assertStatus(200);
    }
}
