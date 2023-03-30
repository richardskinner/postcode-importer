<?php

namespace App\Services\Postcodes\Importer;

use App\Services\Postcodes\Importer\Contracts\FileInterface;
use Illuminate\Support\Facades\Storage;
use SplFileObject;

// TODO: this should probably be moved to php.ini file if not already set
ini_set('auto_detect_line_endings', true);

class CsvFile implements FileInterface
{
    public int $rowCount;
    public function __construct(private string $filePath)
    {
        $this->filePath = Storage::path($this->filePath);
        $this->rowCount = $this->getRowCount();
    }

    public function getRowCount(): int
    {
        $fileInfo = new SplFileObject($this->filePath);
        $fileInfo->seek(PHP_INT_MAX);

        return $fileInfo->key() + 1;
    }

    public function getRows(int $start, int $chunk = 0): array
    {
        $rowCount = 0;
        $chunkCount = 0;
        $rows = [];
        $handle = fopen($this->filePath, 'r');
        while (($rowData = fgetcsv($handle, 2000, ",")) !== false) {
            if ($rowCount++ < $start) {
                continue;
            }
            $rows[] = $rowData;
            $chunkCount++;
            if ($chunkCount === $chunk) {
                return $rows;
            }
        }

        fclose($handle);

        return $rows;
    }
}