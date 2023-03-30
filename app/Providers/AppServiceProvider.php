<?php

namespace App\Providers;

use App\Repositories\PostcodeRepository;
use App\Repositories\PostcodeRepositoryInterface;
use App\Services\PostcodeImportService;
use App\Services\Postcodes\Downloader\PostcodeDownloader;
use App\Services\Postcodes\Importer\PostcodeImporter;
use App\Services\Postcodes\PostcodeSourceInterface;
use App\Services\Zip\ExtractZip;
use App\Services\Zip\ZipInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app
            ->when(PostcodeImporter::class)
            ->needs(PostcodeRepositoryInterface::class)
            ->give(PostcodeRepository::class);

        $this->app
            ->when(PostcodeImportService::class)
            ->needs(PostcodeSourceInterface::class)
            ->give(PostcodeDownloader::class);

        $this->app
            ->when(PostcodeImportService::class)
            ->needs(PostcodeRepositoryInterface::class)
            ->give(PostcodeRepository::class);

        $this->app
            ->when(PostcodeDownloader::class)
            ->needs(ZipInterface::class)
            ->give(ExtractZip::class);
    }
}
