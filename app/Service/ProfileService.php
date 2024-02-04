<?php

namespace App\Service;

use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileService
{

    public function create(string $name): int
    {
        $id = Profile::insertGetId([
            'name' => $name,
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);

        Log::info('create profile success', ['id' => $id, 'name' => $name]);

        return $id;
    }
}
