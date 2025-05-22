<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Instrument;

return new class extends Migration
{

    public function up(): void
    {
        // Create a default user if it doesn't exist
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Associate all existing instruments with this user
        Instrument::whereNull('user_id')->update(['user_id' => $user->id]);
    }


    public function down(): void
    {
    }
};
