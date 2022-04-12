<?php

namespace App\Repositories\Year;

use App\Repositories\BaseRepository;
use App\Models\Year;
use Illuminate\Support\Facades\DB;

class YearRepository extends BaseRepository implements YearRepositoryInterface
{
    public function getModel()
    {
        return Year::class;
    }

    public function allYear()
    {
        return Year::all();
    }
}
