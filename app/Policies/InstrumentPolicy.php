<?php

namespace App\Policies;

use App\Models\Instrument;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstrumentPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user): bool
    {
        return true;
    }


    public function view(User $user, Instrument $instrument): bool
    {
        return $user->id === $instrument->user_id;
    }


    public function create(User $user): bool
    {
        return true;
    }


    public function update(User $user, Instrument $instrument): bool
    {
        return $user->id === $instrument->user_id;
    }


    public function delete(User $user, Instrument $instrument): bool
    {
        return $user->id === $instrument->user_id;
    }
}
