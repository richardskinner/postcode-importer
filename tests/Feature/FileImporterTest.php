<?php

use App\Factories\FileFactory;
use App\Repositories\PostcodeRepository;
use App\Services\Postcodes\Importer\PostcodeImporter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

test('File Importer', function () {
    Storage::fake('local');
    $rows[] = "''ME1 %sJU'',2,3,4,5,6,7,8,9,10";
    $rows[] = "''ME2 %sJU'',2,3,4,5,6,7,8,9,10";
    $rows[] = "''ME3 %sJU'',2,3,4,5,6,7,8,9,10";
    $rows[] = "''ME4 %sJU'',2,3,4,5,6,7,8,9,10";
    $rows[] = "''ME5 %sJU'',2,3,4,5,6,7,8,9,10";

    Storage::put("Data/CSV/test.csv", implode("\n", $rows));

    $fileImporter = new PostcodeImporter(
        new PostcodeRepository(),
        new FileFactory()
    );
    $fileImporter->import(Storage::files('Data/CSV'));

    expect(DB::table('postcodes')->count())->toBe(5);
});
