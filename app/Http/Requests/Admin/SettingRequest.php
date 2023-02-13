<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        return [
            'settings.title'         =>      'nullable|string|min:3|max:200',
            'settings.logo'          =>      'nullable|mimes:jpg,png,webp,jpeg|min:2|max:1024',
            'settings.description'   =>      'nullable|string|min:3|max:2000',
            'settings.keywords'      =>      'nullable|string|max:2000',
            'settings.telephone'     =>      'nullable|digits:11',
            'settings.email'         =>      'nullable|email|max:200',
            'settings.fax'           =>      'nullable|numeric',
            'settings.instagram'     =>      'nullable|url',
            'settings.telegram'      =>      'nullable|url',
            'settings.whatsapp'      =>      'nullable|url',
            'settings.eita'          =>      'nullable|url',
            'settings.sorush'        =>      'nullable|url',

        ];
    }
}
