<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
    }
}
