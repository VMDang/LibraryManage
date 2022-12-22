<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Default 3 original roles are Administrators, Moderator and User
     * Only admin can add other roles or edit status role current
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Mod',
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'User',
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
