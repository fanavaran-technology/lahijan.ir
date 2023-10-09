<?php

namespace Modules\Complaint\Http\Controllers\Admin;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Modules\Complaint\Http\Controllers\HelperController;

class SettingController extends Controller
{
    private $configPath;

    public function __construct() {
        $this->configPath = config('complaint.setting_path');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $config = json_decode(file_get_contents($this->configPath), true);
        return view('complaint::admin.setting', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function store(Request $request): RedirectResponse
    {
        $validData = $request->validate([
            'send_sms_operator' => 'numeric|in:0,1',
            'send_sms_plaintiff'=> 'numeric|in:0,1',
            'confirm_referrer'  => 'numeric|in:0,1'
        ]); 

        $config = json_decode(file_get_contents($this->configPath), true);

        $newConfig = [];
        foreach ($config as $key => $value) {
            $newConfig[$key] = $request->has($key) ?  filter_var($validData[$key], FILTER_VALIDATE_BOOLEAN) : false;
        }

        file_put_contents($this->configPath, json_encode($newConfig, JSON_PRETTY_PRINT));

        return back()->with('toast-success', 'تغییرات با موفقیت اعمال شد.');
    }

    public static function isEnabled($key) 
    {
        $configFilePath = config('complaint.setting_path');
        $config = json_decode(file_get_contents($configFilePath), true);

        if (in_array($key, $config)) {
            return $config[$key];
        }

        throw new Exception('Undifiend array key on complaint settings');
    }

}
