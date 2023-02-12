<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $route = Route::current();
        if($route->getName() === 'admin.user.roles.store'){
            return [
                'title'         => 'required|max:120|min:1',
                'description'   => 'required|max:200|min:1',
                'permissions.*' => 'exists:permissions,id',
            ];
        }
        elseif($route->getName() === 'admin.user.roles.update')
        {
            return [
                'title'         => 'required|max:120|min:1',
                'description'   => 'required|max:200|min:1',
            ];
        }
        elseif($route->getName() === 'admin.user.roles.permission-update')
        {
            return [
                'permissions.*' => 'exists:permissions,id',
            ];
        }
        
    }
}
