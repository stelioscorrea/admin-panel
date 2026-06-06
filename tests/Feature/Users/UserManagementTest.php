<?php

use App\Models\User;
use App\Modules\Users\Livewire\Create;
use App\Modules\Users\Livewire\Edit;
use App\Modules\Users\Livewire\Index;
use Livewire\Livewire;

test('admin can view user listing', function () {
    $admin = User::factory()->admin()->create();
    User::factory()->count(3)->create();

    Livewire::actingAs($admin)
        ->test(Index::class)
        ->assertOk();
});

test('user listing filters by search term', function () {
    $admin = User::factory()->admin()->create();
    $target = User::factory()->create(['name' => 'João Especial']);
    User::factory()->create(['name' => 'Maria Outro']);

    Livewire::actingAs($admin)
        ->test(Index::class)
        ->set('search', 'João')
        ->assertSee('João Especial')
        ->assertDontSee('Maria Outro');
});

test('admin can create a user', function () {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(Create::class)
        ->set('name', 'Novo Usuário')
        ->set('email', 'novo@teste.com')
        ->set('role', 'user')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('save');

    $this->assertDatabaseHas('users', ['email' => 'novo@teste.com']);
});

test('cannot create user with duplicate email', function () {
    $admin = User::factory()->admin()->create();
    $existing = User::factory()->create(['email' => 'existente@teste.com']);

    Livewire::actingAs($admin)
        ->test(Create::class)
        ->set('name', 'Outro')
        ->set('email', 'existente@teste.com')
        ->set('role', 'user')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('save')
        ->assertHasErrors(['email']);
});

test('admin can edit a user', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create(['name' => 'Antigo Nome']);

    Livewire::actingAs($admin)
        ->test(Edit::class, ['user' => $user])
        ->set('name', 'Nome Atualizado')
        ->call('save');

    expect($user->fresh()->name)->toBe('Nome Atualizado');
});

test('password is not changed when left blank on edit', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();
    $originalPassword = $user->password;

    Livewire::actingAs($admin)
        ->test(Edit::class, ['user' => $user])
        ->set('name', 'Novo Nome')
        ->set('password', '')
        ->call('save');

    expect($user->fresh()->password)->toBe($originalPassword);
});

test('admin can toggle user active status', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create(['is_active' => true]);

    Livewire::actingAs($admin)
        ->test(Index::class)
        ->call('toggleActiveConfirmed', $user->id);

    expect($user->fresh()->is_active)->toBeFalse();
});

test('admin cannot deactivate themselves', function () {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(Index::class)
        ->call('requestToggleActive', $admin->id)
        ->assertDispatched('notify');

    expect($admin->fresh()->is_active)->toBeTrue();
});
