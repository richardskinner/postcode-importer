<?php

namespace App\Repositories;

use App\Entities\Postcode;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PostcodeRepository implements PostcodeRepositoryInterface
{
    /**
     * @param Postcode[] $postcodes
     * @return Collection
     */
    public function store(array $postcodes): Collection
    {
        $postcodes = collect($postcodes);

        if (!DB::table('postcodes')->insert($postcodes->toArray())) {
            throw new RuntimeException('Postcode failed to create. Rollback insert attempt.');
        }

        return $postcodes;
    }

    public function get(?string $postcode): Collection
    {
        if (empty($postcode)) {
            return DB::table('postcodes')->get();
        }

        return DB::table('postcodes')->where('postcode', 'LIKE', "%$postcode%")->get();
    }
}