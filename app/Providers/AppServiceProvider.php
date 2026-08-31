<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        $this->configureDefaults();
        $this->loadMigrationsFrom($this->migrationPaths());
    }

    /**
     * Get the migration directories used by the application.
     *
     * @return array<int, string>
     */
    protected function migrationPaths(): array
    {
        return array_values(array_unique([
            database_path('migrations'),
            database_path('migrations/Academico'),
            database_path('migrations/Estudiante'),
            database_path('migrations/Evaluacion'),
            database_path('migrations/Institucional'),
            database_path('migrations/Profesor'),
            database_path('migrations/Usuarios'),
        ]));
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
