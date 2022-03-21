<?php

namespace Tests\Unit;

use App\Models\Course;
use App\Models\Semester;
use Tests\ModelTestCase;

class SemesterTest extends ModelTestCase
{
    protected $semester;

    public function setUp() : void
    {
        parent::setUp();
        $this->semester = new Semester();
    }

    public function tearDown() : void
    {
        unset($this->semester);
        parent::tearDown();
    }

    public function testSemesterContainsValidMethodProperties()
    {
        $fillable = ['name', 'begin', 'end', 'course_id'];
        $hidden = [];
        $guarded = ['*'];
        $visible = [];
        $casts = [
            'id' => 'int',
            'deleted_at' => 'datetime',
        ];

        $this->runConfigurationAssertions($this->semester, $fillable, $hidden, $guarded, $visible, $casts);
    }

    public function testCourseRelation()
    {
        $this->assertHasManyRelation($this->semester->courses(), $this->semester, new Course());
    }
}
