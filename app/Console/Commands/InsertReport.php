<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Report as ReportModel;
use App\Repositories\Report\ReportRepository;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;

class InsertReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:reports';
    protected $userRepo;
    protected $reportRepo;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert reports success';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo, ReportRepository $reportRepo)
    {
        parent::__construct();
        $this->userRepo = $userRepo;
        $this->reportRepo = $reportRepo;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $year = Carbon::now()->year;
        $preYear = $year - 1;
        $year = $preYear . '-' . $year;
        $users = $this->userRepo->searchAllLecturer("");
        $datas = [];
        $years = [];
        foreach ($users as $user) {
            $results = $this->userRepo->getDataChart($user->id);
            $years = $results->keys()->all();
            $datas = $results->values()->all();
            for ($i = 0; $i < count($years); $i++) {
                if ($years[$i] === $year) {
                    $this->reportRepo->create([
                        'user_id' => $user->id,
                        'subscribers' => $datas[$i],
                        'year' => $year,
                    ]);
                    break;
                }
            }
        }
    }
}
