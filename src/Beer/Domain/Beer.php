<?php

namespace Source\Beer\Domain;

class Beer
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public int $ibu,
        public int $abv,
        public string $image
    ) {
        $this->image = 'storage/' . $image;
    }
}
