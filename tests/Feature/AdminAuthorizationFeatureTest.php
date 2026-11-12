<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('regular users are forbidden from every admin route', function () {
    $this->actingAs(User::factory()->create(['role' => 'user']));

    $adminRoutes = [
        ['POST', '/admin/loans/1/approve'],
        ['POST', '/admin/loans/1/return'],
        ['GET', '/admin/print-qr'],
        ['GET', '/admin/books/create'],
        ['GET', '/admin/books/update/1'],
        ['POST', '/admin/books/create'],
        ['POST', '/admin/books/update/1'],
        ['GET', '/user-manager'],
        ['POST', '/add-category'],
        ['GET', '/add-account'],
        ['POST', '/add-account'],
        ['DELETE', '/deletion/1/book-delete'],
        ['DELETE', '/deletion-category/1/category-delete'],
        ['PATCH', '/user-manager/1/update-user-cred'],
        ['DELETE', '/user-manager/1/delete-user'],
    ];

    foreach ($adminRoutes as [$method, $uri]) {
        $this->call($method, $uri)->assertForbidden();
    }
});

test('administrators can access admin pages', function () {
    $this->actingAs(User::factory()->create(['role' => 'admin']));

    $this->get('/user-manager')->assertOk();
    $this->get('/add-account')->assertOk();
});

test('guests must authenticate before accessing admin pages', function () {
    $this->get('/user-manager')->assertRedirect(route('login'));
});
