<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

test('File Importer', function () {
    Storage::fake('local');
    $url = 'https://api.os.uk/downloads/v1/products/CodePointOpen/downloads?area=GB&format=CSV&redirect';
    Http::preventStrayRequests();
    Http::fake([
        $url => Http::response(file_get_contents(getcwd() . '/tests/data/test.csv.zip'))
    ]);

    $this->artisan('postcodes:import')
        ->expectsOutput('Import successful.')
        ->assertExitCode(0);
});
