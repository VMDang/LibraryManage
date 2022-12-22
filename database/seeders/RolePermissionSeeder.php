<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Admin has all permissions Book, Account, System and Account Mod&User:Update role, delete
     * Moderator has permission Book:all, Account:all, System:report and Account User:Delete
     * User has permission Book:readonly, Account:all, System:report
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_permissions')->insert([
            [
                'role_id'         => 1,
                'permission_id'   => 1,
                'object'          => 'Book',
                'code_action'     => 'ALL_BOOK',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 1,
                'permission_id'   => 1,
                'object'          => 'Account me',
                'code_action'     => 'ALL_ACC',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 1,
                'permission_id'   => 1,
                'object'          => 'System',
                'code_action'     => 'ALL_SYSTEM',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 1,
                'permission_id'   => 4,
                'object'          => 'Account Mod',
                'code_action'     => 'UPDATE_MOD',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 1,
                'permission_id'   => 4,
                'object'          => 'Account Mod',
                'code_action'     => 'DEL_MOD',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 1,
                'permission_id'   => 4,
                'object'          => 'Account User',
                'code_action'     => 'UPDATE_USER',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 1,
                'permission_id'   => 5,
                'object'          => 'Account Mod',
                'code_action'     => 'DELETE_USER',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 2,
                'permission_id'   => 1,
                'object'          => 'Book',
                'code_action'     => 'ALL_BOOK',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 2,
                'permission_id'   => 1,
                'object'          => 'Account me',
                'code_action'     => 'ALL_ACC',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 2,
                'permission_id'   => 5,
                'object'          => 'Account User',
                'code_action'     => 'DEL_USER',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 2,
                'permission_id'   => 6,
                'object'          => 'System',
                'code_action'     => 'REPORT_SYSTEM',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 3,
                'permission_id'   => 6,
                'object'          => 'System',
                'code_action'     => 'REPORT_SYSTEM',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
        ]);
    }
}
