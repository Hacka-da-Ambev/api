<?php

namespace Source\User\Ports\Out;

use Source\User\Domain\{ User, UserDTO };

interface IUserRepository
{
    public function create(UserDTO $data): User;
    public function getByEmail(string $email): ?User;
}
