<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the categories table exists
        if (!Schema::hasTable('categories')) {
            // Table doesn't exist, so we can't proceed
            return;
        }

        // Get the test user or create one if it doesn't exist
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        $categories = [
            [
                'name' => 'String Instruments',
                'description' => 'Instruments that use strings to produce sound',
            ],
            [
                'name' => 'Percussion',
                'description' => 'Instruments that are played by being struck',
            ],
            [
                'name' => 'Wind Instruments',
                'description' => 'Instruments that use air to produce sound',
            ],
            [
                'name' => 'Keyboard Instruments',
                'description' => 'Instruments that have keyboard interfaces',
            ],
            [
                'name' => 'Electronic',
                'description' => 'Modern electronic instruments',
            ],
        ];

        foreach ($categories as $category) {
            // Create the category directly without checking if it exists
            // This avoids querying a potentially non-existent table
            $category['user_id'] = $user->id;
            Category::create($category);
        }
    }
}
