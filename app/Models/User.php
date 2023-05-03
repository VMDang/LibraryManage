<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, Prunable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'image', 'gender', 'birthday', 'email', 'phone', 'address',
        'password', 'status', 'deleted_by', 'updated_role_by', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the prunable model query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function prunable()
    {
        return static::where('deleted_at', '<=', now());
    }

    /**
     * Delete avatar user in folder Storage (local).
     *
     * @return void
     */
    protected function pruning()
    {
        $users = User::onlyTrashed()->get('image');
        foreach ($users as $user) {
            $path = 'public/avatars/' . Str::afterLast($user->image, '/');
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
    }

    /**
     *  Send notification use Notifiable Trait
     *
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token)); 
    }
}
