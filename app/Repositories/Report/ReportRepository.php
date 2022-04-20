<?php

namespace App\Repositories\Report;

use App\Repositories\BaseRepository;
use App\Models\Report;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{
    public function getModel()
    {
        return Report::class;
    }

    public function findReportByUser($user_id)
    {
        return $this->model->where("user_id", $user_id)->get()->load("user");
    }
}
