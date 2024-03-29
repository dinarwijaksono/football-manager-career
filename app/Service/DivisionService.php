<?php

namespace App\Service;

use App\Models\Division;
use Illuminate\Support\Facades\Log;

class DivisionService
{
    public function makeALot(int $profileId)
    {
        Division::insert([
            [
                'profile_id' => $profileId,
                'region' => "Asia",
                'country' => "Indonesia",
                'name' => "Indonesia Super liga",
                'level' => 1,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ],
            [
                'profile_id' => $profileId,
                'region' => 'Asia',
                'country' => 'Indonesia',
                'name' => 'Indonesia liga 2',
                'level' => 2,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]
        ]);

        Log::info('make a lot the division success', [
            'profile_id' => $profileId,
            'path' => "App/Service/DivisionService"
        ]);
    }


    public function delete(int $profileId)
    {
        Division::where('profile_id', $profileId)->delete();

        Log::info('delete division success', [
            'profile_id' => $profileId,
            'path' => "App/Service/DivisionService"
        ]);
    }
}
