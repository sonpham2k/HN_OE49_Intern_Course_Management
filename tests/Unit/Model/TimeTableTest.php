<?php

namespace Tests\Unit;

use App\Models\TimeTable;
use PHPUnit\Framework\TestCase;
use Tests\ModelTestCase;
use App\Models\Course;

class TimeTableTest extends ModelTestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $timetable;

    public function setUp(): void
    {
        parent::setUp();
        $this->timetable = new TimeTable();
    }

    public function tearDown(): void
    {
        unset($this->timetable);
        parent::tearDown();
    }

    public function testTimeTableContainsValidMethodProperties()
    {
        $fillable = ['day', 'lesson', 'course_id'];
        $hidden = [];
        $guarded = ['*'];
        $visible = [];
        $casts = [
            'id' => 'int',
            'deleted_at' => 'datetime',
        ];

        $this->runConfigurationAssertions($this->timetable, $fillable, $hidden, $guarded, $visible, $casts);
    }

    public function testTimeTableRelation()
    {
        $this->assertBelongsToRelation($this->timetable->course(), $this->timetable, new Course(), 'course_id');
    }
}
