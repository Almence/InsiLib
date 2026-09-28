<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('registration form includes csrf token', function () {
    $this->get(route('register'))
        ->assertOk()
        ->assertSee('name="_token"', false);
});

test('valid registration creates and authenticates a user', function () {
    $response = $this->post(route('register.process'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'role' => 'user',
    ]);
});
