<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Default 6 permissions are All(CRUD), Create, Read, Update, Delete and Report
     * Only admin can add other roles or edit status role current
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'all',
                'created_by' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'create',
                'created_by' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'read',
                'created_by' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'update',
                'created_by' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'delete',
                'created_by' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'report',
                'created_by' => 1,
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
