<?php

namespace Source\User\Domain;

class User
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email
    ) {}
}
