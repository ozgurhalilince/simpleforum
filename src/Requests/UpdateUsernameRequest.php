<?php

namespace Ozgurince\Simpleforum\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsernameRequest extends FormRequest
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
            'password' => 'required',
            'username' => 'required|max:20|unique:users,email,'.request()->user_id,
        ];
    }
}
