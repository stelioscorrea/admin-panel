## 1. Foundation — Module Scaffold

- [x] 1.1 Create directory `app/Modules/Users/Livewire/`
- [x] 1.2 Create directory `app/Modules/Dashboard/Livewire/`
- [x] 1.3 Create directory `app/Modules/Profile/Livewire/`
- [x] 1.4 Create directory `resources/views/modules/users/`
- [x] 1.5 Create directory `resources/views/modules/dashboard/`
- [x] 1.6 Create directory `resources/views/modules/profile/`

## 2. Migrate Dashboard Module

- [x] 2.1 Move `app/Livewire/Dashboard/Index.php` → `app/Modules/Dashboard/Livewire/Index.php`, update namespace to `App\Modules\Dashboard\Livewire`, add `protected string $view = 'modules.dashboard.index'`
- [x] 2.2 Move `app/Livewire/Dashboard/MetricCard.php` → `app/Modules/Dashboard/Livewire/MetricCard.php`, update namespace, add explicit `$view` property
- [x] 2.3 Move `resources/views/livewire/dashboard/index.blade.php` → `resources/views/modules/dashboard/index.blade.php`
- [x] 2.4 Move `resources/views/livewire/dashboard/metric-card.blade.php` → `resources/views/modules/dashboard/metric-card.blade.php`
- [x] 2.5 Create `app/Modules/Dashboard/routes.php` with the `/dashboard` route (auth middleware, `dashboard` name), pointing to the new component class

## 3. Migrate Users Module

- [x] 3.1 Move `app/Livewire/Users/Index.php` → `app/Modules/Users/Livewire/Index.php`, update namespace, add `protected string $view = 'modules.users.index'`
- [x] 3.2 Move `app/Livewire/Users/Create.php` → `app/Modules/Users/Livewire/Create.php`, update namespace, add explicit `$view = 'modules.users.create'`
- [x] 3.3 Move `app/Livewire/Users/Edit.php` → `app/Modules/Users/Livewire/Edit.php`, update namespace, add explicit `$view = 'modules.users.edit'`
- [x] 3.4 Move `resources/views/livewire/users/index.blade.php` → `resources/views/modules/users/index.blade.php`
- [x] 3.5 Move `resources/views/livewire/users/create.blade.php` → `resources/views/modules/users/create.blade.php`
- [x] 3.6 Move `resources/views/livewire/users/edit.blade.php` → `resources/views/modules/users/edit.blade.php`
- [x] 3.7 Create `app/Modules/Users/routes.php` with the `/users` route group (auth + admin middleware, names: `users.index`, `users.create`, `users.edit`)

## 4. Migrate Profile Module

- [x] 4.1 Move `app/Livewire/Profile/Edit.php` → `app/Modules/Profile/Livewire/Edit.php`, update namespace, add `protected string $view = 'modules.profile.edit'`
- [x] 4.2 Move `resources/views/livewire/profile/edit.blade.php` → `resources/views/modules/profile/edit.blade.php`
- [x] 4.3 Create `app/Modules/Profile/routes.php` with the `/profile` route (auth middleware, `profile` name)

## 5. Migrate Shared Components

- [x] 5.1 Move `app/Livewire/Components/ConfirmModal.php` → `app/Modules/Components/Livewire/ConfirmModal.php` (or keep at app level if shared), update namespace accordingly
- [x] 5.2 Move `resources/views/livewire/components/confirm-modal.blade.php` to match new location, update `$view` if moved

## 6. Update AppServiceProvider — Auto-load Module Routes

- [x] 6.1 In `AppServiceProvider::boot()`, add a glob loop to load all `app/Modules/*/routes.php` files under the `web` middleware group
- [x] 6.2 Remove the `/dashboard`, `/profile`, and `/users` route groups from `routes/web.php`, keeping only global/auth routes

## 7. Update `use` Statements and References

- [x] 7.1 Update `routes/web.php` to remove `use` imports for moved component classes
- [x] 7.2 Verify no other files reference old class namespaces (`App\Livewire\*`); update any references found

## 8. Cleanup Empty Directories

- [x] 8.1 Remove empty `app/Livewire/` directory (after confirming it is empty)
- [x] 8.2 Remove empty `resources/views/livewire/` subdirectories (after confirming they are empty)

## 9. Verification

- [x] 9.1 Run `composer dump-autoload` to refresh the autoloader
- [x] 9.2 Run `php artisan route:list` and verify all routes are present with correct names and URIs
- [x] 9.3 Run `php artisan test --compact` and confirm all tests pass
- [x] 9.4 Run `vendor/bin/pint --dirty --format agent` to fix any formatting issues
