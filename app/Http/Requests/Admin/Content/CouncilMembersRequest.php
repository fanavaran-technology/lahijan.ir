<?php

namespace App\Http\Requests\Admin\Content;

use App\Http\Controllers\Admin\Content\CouncilMemberController;
use App\Models\Communication;
use App\Models\Content\CouncilMember;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouncilMembersRequest extends FormRequest
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
                'full_name'  => 'required|min:2|max:150',
                'type'       => ['required', Rule::in(array_keys(CouncilMember::REQUEST_TYPES))],
                'image'      => 'required|image|mimes:png,jpg,jpeg,gif|max:3072|min:1',

            ];
        }
        return [
            'full_name'     => 'required|min:2|max:150',
            'type'          => ['required', Rule::in(array_keys(CouncilMember::REQUEST_TYPES))],
            'image'         => 'nullable||image|mimes:png,jpg,jpeg,gif|max:3072|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'full_name'=> 'نام و نام خانوادگی',
            'type'=> 'سمت شورا',
        ];
    }
}
