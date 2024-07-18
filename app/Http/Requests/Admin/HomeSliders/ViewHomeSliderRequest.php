<?php

namespace App\Http\Requests\Admin\HomeSliders;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ViewHomeSliderRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('homesliders.index', 'view_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to View Home Sliders'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
