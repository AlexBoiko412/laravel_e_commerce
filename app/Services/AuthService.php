<?php

namespace App\Services;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\UserResource;

class AuthService
{
    public function register(array $data): array
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => UserRole::CUSTOMER,
        ]);

        return [
            'user'  => new UserResource($user),
            'token' => $user->createToken('auth_token')->plainTextToken,
        ];
    }

    public function login(string $email, string $password): array
    {
        $user = User::where('email', $email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Невірні облікові дані.'],
            ]);
        }

        return [
            'user'  => new UserResource($user),
            'token' => $user->createToken('auth_token')->plainTextToken,
        ];
    }
    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }

    public function refreshToken(User $user): string
    {
        $user->currentAccessToken()->delete();

        return $user->createToken('auth_token')->plainTextToken;
    }
}
