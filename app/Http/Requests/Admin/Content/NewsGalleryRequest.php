<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class NewsGalleryRequest extends FormRequest
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
            'image'     =>      'required',
            'alt'       =>      'required' ,  
        ];
    }

    public function attributes()
    {
        return [
            'image'     =>      'عکس',
            'alt'       =>      'alt تصویر' ,  
        ];
    }
}
