<?php

namespace App\Service;

use App\Models\DateRun;
use Illuminate\Support\Facades\Log;

class DateRunService
{
    public function create(int $profileId): void
    {
        DateRun::insert([
            'profile_id' => $profileId,
            'date' => mktime(0, 0, 0, 1, 1, 2000),
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);

        Log::info('create date run success', ['profile_id' => $profileId]);
    }
}
