<?php

namespace App\Services\Postcodes\Importer\Contracts;

interface FileImporterInterface
{
    public function import(array $files);
}