<?php

namespace App\Providers;

use App\Interfaces\Authentication\AuthenticationTokenService;
use App\Services\Authentication\JWTAuthenticationTokenService;
use App\Services\Authentication\SanctumAuthenticationTokenService;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
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
        Password::defaults(function () {
            $rule = Password::min(6);

            return match ($this->app->environment()) {
                'production' => $rule
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'local' => $rule,
            };
        });

        Model::shouldBeStrict();

        Date::use(CarbonImmutable::class);

        $this->app->bind(AuthenticationTokenService::class, JWTAuthenticationTokenService::class);
    }
}
