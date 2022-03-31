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

    public function getAll()
    {
        return Semester::all();
    }

    public function getSemesterNow($semesNow, $year)
    {
        $semesters = Semester::where('name', $semesNow)
            ->where('begin', $year)
            ->firstOrFail();

        return $semesters;
    }
}
