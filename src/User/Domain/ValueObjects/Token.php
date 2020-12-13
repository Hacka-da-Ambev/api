<?php

namespace Source\User\Domain\ValueObjects;

class Token
{
    public function __construct(
        public string $accessToken,
        public string $tokenType,
        public int $expiresIn
    ) {}
}
