<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use function Symfony\Component\String\u;

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
        Gate::define('isAdmin', function (User $me, User $user = null){
            if (empty($user)) {
                $user = $me;
            }
            return DB::table('users', 'u')
                ->join('roles as r', 'r.id', '=', 'u.role_id')
                ->where([
                    ['u.id', '=', $user->id],
                    ['r.name', '=', 'Admin']
                ])->exists();
        });

        Gate::define('isMod', function (User $me, User $user = null){
            if (empty($user)) {
                $user = $me;
            }
            return DB::table('users', 'u')
                ->join('roles as r', 'r.id', '=', 'u.role_id')
                ->where([
                    ['u.id', '=', $user->id],
                    ['r.name', '=', 'Mod']
                ])->exists();
        });

        Gate::define('isUser', function (User $me, User $user = null){
            if (empty($user)) {
                $user = $me;
            }
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
        Gate::define('UPDATE_OTHER_ACC', function (User $me, User $user = null){
            if (empty($user)) {
                $user = $me;
            }
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

        Gate::define('DEL_OTHER_ACC', function (User $me, User $user = null){
            if (empty($user)) {
                $user = $me;
            }
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

        Gate::define('Locked', function (User $me, User $user = null){
            if (empty($user)) {
                $user = $me;
            }
           return DB::table('users')
                    ->where([
                        ['users.id', '=' , $user->id],
                        ['users.status', '=', 0],
                    ])
                    ->exists();
        });

        VerifyEmail::toMailUsing(function ($notification, $url) {
            return (new MailMessage())
                ->from('LibraryManage@mail.com', 'Library Manage')
                ->subject("Th??ng b??o x??c th???c email")
                ->greeting('Xin ch??o !')
                ->line("Vui l??ng nh???p v??o n??t b??n d?????i ????? x??c minh ?????a ch??? email c???a b???n.")
                ->action("X??c th???c email", $url)
                ->line("N???u b???n kh??ng t???o t??i kho???n, vui l??ng b??? qua email n??y v?? kh??ng c???n th???c hi???n th??m h??nh ?????ng n??o.");
        });
    }
}
