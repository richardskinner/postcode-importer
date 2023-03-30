<?php

namespace App\Factories;

use App\Services\Postcodes\Importer\Contracts\FileInterface;
use App\Services\Postcodes\Importer\CsvFile;

class FileFactory
{
    public function create($file): FileInterface
    {
        return new CsvFile($file);
    }
}