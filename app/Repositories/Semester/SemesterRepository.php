<?php

namespace App\Repositories\Semester;

use App\Repositories\BaseRepository;
use App\Models\Semester;

class SemesterRepository extends BaseRepository implements SemesterRepositoryInterface
{
    public function getModel()
    {
        return Semester::class;
    }
}
