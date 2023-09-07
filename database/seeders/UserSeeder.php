<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    const USERS_COUNT = 10000;
    const CHUNK_SIZE = 1000;
    
    public function run(): void
    {
        $data = [];

        for ($i = 0; $i < static::USERS_COUNT; $i++) {
            $data[] = [
                'name' => fake()->name,
                'email' => fake()->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => \Str::random(10),
            ];
        }

        $chunks = array_chunk($data, static::CHUNK_SIZE);

        foreach ($chunks as $chunk) {
            DB::table('users')->insert($chunk);
        }
    }
}
