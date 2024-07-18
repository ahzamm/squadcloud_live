<?php

namespace App\Http\Requests\Admin\BottomSlider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateBottomSliderRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('bottom_sliders.index', 'create_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to Add Bottom Slider'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
