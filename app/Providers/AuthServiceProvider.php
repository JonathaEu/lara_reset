<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\iten;
use App\Models\reserva;
use App\Policies\ItenPolicy;
use App\Policies\ReservaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Tymon\JWTAuth\Facades\JWTProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        iten::class => ItenPolicy::class,
        reserva::class => ReservaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        JWTProvider::class;
    }
}