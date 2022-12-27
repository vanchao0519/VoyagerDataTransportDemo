<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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
    public function boot()
    {
        $this->registerPolicies();

        //Regist the privilege which can be used in blade template
        Gate::define('browse_import_posts', function (User $user) {
            return $user->hasPermission('browse_import_posts');
        });
        Gate::define('browse_export_posts', function (User $user) {
            return $user->hasPermission('browse_export_posts');
        });
    }
}
