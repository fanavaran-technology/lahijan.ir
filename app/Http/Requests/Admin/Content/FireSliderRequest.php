<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class FireSliderRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'alt' => 'required|max:120|min:2',
                'url' => 'nullable|max:500|',
                'image'  => 'required|image|mimes:png,jpg,jpeg,gif|max:3072|min:1',

            ];
        }
        else{
            return [
                'alt' => 'required|max:120|min:2',
                'url' => 'max:500',
                'image' => 'image|mimes:png,jpg,jpeg,gif|max:3072|min:1',
            ];
        }
    }

}
