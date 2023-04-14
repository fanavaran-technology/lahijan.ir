<?php

namespace App\Http\Requests\Admin\Clarification;

use Illuminate\Foundation\Http\FormRequest;

class InvestmentRequest extends FormRequest
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
            "title"=> "required|min:2|max:300",
            "category_id"=> "required|exists:investment_categories,id",
            "description"=> "required|min:2|max:30000",
            "position"=> "required|min:2|max:300",
            "investor_task"=> "required|min:2|max:300",
            "municipality_task"=> "required|min:2|max:300",
            "start_date" => "required",
            "end_date" => "required",
            'image' => $this->isMethod('post') ? 'required|image|max:3072|min:1' : 'nullable|image|max:3072|min:1',
            'file' => "nullable|min:2|max:512|mimes:pdf",
        ];
    }
}