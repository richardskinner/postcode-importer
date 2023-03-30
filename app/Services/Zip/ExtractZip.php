<?php

namespace App\Services\Zip;

use ZipArchive;

class ExtractZip implements ZipInterface
{
    private ZipArchive $zip;
    private array $zipError = [
        ZipArchive::ER_EXISTS => 'File already exists.',
        ZipArchive::ER_INCONS => 'Zip archive inconsistent.',
        ZipArchive::ER_INVAL => 'Invalid argument.',
        ZipArchive::ER_MEMORY => 'Malloc failure.',
        ZipArchive::ER_NOENT => 'No such file.',
        ZipArchive::ER_NOZIP => 'Not a zip archive.',
        ZipArchive::ER_OPEN => "Can't open file.",
        ZipArchive::ER_READ => 'Read error.',
        ZipArchive::ER_SEEK => 'Seek error.',
    ];

    public function __construct()
    {
        $this->zip = new ZipArchive();
    }

    public function extract(string $path): bool
    {
        $open = $this->zip->open($path);
        if ($open !== true && array_key_exists($open, $this->zipError)) {
            throw new ZipException("Failed to open zip file: {$this->zipError[$open]}");
        }

        if (!$this->zip->extractTo(dirname($path))) {
            throw new ZipException('Failed to extract file.');
        }

        return true;
    }
}