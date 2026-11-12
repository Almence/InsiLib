<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('registration form includes csrf token', function () {
    $this->get(route('register'))
        ->assertOk()
        ->assertSee('name="_token"', false)
        ->assertSee('name="nis"', false);
});

test('valid registration creates and authenticates a user', function () {
    $response = $this->post(route('register.process'), [
        'nis' => '001234',
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'nis' => '001234',
        'name' => 'Test User',
        'email' => 'test@example.com',
        'role' => 'user',
    ]);

    expect(User::where('nis', '001234')->firstOrFail()->toArray())->not->toHaveKey('nis');
});

test('registration requires a unique nis', function () {
    User::factory()->create(['nis' => '001234']);

    $this->post(route('register.process'), [
        'nis' => '001234',
        'name' => 'Another User',
        'email' => 'another@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertSessionHasErrors('nis');

    $this->post(route('register.process'), [
        'name' => 'Missing NIS',
        'email' => 'missing@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertSessionHasErrors('nis');
});

test('admin-created accounts store a unique nis', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin)->post(route('admin.add-user'), [
        'nis' => '005678',
        'name' => 'Admin Created User',
        'email' => 'admin-created@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirect(route('admin.user-manager'));

    $this->assertDatabaseHas('users', [
        'nis' => '005678',
        'email' => 'admin-created@example.com',
    ]);

    $this->post(route('admin.add-user'), [
        'nis' => '005678',
        'name' => 'Duplicate NIS User',
        'email' => 'duplicate-nis@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertSessionHasErrors('nis');
});

test('admin can update an account nis without allowing duplicates', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['nis' => '001111']);
    User::factory()->create(['nis' => '002222']);

    $this->actingAs($admin)->patch(route('update.cred', $user->id), [
        'nis' => '001112',
        'name' => $user->name,
    ])->assertSessionHasNoErrors();

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'nis' => '001112',
    ]);

    $this->patch(route('update.cred', $user->id), [
        'nis' => '002222',
        'name' => $user->name,
    ])->assertSessionHasErrors('nis');
});
