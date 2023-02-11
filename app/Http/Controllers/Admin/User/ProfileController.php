<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Image\ImageService;

class ProfileController extends Controller
{

    public function __construct() 
    {
        $this->middleware('password.confirm');
    }

    public function index()
    {
        return view('admin.user.profile' , ['user' => auth()->user()]);
    }

    public function update(Request $request , imageService $imageService)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'full_name' => 'required|string|min:3|max:255',
            'username' => ['required', Rule::unique('users' , 'username')->ignore($user->id),'string','max:64','min:4'],
            'email' => ['nullable', Rule::unique('users' , 'email')->ignore($user->id),'email'],
            'mobile' => ['required', 'numeric' , Rule::unique('users' , 'mobile')->ignore($user->id), 'regex:/09(1[0-9]|9[1-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/i', 'digits:11'],
            'profile_photo' => 'nullable|image|max:2048|min:1',
        ]);

        DB::transaction(function () use($validated , $request , $imageService , $user){
            if ($request->hasFile('profile_photo')) {
                if (!empty($user->profile_photo))
                    $imageService->deleteImage($user->profile_photo);
                
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "user" . DIRECTORY_SEPARATOR . "avatars");
                $image = $imageService->save($request->profile_photo);
                $validated['profile_photo'] = $image;
            }

            $user->update($validated);
        });
        
        return back()->with('toast-success' , 'اطلاعات کاربری بروز رسانی شد.'); 
    }
}
