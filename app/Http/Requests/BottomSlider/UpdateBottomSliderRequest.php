<?php

namespace App\Http\Requests\BottomSlider;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateBottomSliderRequest extends EditBottomSliderRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'image.mimes' => 'Image must be a file of type: jpeg, png, jpg',
            'image.max' => 'Image must not be larger than 2MB',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        $firstError = $errors[0] ?? 'Validation error';

        throw new HttpResponseException(redirect()->back()->withInput()->with('error', $firstError));
    }
}
