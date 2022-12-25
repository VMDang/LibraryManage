<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Check logged-in user is Admin, Mod, User
         */
        Gate::define('isAdmin', function (User $user){
            return DB::table('users', 'u')
                ->join('roles as r', 'r.id', '=', 'u.role_id')
                ->where([
                    ['u.id', '=', $user->id],
                    ['r.name', '=', 'Admin']
                ])->exists();
        });

        Gate::define('isMod', function (User $user){
            return DB::table('users', 'u')
                ->join('roles as r', 'r.id', '=', 'u.role_id')
                ->where([
                    ['u.id', '=', $user->id],
                    ['r.name', '=', 'Mod']
                ])->exists();
        });

        Gate::define('isUser', function (User $user){
            return DB::table('users', 'u')
                ->join('roles as r', 'r.id', '=', 'u.role_id')
                ->where([
                    ['u.id', '=', $user->id],
                    ['r.name', '=', 'User']
                ])->exists();
        });

        Gate::define('All_ACC', function (User $user){
            return DB::table('users', 'u')
                ->join('roles as r', 'u.role_id', '=', 'r.id')
                ->join('roles_permissions as rp', 'r.id', '=', 'rp.role_id')
                ->join('permissions as p', 'p.id', '=', 'rp.permission_id')
                ->where([
                    ['u.id', '=', $user->id],
                    ['r.status', '=', 1],
                    ['p.status', '=', 1],
                    ['rp.status', '=', 1],
                    ['rp.code_action', '=', 'ALL_ACC'],
                ])->exists();
        });

        /**
         * Check logged-in user has permission: update role or delete account other user
         */
        Gate::define('UPDATE_OTHER_ACC', function (User $user){
            return DB::table('users', 'u')
                ->join('roles as r', 'u.role_id', '=', 'r.id')
                ->join('roles_permissions as rp', 'r.id', '=', 'rp.role_id')
                ->join('permissions as p', 'p.id', '=', 'rp.permission_id')
                ->where([
                    ['u.id', '=', $user->id],
                    ['r.status', '=', 1],
                    ['p.status', '=', 1],
                    ['rp.status', '=', 1],
                    ['rp.code_action', '=', 'UPDATE_OTHER_ACC'],
                ])->exists();
        });

        Gate::define('DEL_OTHER_ACC', function (User $user){
            return DB::table('users', 'u')
                ->join('roles as r', 'u.role_id', '=', 'r.id')
                ->join('roles_permissions as rp', 'r.id', '=', 'rp.role_id')
                ->join('permissions as p', 'p.id', '=', 'rp.permission_id')
                ->where([
                    ['u.id', '=', $user->id],
                    ['r.status', '=', 1],
                    ['p.status', '=', 1],
                    ['rp.status', '=', 1],
                    ['rp.code_action', '=', 'DEL_OTHER_ACC'],
                ])->exists();
        });
    }
}
