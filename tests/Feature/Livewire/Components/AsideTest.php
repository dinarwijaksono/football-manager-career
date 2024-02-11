<?php

namespace Tests\Feature\Livewire\Components;

use App\Livewire\Components\Aside;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AsideTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Aside::class)
            ->assertStatus(200);
    }
}
