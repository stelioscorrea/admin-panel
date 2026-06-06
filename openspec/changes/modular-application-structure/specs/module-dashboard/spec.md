## ADDED Requirements

### Requirement: Dashboard module contains all dashboard code
The Dashboard module SHALL encapsulate the `Index` and `MetricCard` Livewire components, with classes under `App\Modules\Dashboard\Livewire\` and views under `resources/views/modules/dashboard/`.

#### Scenario: Dashboard index page loads correctly after migration
- **WHEN** an authenticated user navigates to `/dashboard`
- **THEN** the system SHALL render the `App\Modules\Dashboard\Livewire\Index` component successfully

#### Scenario: MetricCard component renders within dashboard
- **WHEN** the dashboard `Index` view renders
- **THEN** the `App\Modules\Dashboard\Livewire\MetricCard` component SHALL render without errors

### Requirement: Dashboard module routes are self-contained
The Dashboard module SHALL define its own `routes.php` registering the `/dashboard` route protected by the `auth` middleware, preserving the `dashboard` route name.

#### Scenario: Dashboard route name is unchanged after migration
- **WHEN** `php artisan route:list --name=dashboard` is run
- **THEN** the `dashboard` route SHALL be listed pointing to `/dashboard`

### Requirement: Dashboard Livewire components declare their view path explicitly
Each Livewire component in the Dashboard module SHALL declare a `protected string $view` property pointing to its view at `modules.dashboard.<view-name>`.

#### Scenario: Dashboard index view resolves correctly
- **WHEN** the `Index` component renders
- **THEN** Livewire SHALL use the view at `resources/views/modules/dashboard/index.blade.php`
