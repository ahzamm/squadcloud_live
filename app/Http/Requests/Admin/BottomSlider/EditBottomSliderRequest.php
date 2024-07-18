<?php

namespace App\Http\Requests\Admin\BottomSlider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditBottomSliderRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('bottom_sliders.index', 'update_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to edit a service'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
