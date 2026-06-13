# Admin Panel

A modern, enterprise-grade administrative dashboard built with **Laravel 13**, **Livewire 4**, and **AdminLTE 4**. Designed as a solid boilerplate for building admin interfaces with authentication, role-based access control, user management, and a modular architecture ready to scale.

![Tests](https://img.shields.io/badge/tests-28%20passing-brightgreen)
![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?logo=php)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-4-4E56A6)

---

## Features

- 🔐 **Authentication** — login/logout with session-based auth and guest middleware
- 👥 **User Management** — CRUD with search, sort, pagination, and active/inactive toggle
- 🛡️ **Role-Based Access Control** — `admin` and `user` roles with middleware protection
- 📊 **Dashboard** — metrics cards showing total, active, admin, and inactive user counts
- 👤 **User Profile** — update name, email, and password with validation
- 🧩 **Modular Architecture** — feature modules auto-loaded without touching `routes/web.php`

---

## Stack

| Layer | Technology |
|---|---|
| Language | PHP 8.4 |
| Framework | Laravel 13 |
| Reactive UI | Livewire 4 |
| Admin Theme | AdminLTE 4 |
| CSS Framework | Tailwind CSS 4 + Bootstrap 5 |
| Build Tool | Vite 6 |
| Database | SQLite (development) |
| Testing | Pest 4 |

---

## Requirements

- PHP 8.4+
- Composer
- Node.js 18+ and npm

---

## Setup

```bash
# Clone the repository
git clone <repository-url> admin-panel
cd admin-panel

# Install all dependencies, configure env, run migrations, and build assets
composer setup
```

> **Manual setup** (if `composer setup` is unavailable):
> ```bash
> composer install
> cp .env.example .env
> php artisan key:generate
> php artisan migrate
> npm install && npm run build
> ```

---

## Essential Commands

```bash
# Start server, queue, logs, and Vite concurrently
composer dev

# Run the test suite
composer test

# List all registered routes
php artisan route:list --except-vendor

# Format PHP code to project style
vendor/bin/pint
```

---

## Architecture

The application follows a **feature module** pattern. Each functional area lives in a self-contained directory under `app/Modules/`:

```
app/Modules/
├── Components/
│   └── Livewire/ConfirmModal.php       # Shared modal component
├── Dashboard/
│   ├── Livewire/{Index,MetricCard}.php
│   └── routes.php
├── Profile/
│   ├── Livewire/Edit.php
│   └── routes.php
└── Users/
    ├── Livewire/{Index,Create,Edit}.php
    └── routes.php

resources/views/modules/
├── components/  dashboard/  profile/  users/
```

### How it works

**Route auto-loading** — `AppServiceProvider::loadModuleRoutes()` globs `app/Modules/*/routes.php` and registers each file under `web` + `auth` middleware. Adding a new module never requires changes to `routes/web.php`.

**Livewire aliases** — `AppServiceProvider::registerLivewireModules()` registers explicit component aliases (e.g. `dashboard.metric-card` → `App\Modules\Dashboard\Livewire\MetricCard`), keeping Blade templates clean.

**Adding a new module:**

1. Create `app/Modules/<Name>/Livewire/` and `app/Modules/<Name>/routes.php`
2. Create views at `resources/views/modules/<name>/`
3. Register Livewire aliases in `AppServiceProvider::registerLivewireModules()`
4. The module routes are picked up automatically on the next request

---

## Testing

```bash
# Run all tests (compact output)
php artisan test --compact

# Run a specific test file
php artisan test --compact tests/Feature/Users/UserManagementTest.php

# Filter by test name
php artisan test --compact --filter=admin_can_create_a_user
```

The test suite covers authentication, access control, user management (CRUD, toggle active, search), profile editing (name, email, password), and the navbar.

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
