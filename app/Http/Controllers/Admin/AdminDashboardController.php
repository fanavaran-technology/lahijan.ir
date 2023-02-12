<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ACL\Permission;
use Database\Seeders\PermissionSeeder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): View
    {
        if (Permission::all()->isEmpty()) {
            $permissionSeed = new PermissionSeeder;
            $permissionSeed->run();
        }

        return view('admin.index');
    }
}
