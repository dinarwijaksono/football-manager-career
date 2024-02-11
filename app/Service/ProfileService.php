<?php

namespace App\Service;

use App\Models\Club;
use App\Models\Profile;
use Exception;
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


    public function getById(int $profileId): Object
    {
        $profile = DB::table('profiles')
            ->join('date_runs', 'date_runs.profile_id', '=', 'profiles.id')
            ->leftJoin('clubs', 'profiles.managed_club', '=', 'clubs.id')
            ->select(
                'profiles.id',
                'profiles.name',
                'profiles.managed_club',
                'date_runs.date',
                'clubs.division_id',
                'clubs.name as club_name',
                'profiles.created_at',
                'profiles.updated_at'
            )
            ->where('profiles.id', $profileId)
            ->first();

        Log::info('get by id success', [
            'profile_id' => $profileId,
            'path' => "App\Service\ProfileService"
        ]);

        return $profile;
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


    // update
    public function updateManagedClub(int $profileId, int $clubId): void
    {
        try {

            // cek apakah profileId ada di database
            $profile = Profile::select('id')->where('id', $profileId)->get();
            if ($profile->isEmpty()) {
                throw new Exception("profileId tidak ada di database", 1);
            }

            // cek apakah clubId ada di database
            $club = Club::select('id')->where('profile_id', $profileId)->where('id', $clubId)->get();
            if ($club->isEmpty()) {
                throw new Exception("ClubId dengan profile club tidak ada di database", 1);
            }

            Profile::where('id', $profileId)->update([
                "managed_club" => $clubId,
                "updated_at" => round(microtime(true) * 1000)
            ]);

            Log::info("update managed club success", [
                'profile_id' => $profileId,
                'path' => "App\Service\ProfileService"
            ]);
        } catch (\Throwable $th) {

            Log::error("update managed club failed", [
                'profile_id' => $profileId,
                'path' => "App\Service\ProfileService",
                'message' => $th->getMessage()
            ]);
        }
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
