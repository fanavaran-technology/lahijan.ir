<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'full_name' => 'required|string|min:3|max:255',
                'username' => 'required|unique:users,username|string|max:64|min:4',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'email' => 'nullable|unique:users,email|email',
                'mobile' => ['required', 'numeric', 'regex:/09(1[0-9]|9[1-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/i', 'digits:11', 'unique:users,mobile'],
                'profile_photo' => 'nullable|image|max:2048|min:1',
                'mobile_verify' => 'nullable|in:0,1|numeric',
                'email_verify' => 'nullable|in:0,1|numeric',
                'is_staff' => 'nullable|in:0,1|numeric',
                'is_block' => 'nullable|in:0,1|numeric',
            ];
        }

        return [
            'full_name' => 'required|string|min:3|max:255',
            'username' => ['required', Rule::unique('users' , 'username')->ignore($this->user->id),'string','max:64','min:4'],
            'email' => ['nullable', Rule::unique('users' , 'email')->ignore($this->user->id),'email'],
            'mobile' => ['required', 'numeric' , Rule::unique('users' , 'mobile')->ignore($this->user->id), 'regex:/09(1[0-9]|9[1-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/i', 'digits:11'],
            'mobile_verify' => 'nullable|in:0,1|numeric',
            'email_verify' => 'nullable|in:0,1|numeric',
            'is_staff' => 'nullable|in:0,1|numeric',
            'is_block' => 'nullable|in:0,1|numeric',
        ];


    }
}
