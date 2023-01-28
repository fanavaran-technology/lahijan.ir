<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
                'title'            => 'required|min:2|max:200',
                'description'      => 'required',
                'location'         => 'required',
                'image'            => 'required|image|max:3072|min:1',
                'status'           => 'nullable|in:0,1',    
            ];
        }

        return [
            'title'            => 'required|min:2|max:200',
            'description'      => 'required',
            'location'         => 'required',
            'image'            => 'nullable|image|max:3072|min:1',
            'status'           => 'nullable|in:0,1',    
        ];
    }
}
