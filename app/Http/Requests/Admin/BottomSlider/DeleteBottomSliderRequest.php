<?php

namespace App\Http\Requests\Admin\BottomSlider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteBottomSliderRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('bottom_sliders.index', 'delete_status');
        if (!$crudAccess) {
            throw new HttpResponseException(response()->json(['unauthorized' => true]));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }

}
