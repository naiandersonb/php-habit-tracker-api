<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::firstWhere('email', $request->string('email'));

        if (!$user || !Hash::check($request->string('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais inválidas'],
            ]);
        }

        return response()->json([
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->string('name'),
            'email' => $request->string('email'),
            'password' => $request->string('password'),
        ]);

        return response()->json([
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }
}
