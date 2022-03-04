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
            'email' => 'required|min:6|max:255|email',
            'password' => 'required|min:6|max:255',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => __('Password required'),
            'email.required' => __('email required'),
            'email.email' => __('email is string'),
            'password.min' => __('Password min'),
            'password.max' => __('Password max'),
            'email.min' => __('email min'),
            'email.max' => __('email max'),
        ];
    }
}
