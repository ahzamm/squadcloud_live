<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreFrontMenuRequest extends CreateFrontMenuRequest
{
    public function rules()
    {
        return [
            'menu' => 'required|string',
            'slug' => 'required|string|regex:/^[a-zA-Z0-9\-]+$/|unique:front_menus,slug' . $this->route('id'),
            'tagline' => 'required|string',
            'page_title' => 'required|string',
            'title_image' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'menu.required' => 'Menu name is required',
            'tagline.required' => 'Tagline is required',
            'slug.required' => 'Route is required',
            'slug.regex' => 'Route can only contain letters, numbers, and hyphens',
            'slug.unique' => 'Route has already been taken',
            'page_title.required' => 'Page Title is required',
            'title_image.required' => 'Title image is required',
            'title_image.mimes' => 'Title image must be a file of type: jpeg, png, jpg',
            'title_image.max' => 'Title image must not be larger than 2MB',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        $firstError = $errors[0] ?? 'Validation error';

        throw new HttpResponseException(redirect()->back()->withInput()->with('error', $firstError));
    }
}
