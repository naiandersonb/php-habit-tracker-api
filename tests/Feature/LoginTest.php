<?php

declare(strict_types = 1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('returns a token for valid credentials', function (): void {
    $user = User::factory()->create();

    $response = $this->postJson(route('auth.login'), [
        'email'    => $user->email,
        'password' => 'password',
    ]);

    $response->assertOk()->assertJsonStructure(['token']);
});

test('rejects a wrong password without exposing user data', function (): void {
    $user = User::factory()->create();

    $response = $this->postJson(route('auth.login'), [
        'email'    => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['email'])
        ->assertJsonMissingPath('errors.user');
});

test('rejects an unknown email', function (): void {
    $response = $this->postJson(route('auth.login'), [
        'email'    => 'unknown@example.com',
        'password' => 'password',
    ]);

    $response->assertUnprocessable()->assertJsonValidationErrors(['email']);
});
