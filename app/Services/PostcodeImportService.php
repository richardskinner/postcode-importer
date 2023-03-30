<?php

namespace App\Services;

use App\Services\Postcodes\Importer\PostcodeImporter;
use App\Services\Postcodes\PostcodeSourceInterface;
use Illuminate\Support\Facades\Storage;

class PostcodeImportService
{
    public function __construct(
        private PostcodeSourceInterface $postcodeSource,
        private PostcodeImporter $postcodeImporter
    )
    {

    }

    public function import(): void
    {
        $this->postcodeSource->download();
        $this->postcodeImporter->import(Storage::files('Data/CSV'));
    }
}