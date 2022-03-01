<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'username' => 'required|min:6|max:255|string',
            'password' => 'required|min:6|max:255',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => '__("Password required")',
            'username.required' => '__("Username required")',
            'username.string' => '__("Username is string")',
            'password.min' => '__("Password min")',
            'password.max' => '__("Password max")',
            'username.min' => '__("Username min")',
            'username.max' => '__("Username max")',
        ];
    }
}
