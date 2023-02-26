<?php

namespace App\Http\Requests\Clarification;

use Illuminate\Foundation\Http\FormRequest;

class SalaryRequest extends FormRequest
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
            'title'          =>  'required|min:2|max:500',
            'description'    =>  'nullable|min:2|max:1000',
            'perssonel_id.*' =>  'required|exists:perssonels,id',
            'amount.*'       =>  'required|numeric|min:100000|max:999999999999',         
        ];
    }

    public function messages()
    {
        return [
          'amount.*'    =>   'حداقل مبلغ قابل ثبت 100000 هزار ریال می باشد.'        
        ];
    }
}
