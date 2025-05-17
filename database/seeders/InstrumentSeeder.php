<?php

namespace Database\Seeders;

use App\Models\Instrument;
use App\Models\User;
use Illuminate\Database\Seeder;

class InstrumentSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        $instruments = [
        ];

        foreach ($instruments as $instrument) {
            $instrument['user_id'] = $user->id;
            Instrument::create($instrument);
        }
    }
}
