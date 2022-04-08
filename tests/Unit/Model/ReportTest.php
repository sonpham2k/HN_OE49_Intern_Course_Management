<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Report;
use Tests\ModelTestCase;

class ReportTest extends ModelTestCase
{
    protected $report;

    public function setUp(): void
    {
        parent::setUp();
        $this->report = new Report();
    }

    public function tearDown(): void
    {
        unset($this->report);
        parent::tearDown();
    }

    public function testUserContainsValidMethodProperties()
    {
        $fillable = ['user_id', 'subscribers', 'year'];
        $hidden = [];
        $guarded = ['*'];
        $visible = [];
        $casts = [
            'id' => 'int',
            'deleted_at' => 'datetime',
        ];

        $this->runConfigurationAssertions($this->report, $fillable, $hidden, $guarded, $visible, $casts);
    }

    public function testUserRelation()
    {
        $this->assertBelongsToRelation($this->report->user(), $this->report, new User(), 'user_id');
    }
}
