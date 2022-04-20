<?php

namespace App\Repositories\Report;

use App\Repositories\RepositoryInterface;

interface ReportRepositoryInterface extends RepositoryInterface
{
    public function findReportByUser($user_id);
}
