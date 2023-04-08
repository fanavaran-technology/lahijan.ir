<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ChangePasswordController extends Controller
{
    public function __invoke(Request $request , User $user): RedirectResponse
    {
        $this->validation['password'] = ['required', 'confirmed', Rules\Password::defaults()];

        if ($request->user()->id == $user->id)
            return $this->changeYourPassword($request);


        return $this->changeOtherUserPassword($request , $user);
    }
    
    private function changeYourPassword($request)
    {
        $this->validation['old_password'] = 'required';

        $validated  = $request->validate($this->validation);
        
        if (!Hash::check($validated['old_password'] , auth()->user()->password))
            return back()->with('toast-error' , 'کلمه عبور فعلی اشتباه است.');


        auth()->user()->update([
            'password'  =>   $validated['password']
        ]);

        $user = auth()->user()->full_name;

        Log::warning("$user} رمز عبور خود را تغییر داد.");

        return back()->with('toast-success' , 'کلمه عبور تغییر یافت.'); 
    }

    private function changeOtherUserPassword($request,User $user)
    {
        $validated = $request->validate($this->validation);

        $user->update([
            'password'  =>   $validated['password']
        ]);

        Log::warning("رمز عبور کاربر {$user->full_name} توسط {auth()->user()->full_name} تغییر داده شد.");

        return back()->with('toast-success' , 'کلمه عبور تغییر یافت.'); 
    }

    

}
