<?php

namespace App\Services\Zip;

interface ZipInterface
{
    public function extract(string $path): bool;
}