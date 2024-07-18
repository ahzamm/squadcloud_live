<?php

namespace App\Http\Requests\Admin\HomeSliders;

class StoreHomeSliderImagesRequest extends CreateHomeSliderRequest
{
    public function rules()
    {
        return [
            'heading' => 'required|string',
            'subheading' => 'required|string',
            'description' => 'required|string',
            'image_1' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'image_2' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'image_3' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'image_4' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'heading.required' => 'Service name is required',
            'subheading.required' => 'Tagline is required',
            'description.required' => 'Description is required',
            'image_1.required' => 'Tagline is required',
            'image_2.required' => 'Description is required',
            'image_3.required' => 'Slug is required',
            'image_4.required' => 'Slug is required',
            'image_1.mimes' => 'Image 1 must be a file of type: jpeg, png, jpg',
            'image_1.max' => 'Image 1 must not be larger than 2MB',
            'image_2.mimes' => 'Image 2 must be a file of type: jpeg, png, jpg',
            'image_2.max' => 'Image 2 must not be larger than 2MB',
            'image_3.mimes' => 'Image 3 must be a file of type: jpeg, png, jpg',
            'image_3.max' => 'Image 3 must not be larger than 2MB',
            'image_4.mimes' => 'Image 4 must be a file of type: jpeg, png, jpg',
            'image_4.max' => 'Image 4 must not be larger than 2MB',
        ];
    }
}
