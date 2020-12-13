<?php

namespace Source\User\Services;

use Source\User\Domain\Aggregates\AuthenticationOutput;
use Source\User\Ports\Out\IUserRepository;
use Source\User\Domain\{ User, UserDTO };
use Source\User\Domain\ValueObjects\Token;
use Source\User\Ports\In\IAuthenticationService;

class AuthenticationService implements IAuthenticationService
{

    public function __construct(
        protected IUserRepository $userRepository
    ) {}

    public function register(UserDTO $data): ?AuthenticationOutput
    {
        $user = $this->userRepository->create($data);
        $token = auth()->attempt(['email' => $data->email, 'password' => $data->password]);

        if (!$user || !$token) {
            return null;
        }

        return new AuthenticationOutput(
            $user,
            $this->makeToken($token)
        );
    }

    public function login(UserDTO $data): ?AuthenticationOutput
    {
        $user = $this->userRepository->getByEmail($data->email);
        $token = auth()->attempt(['email' => $data->email, 'password' => $data->password]);

        if (!$user || !$token) {
            return null;
        }

        return new AuthenticationOutput(
            $user,
            $this->makeToken($token)
        );
    }

    public function me(): ?User
    {
        $user = auth()->user();

        if (!$user) {
            return null;
        }

        return new User(
            $user->id,
            $user->name,
            $user->email
        );
    }

    public function refresh(): ?AuthenticationOutput
    {
        $user = $this->me();
        $token = auth()->refresh();

        if (!$user || !$token) {
            return null;
        }

        return new AuthenticationOutput(
            $user,
            $this->makeToken($token)
        );
    }

    public function logout(): void
    {
        auth()->logout();
    }

    private function makeToken(string $token): Token
    {
        $expiresIn = auth()->factory()->getTTL() * 60;

        return new Token(
            $token,
            'bearer',
            $expiresIn
        );
    }
}
