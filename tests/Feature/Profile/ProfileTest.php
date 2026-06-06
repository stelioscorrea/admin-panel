<?php

use App\Models\User;
use App\Modules\Profile\Livewire\Edit;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

test('authenticated user can access profile page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get(route('profile'))->assertOk();
});

test('user can update profile data', function () {
    $user = User::factory()->create(['name' => 'Antigo Nome']);

    Livewire::actingAs($user)
        ->test(Edit::class)
        ->set('name', 'Novo Nome')
        ->set('email', $user->email)
        ->call('saveProfile');

    expect($user->fresh()->name)->toBe('Novo Nome');
});

test('user cannot use an already taken email', function () {
    $user = User::factory()->create();
    $other = User::factory()->create(['email' => 'outro@teste.com']);

    Livewire::actingAs($user)
        ->test(Edit::class)
        ->set('name', $user->name)
        ->set('email', 'outro@teste.com')
        ->call('saveProfile')
        ->assertHasErrors(['email']);
});

test('user can change password with correct current password', function () {
    $user = User::factory()->create(['password' => Hash::make('senha-antiga')]);

    Livewire::actingAs($user)
        ->test(Edit::class)
        ->set('current_password', 'senha-antiga')
        ->set('password', 'nova-senha-123')
        ->set('password_confirmation', 'nova-senha-123')
        ->call('savePassword');

    expect(Hash::check('nova-senha-123', $user->fresh()->password))->toBeTrue();
});

test('user cannot change password with wrong current password', function () {
    $user = User::factory()->create(['password' => Hash::make('senha-antiga')]);

    Livewire::actingAs($user)
        ->test(Edit::class)
        ->set('current_password', 'senha-errada')
        ->set('password', 'nova-senha-123')
        ->set('password_confirmation', 'nova-senha-123')
        ->call('savePassword')
        ->assertHasErrors(['current_password']);
});
