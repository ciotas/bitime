<?php

namespace App\Policies;

use App\Models\Ask;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AskPolicy
{
    use HandlesAuthorization;

    public function own(User $user, Ask $ask)
    {
        return $user->id === $ask->user_id;
    }
}
