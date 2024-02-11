<?php

namespace App\Service;

use App\Models\Club;
use App\Models\Division;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClubService
{
    public function makeALot(int $profileId): void
    {
        $division = Division::select('*')->get();

        $clubs = collect([]);

        foreach ($division as $key) {
            if ($key->country == "Indonesia" && $key->level == 1) {
                for ($i = 0; $i < 20; $i++) :

                    $name = fake('id_ID')->city();
                    if (($clubs->where('name', $name)->isNotEmpty())) {
                        $name .= ' 2';
                    }

                    $clubs->push([
                        'profile_id' => $profileId,
                        'division_id' => $key->id,
                        'name' => $name,
                        'created_at' => round(microtime(true) * 1000),
                        'updated_at' => round(microtime(true) * 1000),
                    ]);
                endfor;
            }

            if ($key->country == "Indonesia" && $key->level == 2) {
                for ($i = 0; $i < 24; $i++) :
                    $name = fake('id_ID')->city();
                    if (($clubs->where('name', $name)->isNotEmpty())) {
                        $name .= ' 2';
                    }

                    $clubs->push([
                        'profile_id' => $profileId,
                        'division_id' => $key->id,
                        'name' => $name,
                        'created_at' => round(microtime(true) * 1000),
                        'updated_at' => round(microtime(true) * 1000),
                    ]);
                endfor;
            }
        }

        Club::insert($clubs->toArray());

        Log::info('Make a lot the club success', ['profile_id' => $profileId]);
    }

    public function getClubs(int $profileId): object
    {
        $club = DB::table('clubs')
            ->join('divisions', 'divisions.id', '=', 'clubs.division_id')
            ->select(
                'clubs.id',
                'clubs.name',
                'clubs.division_id',
                'divisions.region',
                'divisions.country',
                'divisions.name as division_name',
                'divisions.level'
            )
            ->where('clubs.profile_id', $profileId)
            ->orderBy('divisions.level')
            ->get();

        Log::info('Get clubs success', ['profile_id' => $profileId, 'path' => 'App/Service/ClubService']);

        return $club;
    }


    public function getTheList(int $profileId): object
    {
        try {
            $club = DB::table('clubs')
                ->join('divisions', 'divisions.id', '=', 'clubs.division_id')
                ->select(
                    'clubs.id',
                    'clubs.name',
                    'clubs.division_id',
                    'divisions.region',
                    'divisions.country',
                    'divisions.name as division_name',
                    'divisions.level',
                    'clubs.created_at',
                    'clubs.updated_at',
                )
                ->where('clubs.profile_id', $profileId)
                ->orderBy('divisions.level')
                ->get();

            Log::info('Get the list clubs success', [
                'profile_id' => $profileId,
                'path' => 'App\Service\ClubService'
            ]);

            return $club;
        } catch (\Throwable $th) {
            Log::info('Get the list clubs failed', [
                'profile_id' => $profileId,
                'path' => 'App\Service\ClubService',
                'message' => $th->getMessage()
            ]);

            return collect([]);
        }
    }


    public function delete(int $profileId): void
    {
        Club::where('profile_id', $profileId)
            ->delete();

        Log::info("delete Club success", [
            'profile_id' => $profileId,
            'path' => "App/Service/ClubService"
        ]);
    }
}
