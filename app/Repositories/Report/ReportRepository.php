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
}
