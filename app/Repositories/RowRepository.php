<?php

namespace App\Repositories;

use App\Interfaces\RowRepositoryInterface;
use App\Models\Row;

class RowRepository implements RowRepositoryInterface
{

    public function getList(): array
    {
        return Row::all()->groupBy('date')->toArray();
    }
}
