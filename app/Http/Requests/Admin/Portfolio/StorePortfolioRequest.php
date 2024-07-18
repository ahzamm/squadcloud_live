<?php

namespace App\Http\Requests\Admin\Portfolio;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePortfolioRequest extends CreatePortfolioRequest
{
    public function rules()
    {
        $rules = [
            'title' => 'required|string',
            'link' => 'required|string',
            'route' => 'required|regex:/^[a-zA-Z0-9\-]+$/|unique:portfolios,route',
            'rating' => 'required|string',
            'rating_number' => 'required|string',
            'price' => 'required|string',
            'price_description' => 'required|string',
            'description' => 'required|string',
            'features' => 'required|string',
            'image' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'background_image' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ];

        if ($this->has('images')) {
            foreach ($this->file('images') as $key => $image) {
                $rules["images.{$key}"] = 'file|mimes:jpeg,png,jpg|max:2048';
            }
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'title.required' => 'Title name is required',
            'link.required' => 'Link is required',
            'route.required' => 'Route is required',
            'route.regex' => 'Route can only contain letters, numbers, and hyphens',
            'route.unique' => 'Route has already been taken',
            'description.required' => 'Description is required',
            'features.required' => 'Features is required',
            'rating.required' => 'Rating is required',
            'rating_number.required' => 'Rating Number is required',
            'price.required' => 'Price is required',
            'price_description.required' => 'Price Description is required',
            'image.required' => 'Image is required',
            'image.mimes' => 'Image must be a file of type: jpeg, png, jpg',
            'image.max' => 'Image must not be larger than 2MB',
            'background_image.required' => 'Background image is required',
            'background_image.mimes' => 'Background image must be a file of type: jpeg, png, jpg',
            'background_image.max' => 'Background image must not be larger than 2MB',
        ];

        if ($this->has('images')) {
            foreach ($this->file('images') as $key => $image) {
                $messages["images.{$key}.file"] = "Image {$key} must be a valid file.";
                $messages["images.{$key}.mimes"] = "Image {$key} must be a file of type: jpeg, png, jpg.";
                $messages["images.{$key}.max"] = "Image {$key} must not be larger than 2MB.";
            }
        }

        return $messages;
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        $firstError = $errors[0] ?? 'Validation error';

        throw new HttpResponseException(redirect()->back()->withInput()->with('error', $firstError));
    }
}
