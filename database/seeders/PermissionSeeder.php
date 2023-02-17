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
        foreach (Permission::LIST_OF_PERMISSIONS as $key => $value)
        {
            Permission::create([
                'key'           => $key,
                'title'         => $value
            ]);
        }
    }
}
