<?php

use Illuminate\Support\Facades\DB;

test('File Importer', function () {
    DB::table('postcodes')->insert([
        ['postcode' => 'ME1 1GS', 'northings' => 574652, 'eastings' => 168439],
        ['postcode' => 'ME1 2GS', 'northings' => 574652, 'eastings' => 168439],
        ['postcode' => 'ME1 3GS', 'northings' => 574652, 'eastings' => 168439],
        ['postcode' => 'ME2 2GS', 'northings' => 574652, 'eastings' => 168439],
        ['postcode' => 'ME3 3GS', 'northings' => 574652, 'eastings' => 168439],
        ['postcode' => 'ME4 4GS', 'northings' => 574652, 'eastings' => 168439],
    ]);

    $postcodes = DB::table('postcodes')->where('postcode', 'LIKE', "%ME1%")->get();

    $this->artisan('postcodes:get', ['--postcode' => 'ME1'])
        ->expectsOutput($postcodes->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
        ->assertExitCode(0);
});
