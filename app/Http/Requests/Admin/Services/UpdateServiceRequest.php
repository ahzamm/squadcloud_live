<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateServiceRequest extends EditServiceRequest
{
    public function rules()
    {
        return [
            'service' => 'required|string',
            'tagline' => 'required|string',
            'description' => 'required|string',
            'slug' => 'required|regex:/^[a-zA-Z0-9\-]+$/|unique:services,slug,' . $this->route('service'),
            'logo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'background_image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'service.required' => 'Service name is required',
            'tagline.required' => 'Tagline is required',
            'description.required' => 'Description is required',
            'slug.required' => 'Slug is required',
            'slug.regex' => 'Slug can only contain letters, numbers, and hyphens',
            'slug.unique' => 'Slug has already been taken',
            'logo.mimes' => 'Logo must be a file of type: jpeg, png, jpg',
            'logo.max' => 'Logo must not be larger than 2MB',
            'background_image.mimes' => 'Background image must be a file of type: jpeg, png, jpg',
            'background_image.max' => 'Background image must not be larger than 2MB',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        $firstError = $errors[0] ?? 'Validation error';

        throw new HttpResponseException(redirect()->back()->withInput()->with('error', $firstError));
    }
}
