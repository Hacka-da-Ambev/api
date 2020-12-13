<?php

namespace Source\User\Domain\Aggregates;

use Source\User\Domain\User;
use Source\User\Domain\ValueObjects\Token;

class AuthenticationOutput
{
    public function __construct(
        public User $user,
        public Token $token,
    ) {}
}
