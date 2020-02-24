<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Models\Subscribe;
use App\Models\User;

class SubscribeRepo extends BaseRepository
{
    public $subscribe, $user, $plan;

    public function __construct(Subscribe $subscribe, User $user, Plan $plan)
    {
        $this->model = $subscribe;
        $this->subscribe = $subscribe;
        $this->user = $user;
        $this->plan = $plan;
    }

    public function del($user_id, $plan_id)
    {
        $this->model->where([
            'user_id' => $user_id,
            'plan_id' => $plan_id
        ])->delete();
    }


}
