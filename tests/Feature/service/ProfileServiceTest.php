<?php

namespace Tests\Feature\service;

use App\Service\ProfileService;
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
}
