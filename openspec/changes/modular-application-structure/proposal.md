## Why

The current codebase places all Livewire components, controllers, and views in flat, feature-agnostic directories (`app/Livewire/Users/`, `app/Livewire/Dashboard/`, etc.). As the admin panel grows with more features, this flat layout makes it harder to reason about ownership, scale contributions, and locate related code. Organizing the application into self-contained modules gives each feature area a clear boundary and makes the codebase easier to navigate and extend.

## What Changes

- Introduce a `app/Modules/` directory as the root for all feature modules.
- Each module (e.g., `Users`, `Dashboard`, `Profile`) becomes a self-contained directory containing its Livewire components, models (when applicable), routes, and views.
- Shared/global concerns (layouts, auth, shared components) remain outside modules, at the application level.
- The existing `app/Livewire/`, `resources/views/livewire/`, and per-feature route definitions are migrated into their respective module directories.
- Route registration is moved to per-module route files, loaded automatically via `AppServiceProvider` or a dedicated `ModuleServiceProvider`.
- Autoloading is updated in `composer.json` to include the new `app/Modules/` namespace.

## Capabilities

### New Capabilities

- `module-structure`: Defines the directory layout, namespace conventions, and autoloading rules for the modular architecture (no new product features, purely structural).
- `module-users`: Self-contained Users module encapsulating Livewire components (Index, Create, Edit), routes, and views for user management.
- `module-dashboard`: Self-contained Dashboard module with its Livewire components and views.
- `module-profile`: Self-contained Profile module for the authenticated user's profile editing.

### Modified Capabilities

- `admin-layout`: The shared layout and routing bootstrap changes — per-module route files replace the monolithic `routes/web.php` feature sections. The layout itself stays in `resources/views/layouts/` but route registration moves into modules.

## Impact

- **`app/Livewire/`**: All subdirectories migrated into `app/Modules/<Name>/Livewire/`.
- **`resources/views/livewire/`**: Views migrated into `app/Modules/<Name>/resources/views/` (or kept in `resources/views/` with a per-module subfolder — TBD in design).
- **`routes/web.php`**: Stripped to only global/auth routes; module routes are loaded automatically.
- **`composer.json`**: PSR-4 autoload entry added for `App\\Modules\\` → `app/Modules/`.
- **`app/Providers/AppServiceProvider.php`**: Updated to load module routes and optionally module service providers.
- **Tests**: All existing feature tests remain valid; namespaces in test files updated to reflect new paths.
- **No API changes** — routes and route names remain the same, only internal code organization changes.
