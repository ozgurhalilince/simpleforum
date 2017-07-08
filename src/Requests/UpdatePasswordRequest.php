<?php

namespace Ozgurince\Simpleforum\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'old_password' => 'required|between:6,30',
            'password' => 'required|between:6,30',
            'password_repeat' => 'required|between:6,30|same:password',
        ];
    }
}
