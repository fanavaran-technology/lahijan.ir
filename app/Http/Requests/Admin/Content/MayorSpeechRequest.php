<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class MayorSpeechRequest extends FormRequest
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
            'full_name'            => 'required|min:2|max:150',
            'description'          => 'required|min:2|max:300',
            'image'                => 'nullable|image|mimes:png,jpg,jpeg,gif|max:3072|min:1',
            'status'               => 'nullable|in:0,1',
        ];
    }
}
