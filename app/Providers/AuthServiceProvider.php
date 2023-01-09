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

        $permissions = false;

        $configFile = dirname(__DIR__, 1) . '/VoyagerDataTransport/config/permissions/config.php';

        if ( file_exists( $configFile ) ) {
            $permissions = require $configFile;
        }

        $hasPermission = !empty( $permissions ) && ( count($permissions) > 0 );

        $permissions = $hasPermission ? $permissions : false;

        if (false !== $permissions) {
            foreach ( $permissions as $permission ) {
                Gate::define($permission, function (User $user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }

    }
}
