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
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
            ]
        );

        Instrument::whereNull('user_id')->update(['user_id' => $user->id]);
    }


    public function down(): void
    {
    }
};
