<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ACL\Permission;
use App\Models\Setting;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            Log::info("تمام دسترسی ها ساخته شد.");
        }

        if (Setting::all()->isEmpty()) {
            $settingSeed = new SettingSeeder;
            $settingSeed->run();
            Log::info("تنظیمات پیش فرض اعمال شد.");
        }

        return view('admin.index');
    }
}
