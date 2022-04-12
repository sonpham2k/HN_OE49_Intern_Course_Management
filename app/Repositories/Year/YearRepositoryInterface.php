<?php

namespace App\Repositories\Year;

use App\Repositories\RepositoryInterface;

interface YearRepositoryInterface extends RepositoryInterface
{
    public function allYear();
}
