## ADDED Requirements

### Requirement: Module directory structure is enforced
The application SHALL organize each feature area into a self-contained module directory under `app/Modules/<Name>/`, containing at minimum a `Livewire/` sub-directory and a `routes.php` file.

#### Scenario: Module directory exists for each feature
- **WHEN** the application is set up
- **THEN** directories `app/Modules/Users/`, `app/Modules/Dashboard/`, and `app/Modules/Profile/` SHALL each exist with a `Livewire/` sub-directory and a `routes.php` file

### Requirement: Module views are co-located under resources/views/modules
The application SHALL store Blade views for each module under `resources/views/modules/<name>/` to keep feature views discoverable without registering custom Blade namespaces.

#### Scenario: Module views exist at expected path
- **WHEN** a Livewire component in a module renders its view
- **THEN** the view SHALL be found at `resources/views/modules/<module-name>/` relative to the project root

### Requirement: Module classes follow a consistent namespace
Every PHP class belonging to a module SHALL live under the `App\Modules\<Name>\` namespace, using TitleCase for the module name, and be resolved by the existing PSR-4 autoloader.

#### Scenario: Namespace resolves without composer.json changes
- **WHEN** `composer dump-autoload` is run
- **THEN** classes under `App\Modules\` SHALL be autoloaded correctly without adding new autoload entries

### Requirement: Module routes are loaded automatically
The system SHALL auto-load each module's `routes.php` file from `AppServiceProvider::boot()` by globbing `app/Modules/*/routes.php`, applying the `web` middleware group and `auth` middleware by default.

#### Scenario: Adding a new module requires no change to web.php
- **WHEN** a new module directory containing `routes.php` is created
- **THEN** its routes SHALL be registered automatically on the next request without modifying `routes/web.php`

#### Scenario: Module routes appear in route list
- **WHEN** `php artisan route:list` is run
- **THEN** routes defined in module `routes.php` files SHALL appear with their correct names, URIs, and middleware
