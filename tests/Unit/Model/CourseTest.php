<?php

namespace Tests\Unit;

use App\Models\Course;
use App\Models\User;
use App\Models\Semester;
use App\Models\TimeTable;
use Tests\ModelTestCase;

class CourseTest extends ModelTestCase
{
    protected $course;

    public function setUp(): void
    {
        parent::setUp();
        $this->course = new Course();
    }

    public function tearDown(): void
    {
        unset($this->course);
        parent::tearDown();
    }

    public function testCourseContainsValidMethodProperties()
    {
        $fillable = ['name', 'credit'];
        $hidden = [];
        $guarded = ['*'];
        $visible = [];
        $casts = [
            'id' => 'int',
            'deleted_at' => 'datetime',
        ];

        $this->runConfigurationAssertions($this->course, $fillable, $hidden, $guarded, $visible, $casts);
    }

    public function testCourseRelation()
    {
        $this->assertBelongsToRelation($this->course->semester(), $this->course, new Semester(), 'semester_id');
        $this->assertHasManyRelation($this->course->timetables(), $this->course, new TimeTable());
        $this->assertBelongsToManyRelation(
            $this->course->users(),
            $this->course,
            new User(),
            'course_user.course_id',
            'course_user.user_id'
        );
    }
}
