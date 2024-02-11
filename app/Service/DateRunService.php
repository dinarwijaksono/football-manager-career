<?php

namespace App\Service;

use App\Models\DateRun;
use App\Models\Profile;
use Exception;
use Illuminate\Support\Facades\Log;

class DateRunService
{
    // create
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


    // read
    // update
    public function update(int $profileId): void
    {
        try {
            // cek apakah profileId ada di database
            $profile = Profile::select('id')->where('id', $profileId)->get();
            if ($profile->isEmpty()) {
                throw new Exception("profile dengan id $profileId tidak ada", 1);
            }

            $dateRun = DateRun::select('profile_id', 'date')->where('profile_id', $profileId)->first();

            DateRun::where('profile_id', $profileId)->update([
                'date' => $dateRun->date + 86400,
                'updated_at' => round(microtime(true) * 1000)
            ]);

            Log::info("update date_run success", [
                'profile_id' => $profileId,
                'class' => "App\Service\DateRunServivce"
            ]);
        } catch (\Throwable $th) {
            Log::error("update date_run failed", [
                'profile_id' => $profileId,
                'class' => "App\Service\DateRunServivce",
                'message' => $th->getMessage()
            ]);
        }
    }


    // delete
    public function delete(int $profileId)
    {
        DateRun::where('profile_id', $profileId)
            ->delete();

        Log::info('delete date run success', [
            'profile_id' => $profileId,
            'path' => "App/Service/DateRunService"
        ]);
    }
}
