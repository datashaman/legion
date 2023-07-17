<?php

namespace App\Providers;

use App\Models\Chat;
use App\Policies\ChatPolicy;
// use Illuminate\Support\Facades\Gate;
use App\Models\Persona;
use App\Policies\PersonaPolicy;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Chat::class => ChatPolicy::class,
        Persona::class => PersonaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
