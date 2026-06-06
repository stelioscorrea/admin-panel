<?php

namespace App\Providers;

use App\Modules\Components\Livewire\ConfirmModal;
use App\Modules\Dashboard\Livewire\Index;
use App\Modules\Dashboard\Livewire\MetricCard;
use App\Modules\Users\Livewire\Create;
use App\Modules\Users\Livewire\Edit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict(! $this->app->isProduction());

        Blade::directive('role', function (string $role): string {
            return "<?php if(auth()->check() && auth()->user()->role === \\App\\Enums\\UserRole::from({$role})): ?>";
        });

        Blade::directive('endrole', function (): string {
            return '<?php endif; ?>';
        });

        $this->registerLivewireModules();
        $this->loadModuleRoutes();
    }

    /**
     * Register Livewire component namespaces for each module.
     *
     * This allows using short aliases like <livewire:dashboard.index />
     * rather than the full module namespace path.
     */
    protected function registerLivewireModules(): void
    {
        Livewire::component('dashboard.index', Index::class);
        Livewire::component('dashboard.metric-card', MetricCard::class);

        Livewire::component('users.index', \App\Modules\Users\Livewire\Index::class);
        Livewire::component('users.create', Create::class);
        Livewire::component('users.edit', Edit::class);

        Livewire::component('profile.edit', \App\Modules\Profile\Livewire\Edit::class);

        Livewire::component('components.confirm-modal', ConfirmModal::class);
    }

    /**
     * Auto-load routes from all modules under app/Modules/{name}/routes.php.
     *
     * Each module route file is wrapped in the `web` + `auth` middleware group
     * so all module routes inherit the standard session and authentication stack.
     */
    protected function loadModuleRoutes(): void
    {
        $moduleRoutes = glob(app_path('Modules/*/routes.php'));

        foreach ($moduleRoutes as $routeFile) {
            Route::middleware(['web', 'auth'])->group($routeFile);
        }
    }
}
