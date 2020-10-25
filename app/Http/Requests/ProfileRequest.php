<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'tel' => ['required', 'numeric', 'digits_between:8,11'],
            'age' => ['required', 'numeric', 'min:20', 'max:80'],
            'sex' => ['required', Rule::in([1, 2])],
            'introduction' => ['required', 'max:255'],
        ];
    }

    public function attributes()
    {
        return [
            'tel' => '電話番号',
            'age' => '年齢',
            'sex' => '性別',
            'introduction' => '自己紹介',
        ];
    }
}
