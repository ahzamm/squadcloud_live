<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateFrontMenuRequest extends EditFrontMenuRequest
{
    public function rules()
    {
        return [
            'menu' => 'required|string',
            'tagline' => 'required|string',
            'page_title' => 'required|string',
            'slug' => 'required|regex:/^[a-zA-Z0-9\-]+$/|unique:front_menus,slug,' . $this->route('frontmenu'),
            'title_image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'menu.required' => 'Front Menu name is required',
            'tagline.required' => 'Tagline is required',
            'page_title.required' => 'Description is required',
            'slug.required' => 'Route is required',
            'slug.regex' => 'Route can only contain letters, numbers, and hyphens',
            'slug.unique' => 'Route has already been taken',
            'title_image.mimes' => 'Title Image must be a file of type: jpeg, png, jpg',
            'title_image.max' => 'Title Image must not be larger than 2MB',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        $firstError = $errors[0] ?? 'Validation error';

        throw new HttpResponseException(redirect()->back()->withInput()->with('error', $firstError));
    }
}
