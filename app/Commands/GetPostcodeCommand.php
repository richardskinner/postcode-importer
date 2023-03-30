<?php

namespace App\Commands;

use App\Repositories\PostcodeRepository;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class GetPostcodeCommand extends Command
{
    protected $signature = 'postcodes:get {--postcode= : Full or partial postcode string}';

    protected $description = 'Get postcodes from database';

    public function handle(PostcodeRepository $postcodeRepository)
    {
        $options = $this->options();
        $postcodes = $postcodeRepository->get($options['postcode']);

        $this->output->write($postcodes->toJson( JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

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
