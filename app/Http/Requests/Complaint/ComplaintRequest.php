<?php

namespace App\Http\Requests\Complaint;

use App\Rules\Recaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\Complaint\ComplaintFilesRule;

class ComplaintRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => 'required|string|min:3|max:255',
            'last_name'     => 'required|string|min:3|max:255',
            'national_code' => 'required|numeric|digits:10',
            'phone_number'  => 'required|numeric|regex:/(09)[0-9]{9}/|digits:11',
            'main_st'       => 'required|string|max:255',
            'auxiliary_st'  => 'nullable|string|max:255',
            'alley'         => 'nullable|string|max:255',
            'deadend'       => 'nullable|string|max:255',
            'building_name' => 'nullable|string|max:255',
            'postal_code'   => 'nullable|string|max:10',
            'subject'       => 'required|string|max:255',
            'description'   => 'required|string|max:5000',
            'files'         => ['nullable', new ComplaintFilesRule],
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

    public function attributes() {
        return [
            'national_code' => 'کد ملی',
            'subject'       => 'موضوع شکایت',
            'description'   => 'شرح شکایت'
        ];
    }

    public function messages() {
        return [
            'max' => 'طول کاراکتر ها بیش از حد مجاز است.'
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
