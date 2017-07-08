<?php

namespace Ozgurince\Simpleforum\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [ 
            'name' => 'required',
            'email' => 'required|max:40|unique:users,email',
            'username' => 'required|max:20|unique:users,email',
            'password' => 'between:6,30',
            'role_id' => 'required',
        ];
    }
}
