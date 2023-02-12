<?php

namespace Database\Seeders;

use App\Models\ACL\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::LIST_OF_PERMISSIONS as $key => $permission)
        {
            Permission::create([
                'key'           => $key,
                'title'         => $permission['title'],
                'check_owner'   => $permission['check_owner'] ? '1' : '0'
            ]);
        }
    }
}
