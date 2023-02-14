<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Admin has all permissions Other Object(Category, Location, Feedback,...), Account, System and Account Mod&User:Update role, delete
     * Moderator has permission OtherObject:all, Account:all, System:report and Account User:Delete
     * User has permission OtherObject:readonly, Account:all, System:report
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_permissions')->insert([
            [
                'role_id'         => 1,
                'permission_id'   => 1,
                'object'          => 'Other Object',
                'code_action'     => 'ALL_OTHER',
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
                'object'          => 'Other User Account',
                'code_action'     => 'UPDATE_OTHER_ACC',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 1,
                'permission_id'   => 5,
                'object'          => 'Other User Account',
                'code_action'     => 'DEL_OTHER_ACC',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 2,
                'permission_id'   => 1,
                'object'          => 'Other Object',
                'code_action'     => 'ALL_OTHER',
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
                'object'          => 'Other User Account',
                'code_action'     => 'DEL_OTHER_ACC',
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
                'permission_id'   => 3,
                'object'          => 'Other Object',
                'code_action'     => 'VIEW_OTHER',
                'created_by'      => 1,
                'created_at'      => Carbon::now()
            ],
            [
                'role_id'         => 3,
                'permission_id'   => 1,
                'object'          => 'Account me',
                'code_action'     => 'ALL_ACC',
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
