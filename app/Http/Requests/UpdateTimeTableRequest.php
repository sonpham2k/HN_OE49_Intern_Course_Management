<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimeTableRequest extends FormRequest
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
            'day' => 'bail|integer|min:2|max:7',
            'lesson' => 'bail|integer|min:1|max:6',
        ];
    }

    public function messages()
    {
        return [
            'day.integer' =>  __('day.integer'),
            'day.min' => __('day.min'),
            'day.max' => __('day.max'),
            'lesson.integer' =>  __('lesson.integer'),
            'lesson.min' => __('lesson.min'),
            'lesson.max' => __('lesson.max'),
        ];
    }
}
