<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassRequest extends FormRequest
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
            'oldpass' => 'required|min:6|max:20',
            'newpass' => 'required|min:6|max:20',
            'confirmpass' => 'required|min:6|max:20',
        ];
    }

    public function messages()
    {
        return [
            'oldpass.required' => __('oldpass required'),
            'newpass.required' => __('newpass required'),
            'confirmpass.required' => __('confirmpass required'),
            'oldpass.min' => __('pass min'),
            'newpass.min' => __('pass min'),
            'confirmpass.min' => __('pass min'),
            'oldpass.max' => __('pass max'),
            'newpass.max' => __('pass max'),
            'confirmpass.max' => __('pass max'),
        ];
    }
}
