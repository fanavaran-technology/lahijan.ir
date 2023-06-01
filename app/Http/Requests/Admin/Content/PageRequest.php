<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title'           => 'required|max:120|min:2',
            'body'            => 'required|max:5000|min:5',
            'is_draft'        => 'numeric|in:0,1',
            'keywords'        => 'nullable',
            'is_quick_access' => 'numeric|in:0,1',
        ];
    }

    public function attributes()
    {
        return  [
            'body' => 'متن',
        ];
    }
}
