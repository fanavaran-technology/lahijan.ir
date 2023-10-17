<?php

namespace App\Http\Requests\Admin\Complaint;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'title' => 'required|max:120|min:1|unique:departements,title',
            ];
        }

        return [
            'title' => [ 'required', 'max:120', 'min:1', Rule::unique('departements')->ignore($this->departement->id) ],
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
}
