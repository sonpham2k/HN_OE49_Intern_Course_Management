<?php

namespace App\Repositories\TimeTable;

use App\Repositories\BaseRepository;
use App\Models\TimeTable;
use Illuminate\Support\Facades\DB;

class TimeTableRepository extends BaseRepository implements TimeTableRepositoryInterface
{
    public function getModel()
    {
        return TimeTable::class;
    }

    public function insertDB($attributes = [])
    {
        DB::table('timetables')->insert([
            'day' => $attributes['day'],
            'lesson' => $attributes['lesson'],
            'course_id' => $attributes['course_id'],
        ]);
    }
}
