<?php

namespace App\Http\Requests\Complaint;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\Recaptcha;


class TrackingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tracking_code' => 'required|digits:9|exists:complaints,tracking_code',
            'g-recaptcha-response' => ['required' , new Recaptcha],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages() {
        return [
            'digits' => 'کد پیگیری معتبر نیست.',
            'exists' => 'کد پیگیری معتبر نیست.',
            'tracking_code' => [
                'required' => 'کد پیگیری را وارد کنید.'
            ]
        ];
    }

    protected function failedValidation(Validator $validator) 
    {   
        $errors = $validator->errors();

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false, 'errors' => $errors], 422));        
        }
    }
}

