<?php

namespace Source\Beer\Domain\ValueObjects;

class Base64
{
    public function __construct(
        public string $name,
        public string $base64
    ) {}
}
