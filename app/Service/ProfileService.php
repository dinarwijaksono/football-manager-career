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
            'managed_club' => null,
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);

        Log::info('create profile success', ['id' => $id, 'name' => $name]);

        return $id;
    }

    public function getTheList(): object
    {
        $profiles = Profile::select(
            'id',
            'name',
            'managed_club',
            'created_at',
            'updated_at'
        )->orderBy('created_at')
            ->get();

        Log::info('get the list success', [
            'path' => "App/Service/ProfileService"
        ]);

        return $profiles;
    }


    public function delete(int $profileId): void
    {
        Profile::where('id', $profileId)->delete();

        Log::info('delete profile success', [
            'profileId' => $profileId,
            'path' => "App/Service/ProfileService"
        ]);
    }
}
