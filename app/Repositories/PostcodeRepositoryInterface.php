<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface PostcodeRepositoryInterface
{
    public function store(array $postcodes): Collection;
}