<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'title'            => 'required|min:2|max:200',
            'parent_id'        => 'nullable|exists:menus,id',
            'url'              => 'required|url',
            'status'           => 'nullable|in:0,1',    
        ];
    }
}
