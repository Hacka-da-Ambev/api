<?php

namespace Source\Beer\Domain;

use Source\Beer\Domain\ValueObjects\Base64;

class BeerDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public int $ibu,
        public int $abv,
        public Base64 $image
    ) {}
}
