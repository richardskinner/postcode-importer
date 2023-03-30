<?php

namespace App\Services\Postcodes\Importer;

use App\Entities\Postcode;
use App\Factories\FileFactory;
use App\Repositories\PostcodeRepositoryInterface;
use App\Services\Postcodes\Importer\Contracts\FileImporterInterface;

class PostcodeImporter implements FileImporterInterface
{
    private int $chunkSize = 10;

    public function __construct(
        private PostcodeRepositoryInterface $postcodeRepository,
        private FileFactory $fileFactory
    )
    {
    }

    public function import(array $files)
    {
        foreach ($files as $filePath) {

            $file = $this->fileFactory->create($filePath);

            for ($i = 0; $i <= $file->getRowCount(); $i = $i + $this->chunkSize + 1) {
                $rows = $file->getRows($i, $this->chunkSize);
                $entities = array_map(fn($postcode) => new Postcode(null, $postcode[0], $postcode[2], $postcode[3]), $rows);
                $this->postcodeRepository->store($entities);
                unset($entities, $rows);
            }
        }
    }
}