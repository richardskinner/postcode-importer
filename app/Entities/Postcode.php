<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;

class Postcode implements Arrayable
{
    public function __construct(
        private ?string $id,
        public string   $postcode,
        public string   $eastings,
        public string $northings
    )
    {

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function toArray()
    {
        return [
            'postcode' => $this->postcode,
            'eastings' => $this->eastings,
            'northings' => $this->northings,
        ];
    }
}