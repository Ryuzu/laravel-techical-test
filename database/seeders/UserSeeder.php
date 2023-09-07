<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($i = 0; $i < 1000; $i++) {
            $data[] = [
                'name' => fake()->name,
                'email' => fake()->unique()->safeEmail,
                'email_verified_at' => fake()->dateTime,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => \Str::random(10),
            ];
        }

        $chunks = array_chunk($data, 1000);

        foreach ($chunks as $chunk) {
            DB::table('users')->insert($chunk);
        }
    }
}
