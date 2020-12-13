<?php

namespace App\Http\Controllers;

use App\Http\Requests\{ LoginRequest, RegisterRequest };
use Source\User\Domain\UserDTO;
use Source\User\Ports\In\IAuthenticationService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected IAuthenticationService $authenticationService
    ) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $this
            ->authenticationService
            ->register(new UserDTO(...$request->only('name', 'email', 'password')));

        if (!$data) {
            return response()->json(['error' => 'Bad request'], 400);
        }

        return response()->json($data, 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this
            ->authenticationService
            ->login(new UserDTO(null, ...$request->only('email', 'password')));

        if (!$data) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json($data);
    }

    public function me(): JsonResponse
    {
        $data = $this
            ->authenticationService
            ->me();

        if (!$data) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($data);
    }

    public function logout(): JsonResponse
    {
        $this
            ->authenticationService
            ->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(): JsonResponse
    {
        $data = $this
            ->authenticationService
            ->refresh();

        if (!$data) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json($data);
    }
}
