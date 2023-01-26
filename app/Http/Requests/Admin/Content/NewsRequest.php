<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
                'body'             => 'required',
                'image'            => 'required|image|max:3072|min:1',
                'published_at'     => 'required',        
                'status'           => 'nullable|in:0,1',    
                'is_pined'         => 'nullable|in:0,1',    
                'is_fire_station'  => 'nullable|in:0,1',            
            ];
        }

        return [

        ];
    }
}
