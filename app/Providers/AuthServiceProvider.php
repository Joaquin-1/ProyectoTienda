<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    //Permite el acceso solo si el rol del usuario es admin
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('solo-admin', function (User $user) {
            return $user->rol == 'admin' ?
                Response::allow() :
                Response::deny('Sólo el administrador puede entrar.');
        });
    }
}
