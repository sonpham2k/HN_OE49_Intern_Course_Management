<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassForgotRequest extends FormRequest
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
            'email' => 'required|min:12|max:255',
<<<<<<< Updated upstream
=======
            'code' => 'required',
>>>>>>> Stashed changes
            'newpass' => 'required|min:6|max:20',
            'confirmpass' => 'required|min:6|max:20',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('email required'),
<<<<<<< Updated upstream
=======
            'code.required' => __('code required'),
>>>>>>> Stashed changes
            'newpass.required' => __('newpass required'),
            'confirmpass.required' => __('confirm required'),
            'email.min' => __('email min'),
            'newpass.min' => __('pass min'),
            'confirmpass.min' => __('pass min'),
            'email.max' => __('email max'),
            'newpass.max' => __('pass max'),
            'confirmpass.max' => __('pass max'),
        ];
    }
}
