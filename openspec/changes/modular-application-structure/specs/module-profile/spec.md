## ADDED Requirements

### Requirement: Profile module contains the profile editing code
The Profile module SHALL encapsulate the `Edit` Livewire component for profile management, with the class under `App\Modules\Profile\Livewire\` and its view under `resources/views/modules/profile/`.

#### Scenario: Profile edit page loads correctly after migration
- **WHEN** an authenticated user navigates to `/profile`
- **THEN** the system SHALL render the `App\Modules\Profile\Livewire\Edit` component successfully

### Requirement: Profile module routes are self-contained
The Profile module SHALL define its own `routes.php` registering the `/profile` route protected by `auth` middleware, preserving the `profile` route name.

#### Scenario: Profile route name is unchanged after migration
- **WHEN** `php artisan route:list --name=profile` is run
- **THEN** the `profile` route SHALL be listed pointing to `/profile`

### Requirement: Profile Livewire component declares its view path explicitly
The `Edit` component in the Profile module SHALL declare a `protected string $view` property pointing to its view at `modules.profile.edit`.

#### Scenario: Profile edit view resolves correctly
- **WHEN** the `Edit` component renders
- **THEN** Livewire SHALL use the view at `resources/views/modules/profile/edit.blade.php`
