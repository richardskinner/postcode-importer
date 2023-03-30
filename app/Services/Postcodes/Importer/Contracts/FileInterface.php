<?php

namespace App\Services\Postcodes\Importer\Contracts;

use Illuminate\Support\Facades\Storage;
use SplFileObject;

interface FileInterface
{

    public function getRowCount(): int;

    public function getRows(int $start, int $chunk = 0): array;
}