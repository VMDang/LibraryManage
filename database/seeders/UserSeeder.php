<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Create 2 Admin and 3 Moderator
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'name' => 'Admin1',
                'image' => config('app.avatarDefaultMale'),
                'gender' => 1,
                'birthday' => '2000-01-01',
                'email' => 'admin1@gmail.com',
                'phone' => '+84123456789',
                'address' => 'Ha Noi - Viet Nam',
                'password'  => Hash::make(env('PASSWORD_ADMIN_DEFAULT')),
                'status'  => 1,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 1,
                'name' => 'Admin2',
                'image' => config('app.avatarDefaultFemale'),
                'gender' => 0,
                'birthday' => '2000-01-01',
                'email' => 'admin2@gmail.com',
                'phone' => '+81987654321',
                'address' => 'Tokyo - Japan',
                'password'  => Hash::make(env('PASSWORD_ADMIN_DEFAULT')),
                'status'  => 1,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 2,
                'name' => 'Mod1',
                'image' => config('app.avatarDefaultMale'),
                'gender' => 1,
                'birthday' => '2000-01-01',
                'email' => 'mod1@gmail.com',
                'phone' => '+84159753',
                'address' => 'Viet Nam',
                'password'  => Hash::make(env('PASSWORD_MOD_DEFAULT')),
                'status'  => 1,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 2,
                'name' => 'Mod2',
                'image' => config('app.avatarDefaultMale'),
                'gender' => 1,
                'birthday' => '2000-01-01',
                'email' => 'mod2@gmail.com',
                'phone' => '+84456852',
                'address' => 'Japan',
                'password'  => Hash::make(env('PASSWORD_MOD_DEFAULT')),
                'status'  => 1,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 2,
                'name' => 'Mod3',
                'image' => config('app.avatarDefaultFemale'),
                'gender' => 0,
                'birthday' => '2000-01-01',
                'email' => 'mod3@gmail.com',
                'phone' => '+81096248',
                'address' => 'Japan',
                'password'  => Hash::make(env('PASSWORD_MOD_DEFAULT')),
                'status'  => 1,
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
