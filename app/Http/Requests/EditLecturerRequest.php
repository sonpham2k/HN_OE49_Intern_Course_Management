<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EditLecturerRequest extends FormRequest
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
            'username' => 'required|min:6',
            'fullname' => 'required|string|min:6|max:255',
            'date' => 'date',
            'address' => 'required|min:6|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->lecturer)],
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => __('name.required'),
            'username.required' => __('username.required'),
            'username.min' => __('username.min'),
            'date.date' => __('date.date'),
            'address.required' => __('address.required'),
            'fullname.string' => __('name.string'),
            'fullname.min' => __('name.min'),
            'fullname.max' => __('name.max'),
            'address.min' => __('address.min'),
            'address.max' => __('address.max'),
            'email.email' => __('email is string'),
            'email.unique' => __('email.unique'),
        ];
    }
}
