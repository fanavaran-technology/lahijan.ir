<?php

namespace App\Http\Requests\Admin\Clarification;

use Illuminate\Foundation\Http\FormRequest;

class PerssonelRequest extends FormRequest
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
            'first_name'            =>  'required|min:2|max:100',
            'job'                   =>  'required|min:2|max:150',
            'is_disable'            =>  'nullable|in:0,1'
        ];
    }
}
