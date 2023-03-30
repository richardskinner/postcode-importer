<?php

use App\Services\Postcodes\Downloader\PostcodeDownloader;
use App\Services\Zip\ExtractZip;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

test('Download Postcodes', function () {
    Storage::fake('local');
    $url = 'https://api.os.uk/downloads/v1/products/CodePointOpen/downloads?area=GB&format=CSV&redirect';
    Http::preventStrayRequests();
    Http::fake([
        $url => Http::response(file_get_contents(getcwd() . '/tests/data/test.csv.zip'))
    ]);

    $postcodeDownloader = new PostcodeDownloader(new ExtractZip());
    $postcodeDownloader->download();

    expect(Storage::exists('postcodes.zip'))->toBeFalse();
    expect(Storage::exists('test.csv'))->toBeTrue();
});

afterEach(function () {
    unlink(Storage::path('test.csv'));
});
