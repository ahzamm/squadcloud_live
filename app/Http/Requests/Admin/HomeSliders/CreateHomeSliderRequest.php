<?php

namespace App\Http\Requests\Admin\HomeSliders;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateHomeSliderRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('homesliders.index', 'create_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to Add HomeSlider'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
