<?php

namespace App\Repositories;

use App\Ask;
use Illuminate\Database\Eloquent\Model;

class AskRepo extends BaseRepository
{
    public function __construct(Ask $ask)
    {
        $this->model = $ask;
    }
}
