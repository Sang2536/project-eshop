<?php

namespace App\Providers;

use App\Models\User as ModelsUser;
use App\Models\UserRole as ModelsUoseRole;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        // gate
        Gate::define('administrator', function (ModelsUser $user) {
            $role = ModelsUoseRole::where('user_roles.ur_uid', $user->id)
                    ->join('roles', 'user_roles.ur_rid', 'roles.id')
                    ->select('roles.type as r_type')->first();

            return $role->r_type === 'administrator';
        });
    }
}
