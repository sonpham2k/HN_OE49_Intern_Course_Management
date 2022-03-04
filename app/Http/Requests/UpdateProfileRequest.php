<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|min:6|max:255|string',
            'date' => 'required|min:6|max:255',
            'address' => 'required|min:6|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('name.required'),
            'date.required' => __('date.required'),
            'address.required' => __('address.required'),
            'name.string' => __('name.string'),
            'name.min' => __('name.min'),
            'name.max' => __('name.max'),
            'date.min' => __('date.min'),
            'date.max' => __('date.max'),
            'address.min' => __('address.min'),
            'address.max' => __('address.max'),
        ];
    }
}
