<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Setting;
use Database\Seeders\SettingSeeder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        if (Setting::all()->isEmpty()) {
            $permissionSeed = new SettingSeeder;
            $permissionSeed->run();
        }
        return view('admin.setting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request , ImageService $imageService): RedirectResponse
    {
        DB::transaction(function () use($request , $imageService) {
            $inputs = $request->all();
            
            if ($request->hasFile('settings.logo'))  {
                $imageService->setExclusiveDirectory("images" . DIRECTORY_SEPARATOR . "settings");
                $imageService->setImageName('logo');
                $inputs['settings']['logo'] = $imageService->save($inputs['settings']['logo']);
            }  

            foreach ($inputs['settings'] as $key => $value) {
                Setting::updateOrCreate([
                    'key'   =>  $key,
                ], [
                    'key'   =>  $key,
                    'value' =>  $value
                ]);
            }
        });

        return back()->with('toast-success' , 'تنظیمات ذخیره شد'); 
    }
}
