<?php

namespace Source\User\Ports\In;

use Source\User\Domain\Aggregates\AuthenticationOutput;
use Source\User\Domain\{ User, UserDTO };

interface IAuthenticationService
{
    public function register(UserDTO $data): AuthenticationOutput;
    public function login(UserDTO $data): ?AuthenticationOutput;
    public function me():? User;
    public function refresh(): ?AuthenticationOutput;
    public function logout(): void;
}
