<?php

namespace Tests\Unit\Command;

use App\Console\Commands\InsertReport;
use App\Models\User;
use App\Repositories\Report\ReportRepository;
use App\Repositories\User\UserRepository;
use Tests\TestCase;
use Mockery;

class InsertReportCommandTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    protected $userRepo;
    protected $reportRepo;
    protected $reportCommand;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepo = Mockery::mock($this->app->make(UserRepository::class));
        $this->reportRepo = Mockery::mock($this->app->make(ReportRepository::class));
        $this->reportCommand = new InsertReport($this->userRepo, $this->reportRepo);
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->reportCommand);
        parent::tearDown();
    }

    public function testHandle()
    {
        $user = Mockery::mock(User::class)->makePartial();
        $users = [$user];
        $this->userRepo->shouldReceive("searchAllLecturer")->andReturn($users);
        $results = collect([
            "2020-2021" => 150,
            "2021-2022" => 170,
        ]);
        $this->userRepo->shouldReceive("getDataChart")->andReturn($results);
        $this->reportRepo->shouldReceive("create");
        $this->reportCommand->handle();
    }
}
