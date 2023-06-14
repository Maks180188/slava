<?php

namespace App\Http\Controllers;

use App\Interfaces\RowRepositoryInterface;

class RowController extends Controller
{
    public function __construct(
        private readonly RowRepositoryInterface $rowRepository
    ) {}
    public function getRowsList(): array
    {
        return $this->rowRepository->getList();
    }
}
