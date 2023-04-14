<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class MayorRequest extends FormRequest
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
                'full_name'            => 'required|min:2|max:150',
                'birthdate'            => 'required',
                'recruitment'          => 'required',
                'place_birth'          => 'required|min:2|max:150',
                'term_responsibility'  => 'required|min:2|max:150',
                'image'                => 'required|image|mimes:png,jpg,jpeg,gif|max:3072|min:1',
                'status'               => 'nullable|in:0,1',
            ];
        }
        return [
            'full_name'            => 'required|min:2|max:150',
            'birthdate'            => 'required',
            'recruitment'          => 'required',
            'place_birth'          => 'required|min:2|max:150',
            'term_responsibility'  => 'required|min:2|max:150',
            'image'                => 'nullable|image|mimes:png,jpg,jpeg,gif|max:3072|min:1',
            'status'               => 'nullable|in:0,1',
        ];
    }

    public function attributes()
    {
        return [
            'full_name'=> 'نام و نام خانوادگی',
            'place_birth'=> 'محل تولد',
            'image'=> 'تصویر شهردار',
            'term_responsibility'=> 'مدت مسئولیت',
        ];
    }
}
