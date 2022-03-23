<?php

namespace Tests\Unit\Http\Controller;

use App\Http\Controllers\CourseController;
use Mockery;
use Tests\TestCase;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Semester\SemesterRepositoryInterface;

class CourseControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $courseController;
    protected $courseRepo;
    protected $semesterRepo;
    protected $userRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->courseRepo = Mockery::mock($this->app->make(CourseRepositoryInterface::class));
        $this->semesterRepo = Mockery::mock($this->app->make(SemesterRepositoryInterface::class));
        $this->userRepo = Mockery::mock($this->app->make(UserRepositoryInterface::class));
        $this->courseController = new CourseController($this->courseRepo, $this->semesterRepo, $this->userRepo);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
        unset($this->courseController);
        unset($this->courseRepo);
        unset($this->semesterRepo);
        unset($this->userRepo);
    }
}
