<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Instrument;
use App\Models\User;
use Illuminate\Database\Seeder;

class InstrumentCategorySeeder extends Seeder
{

    public function run(): void
    {
        // Get the test user
        $user = User::where('email', 'test@example.com')->first();

        if (!$user) {
            return;
        }

        // Get categories
        $stringCategory = Category::where('name', 'String Instruments')
            ->where('user_id', $user->id)
            ->first();

        $percussionCategory = Category::where('name', 'Percussion')
            ->where('user_id', $user->id)
            ->first();

        $windCategory = Category::where('name', 'Wind Instruments')
            ->where('user_id', $user->id)
            ->first();

        $keyboardCategory = Category::where('name', 'Keyboard Instruments')
            ->where('user_id', $user->id)
            ->first();

        $electronicCategory = Category::where('name', 'Electronic')
            ->where('user_id', $user->id)
            ->first();

        if (!$stringCategory || !$percussionCategory || !$windCategory || !$keyboardCategory || !$electronicCategory) {
            return;
        }

        // Assign categories to instruments based on type
        Instrument::where('user_id', $user->id)->each(function ($instrument) use (
            $stringCategory,
            $percussionCategory,
            $windCategory,
            $keyboardCategory,
            $electronicCategory
        ) {
            $categories = [];

            // Map instrument types to categories
            if (in_array($instrument->type, ['Acoustic Guitar', 'Electric Guitar', 'Bass Guitar', 'Violin', 'Cello', 'Ukulele'])) {
                $categories[] = $stringCategory->id;
            }

            if (in_array($instrument->type, ['Drums'])) {
                $categories[] = $percussionCategory->id;
            }

            if (in_array($instrument->type, ['Sax', 'Trumpet', 'Flute', 'Clarinet', 'Harmonica'])) {
                $categories[] = $windCategory->id;
            }

            if (in_array($instrument->type, ['Piano', 'Keyboard'])) {
                $categories[] = $keyboardCategory->id;
            }

            if (in_array($instrument->type, ['Synth', 'Electric Guitar', 'Bass Guitar', 'Keyboard'])) {
                $categories[] = $electronicCategory->id;
            }

            // Sync the categories
            $instrument->categories()->sync($categories);
        });
    }
}
