## ADDED Requirements

### Requirement: Users module contains all user management code
The Users module SHALL encapsulate the Livewire components `Index`, `Create`, and `Edit` for user management, with classes under `App\Modules\Users\Livewire\` and views under `resources/views/modules/users/`.

#### Scenario: Users index page loads correctly after migration
- **WHEN** an authenticated admin navigates to `/users`
- **THEN** the system SHALL render the `App\Modules\Users\Livewire\Index` component successfully

#### Scenario: Create user page loads correctly after migration
- **WHEN** an authenticated admin navigates to `/users/create`
- **THEN** the system SHALL render the `App\Modules\Users\Livewire\Create` component successfully

#### Scenario: Edit user page loads correctly after migration
- **WHEN** an authenticated admin navigates to `/users/{user}/edit`
- **THEN** the system SHALL render the `App\Modules\Users\Livewire\Edit` component successfully

### Requirement: Users module routes are self-contained
The Users module SHALL define its own `routes.php` with the `/users` route group protected by `auth` and `admin` middleware, using the same named routes (`users.index`, `users.create`, `users.edit`) as before.

#### Scenario: User route names remain unchanged after migration
- **WHEN** `php artisan route:list --name=users` is run
- **THEN** routes `users.index`, `users.create`, and `users.edit` SHALL be listed with the same URIs as before the migration

### Requirement: Users module Livewire components declare their view path explicitly
Each Livewire component in the Users module SHALL declare a `protected string $view` property pointing to its view at `modules.users.<view-name>`.

#### Scenario: Users index view resolves correctly
- **WHEN** the `Index` component renders
- **THEN** Livewire SHALL use the view at `resources/views/modules/users/index.blade.php`
