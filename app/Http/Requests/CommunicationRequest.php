<?php

namespace App\Http\Requests;

use App\Models\Communication;
use App\Rules\Recaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommunicationRequest extends FormRequest
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
            'g-recaptcha-response' => ['required' , new Recaptcha],
            'full_name'=> 'required|min:2|max:150',
            'subject'=> 'required|min:2|max:300',
            'type'=> ['required', Rule::in(array_keys(Communication::REQUEST_TYPES))],
            'phone' => ['nullable', 'numeric', 'regex:/09(1[0-9]|9[1-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/i', 'digits:11'],
            'description'=> 'required|min:2|max:50000',
            'address'=> 'nullable|min:2|max:500'
        ];
    }

    public function attributes() 
    {
        return [
            'full_name'=> 'نام و نام خانوادگی',
            'subject'=> 'موضوع درخواست',
            'type'=> 'نوع درخواست',
            'phone'=> 'شماره تلفن'
        ];
    }
}
