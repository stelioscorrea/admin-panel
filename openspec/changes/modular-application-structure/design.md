## Context

The admin panel currently organizes Livewire components under `app/Livewire/<Feature>/`, views under `resources/views/livewire/<feature>/`, and all authenticated routes in a single `routes/web.php`. With three initial feature areas (Users, Dashboard, Profile) already in place and more to come, the flat layout will become increasingly hard to navigate.

The goal is to introduce a **Laravel-native module pattern** — no third-party package, no framework overhead — that is idiomatic to the existing stack and transparent to the rest of the application.

## Goals / Non-Goals

**Goals:**
- Define a clear, repeatable directory convention for feature modules.
- Move existing feature code (Users, Dashboard, Profile) into their respective modules without changing any route names, component behavior, or user-facing functionality.
- Keep shared infrastructure (layouts, auth, global middleware, shared Blade components) at the application level, outside modules.
- Auto-load module routes so adding a new module never requires touching `routes/web.php`.
- Keep it simple: no module registry, no PSR-4 magic beyond a single namespace prefix, no service container overheads.

**Non-Goals:**
- Introducing a third-party module package (e.g., `nwidart/laravel-modules`).
- Moving the `resources/views/layouts/` layout or shared Blade components into modules.
- Adding new product features as part of this change.
- Supporting module enable/disable toggles.

## Decisions

### Decision 1: Module directory under `app/Modules/`

**Choice:** `app/Modules/<Name>/` as the root for each module.

**Rationale:** This is the most common convention for raw Laravel modules and aligns with PSR-4 autoloading under the existing `App\` namespace. It keeps modules discoverable alongside other app-level code without requiring composer path repositories.

**Alternative considered:** A top-level `modules/` folder at the project root (à la `nwidart/laravel-modules`). Rejected because it requires additional composer path repository config and deviates from the existing single-root PSR-4 setup.

---

### Decision 2: Module internal layout

Each module follows this structure:

```
app/Modules/<Name>/
├── Livewire/           # Livewire component classes
├── routes.php          # Module-specific web routes (same middleware groups as today)
└── resources/
    └── views/          # Blade views for this module
```

**Rationale:** Keeps all code for a feature co-located. Views inside the module avoid the split between `app/` and `resources/views/livewire/`. The `routes.php` file is self-contained and explicit.

**Alternative considered:** Keeping views in `resources/views/modules/<Name>/`. Rejected because it re-introduces the split and reduces the benefit of modularization.

**Livewire view path:** Livewire resolves views based on the component's `$view` property or by convention. For module components, the `$view` property will be explicitly set to point to the module's view path via a shared Livewire view path registration in `AppServiceProvider`.

---

### Decision 3: Route auto-loading via `AppServiceProvider`

**Choice:** `AppServiceProvider::boot()` scans `app/Modules/*/routes.php` and loads each file via `Route::middleware('web')->group(...)`.

**Rationale:** Simple, zero-magic, 100% debuggable with `php artisan route:list`. No new service providers are needed.

**Alternative considered:** A dedicated `ModuleServiceProvider` that each module registers. Rejected for this phase as it adds boilerplate without benefit at current scale.

---

### Decision 4: Namespace convention

Module classes live under `App\Modules\<Name>\Livewire\` (or `App\Modules\<Name>\<Layer>\` for future layers like models). Autoloading is covered by the existing `App\` PSR-4 entry in `composer.json` (`"App\\": "app/"`), which recursively covers `app/Modules/`.

**No changes to `composer.json` are required.**

---

### Decision 5: Views location and Livewire resolution

Livewire 4 resolves views either by convention (dot-notation class name) or by an explicit `protected string $view` property on the component. For module components, the convention path (`livewire.users.index`) will not match the new filesystem path, so each Livewire component MUST declare `$view` explicitly pointing to its module view, e.g.:

```php
protected string $view = 'modules.users.livewire.index';
```

Blade will resolve this against registered view paths. The module views directory (`app/Modules/<Name>/resources/views/`) will be registered as a named view namespace OR the views will be placed under `resources/views/modules/<Name>/` to avoid needing a custom view namespace.

**Final choice:** Views are placed at `resources/views/modules/<Name>/` (within the standard `resources/views` root) to avoid needing to register extra view namespaces. This is the least-friction approach compatible with Livewire 4 and Blade's default resolver.

## Risks / Trade-offs

- **[Risk] Livewire view resolution breaks after move** → Mitigation: Explicitly set `$view` on every moved component; run full test suite after migration.
- **[Risk] Route loading order changes** → Mitigation: Module `routes.php` files are loaded after global auth routes in `AppServiceProvider::boot()`, preserving the existing middleware grouping.
- **[Risk] Namespace collision** → Mitigation: Module namespaces follow `App\Modules\<TitleCase>\`; no existing class uses this prefix.
- **[Trade-off] Views split across two trees** → `resources/views/modules/` is still separate from the PHP module. This is an accepted trade-off to avoid registering custom Blade view namespaces, keeping the solution simple for now.

## Migration Plan

1. Create module directories for `Users`, `Dashboard`, and `Profile`.
2. Move Livewire classes (updating namespaces) into `app/Modules/<Name>/Livewire/`.
3. Move Blade views into `resources/views/modules/<name>/`.
4. Update `$view` properties on all moved components.
5. Register module route files in `AppServiceProvider::boot()`.
6. Move per-feature route groups from `routes/web.php` into per-module `routes.php` files.
7. Update `routes/web.php` to only contain global/auth routes.
8. Update `use` statements in all files that reference moved classes.
9. Run `composer dump-autoload` and full test suite.
10. Run `vendor/bin/pint --dirty` for formatting.

**Rollback:** Git revert — no database schema changes means zero-risk rollback.
