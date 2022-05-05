<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserAPIRequest extends FormRequest
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
            'username' => 'required|min:6|unique:users,username',
            'password' => 'required|min:6',
            'fullname' => 'required|string|min:6|max:255',
            'dob' => 'date',
            'address' => 'required|min:6|max:255',
            'email' => 'email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => __('username.unique'),
            'fullname.required' => __('name.required'),
            'username.required' => __('username.required'),
            'username.min' => __('username.min'),
            'dob.date' => __('date.date'),
            'address.required' => __('address.required'),
            'fullname.string' => __('name.string'),
            'fullname.min' => __('name.min'),
            'fullname.max' => __('name.max'),
            'address.min' => __('address.min'),
            'address.max' => __('address.max'),
            'email.email' => __('email is string'),
            'email.unique' => __('email.unique'),
            'password.required' => __('Password required'),
            'password.min' => __('Password min'),
        ];
    }
}
