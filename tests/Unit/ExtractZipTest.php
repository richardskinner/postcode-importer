<?php

use App\Services\Zip\ExtractZip;
use App\Services\Zip\ZipException;

test('Extract Zip', function () {
    $zip = new ExtractZip();
    $extracted = $zip->extract(__DIR__ . '/../data/test.csv.zip');

    expect($extracted)->toBeTrue();
});

test('Extract Zip - Throws exception if zip file not a zip', function () {
    $zip = new ExtractZip();

    expect(fn() => $zip->extract(__DIR__ . '/../data/test.docx'))->toThrow(ZipException::class);
});

afterEach(function () {
    if (file_exists(__DIR__ . '/../data/test.csv')) {
        unlink(__DIR__ . '/../data/test.csv');
    }
});