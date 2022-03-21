<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
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
            'title' => 'required | max:100',
            'content' => 'required | max:100',
            'person_in_charge' => 'required | max:100'
        ];
    }

    /**
     * Get attributes.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'content' => '内容',
            'person_in_charge' => '担当者'
        ];
    }

    /**
     * Get attributes.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => '必須項目です。',
            'max' => '最大文字数を超えています。',
        ];
    }
}
