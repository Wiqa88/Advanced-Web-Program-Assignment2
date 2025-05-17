<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Will seed my application's database.
     */
    public function run(): void
    {
        $this->call([
            InstrumentSeeder::class,
        ]);
    }
}
