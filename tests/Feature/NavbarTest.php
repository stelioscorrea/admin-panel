<?php

use App\Models\User;

test('navbar displays authenticated user name', function () {
    $user = User::factory()->create(['name' => 'João Silva']);

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertSee('João Silva');
});

test('navbar contains link to profile page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertSee(route('profile'));
});

test('navbar logout button posts to logout route', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('login'));

    $this->assertGuest();
});
