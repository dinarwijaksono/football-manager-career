<?php

namespace App\Service;

use App\Models\Club;
use App\Models\Division;
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
}
