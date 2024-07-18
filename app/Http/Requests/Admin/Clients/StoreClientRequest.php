<?php

namespace App\Http\Requests\Admin\Clients;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreClientRequest extends CreateClientRequest
{
    public function rules()
    {
        return [
            'link' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'logo' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'link.required' => 'Link is required',
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'logo.required' => 'Logo is required',
            'logo.mimes' => 'Logo must be a file of type: jpeg, png, jpg',
            'logo.max' => 'Logo must not be larger than 2MB',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        $firstError = $errors[0] ?? 'Validation error';
        throw new HttpResponseException(redirect()->back()->withInput()->with('error', $firstError));
    }
}
