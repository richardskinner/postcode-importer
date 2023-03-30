<?php

namespace App\Commands;

use App\Services\PostcodeImportService;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class ImportPostcodeCommand extends Command
{
    protected $signature = 'postcodes:import';

    protected $description = 'Import postcodes from OS Data';

    public function handle(PostcodeImportService $postcodeImportService)
    {
        try {
            $postcodeImportService->import();
        } catch (Exception $e) {
            $this->output->error('An unexpected exception occurred' . PHP_EOL . $e);
            return 1;
        }

        $this->output->write('Import successful.');

        return 0;
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
