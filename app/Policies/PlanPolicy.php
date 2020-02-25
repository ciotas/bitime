<?php

namespace App\Policies;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    public function own(User $user, Plan $plan)
    {
        $users = $plan->users->pluck('id')->toArray();
        return in_array($user->id, $users) ? true : false;
    }
}
