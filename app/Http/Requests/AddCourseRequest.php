<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCourseRequest extends FormRequest
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
            'name' => 'bail|required|string',
            'credits' => 'integer',
            'numbers' => 'integer',
            'user' => 'integer',
            'semester' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>  __('course_name.required'),
            'name.string' =>  __('course_name.string'),
            'credits.integer' =>  __('credits.integer'),
            'numbers.integer' =>  __('numbers.integer'),
            'user.integer' =>  __('user.integer'),
            'semester.integer' =>  __('semester.integer'),
        ];
    }
}
