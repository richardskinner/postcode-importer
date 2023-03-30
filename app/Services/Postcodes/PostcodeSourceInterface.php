<?php

namespace App\Services\Postcodes;

interface PostcodeSourceInterface
{
    public function download(): bool;
}