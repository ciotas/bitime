<?php

namespace App\Policies;

use App\Models\Analyzer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnalyzerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manage(User $user, Analyzer $analyzer)
    {
        return $user->can('manage_trades');
    }
}
