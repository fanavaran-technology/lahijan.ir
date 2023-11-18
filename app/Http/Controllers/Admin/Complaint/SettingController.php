<?php

namespace App\Http\Controllers\Admin\Complaint;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    private $configPath;

    public function __construct() {
        $this->middleware('can:manage_complaint');
        $this->configPath = config('complaint.setting_path');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $config = json_decode(file_get_contents($this->configPath), true);
        return view('admin.complaint.setting', compact('config'));
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
            'notifications.*' => 'numeric|in:0,1',
            'max-files' => 'required|integer|min:1|max:10',
            'max-file-size' => 'required|integer|min:1|max:10',
            'deadline-responding' => 'required|integer|min:1|max:1000',
            'confirm_referrer' => 'numeric|in:0,1'
        ]); 

        $configs = json_decode(file_get_contents($this->configPath), true);
        foreach ($configs['notifications'] as $key => $value) {
            $configs['notifications'][$key] = $request->input("notifications.{$key}") ? (bool) $request->input("notifications.{$key}") : false;
        }
        unset($validData['notifications']);

        $validData['confirm_referrer'] = (bool) $request->get('confirm_referrer');
        
        if (!$validData['confirm_referrer'])
        $configs['notifications']['send_sms_confirm_referrer'] = false;
        
        $configs = array_replace($configs, $validData);

        file_put_contents($this->configPath, json_encode($configs, JSON_PRETTY_PRINT));

        $userName = auth()->user()->full_name;

        Log::info("{$userName} تنظیمات شکایت را بروز رسانی کرد.");

        return back()->with('toast-success', 'تغییرات با موفقیت اعمال شد.');
    }

}

