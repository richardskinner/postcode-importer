<?php

namespace App\Services\Postcodes\Downloader;

use App\Services\Postcodes\PostcodeSourceInterface;
use App\Services\Zip\ZipInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PostcodeDownloader implements PostcodeSourceInterface
{
    private string $storagePath;
    private array $options;

    public function __construct(private ZipInterface $zip)
    {
        $this->options = config('sources.ordnanceSurvey');
        $this->storagePath = Storage::path('postcodes.zip');
    }

    public function download(): bool
    {
        $file = Http::withHeaders(['accept' => 'application/octet-stream'])
            ->get($this->options['url'])
            ->body();

        $this->storeFile($file);
        $this->zip->extract($this->storagePath);
        $this->deleteZipFile();

        return true;
    }

    private function storeFile(string $file): bool
    {
        if (!Storage::put(basename($this->storagePath), $file)) {
            throw new PostcodeDownloaderException('Failed to save file');
        }

        return true;
    }

    private function deleteZipFile(): bool
    {
        if (!Storage::delete(basename($this->storagePath))) {
            throw new PostcodeDownloaderException('Failed to delete file');
        }

        return true;
    }
}