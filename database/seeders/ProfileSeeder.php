<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profileTest = Profile::select('*')->where('name', 'test')->get();
        $profileTest = collect($profileTest);

        if ($profileTest->isEmpty()) {
            Profile::insert([
                'name' => 'test',
                'managed_club' => null,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);
        } else {
            Profile::insert([
                'name' => 'test-' . mt_rand(1, 999),
                'managed_club' => null,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);
        }

        Log::info('run profile seeder', ['path' => "Database/Seeders/ProfileSeeder"]);
    }
}
