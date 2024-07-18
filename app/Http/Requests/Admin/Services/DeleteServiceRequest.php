<?php

namespace App\Http\Requests\Admin\Services;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteServiceRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('services.index', 'delete_status');
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
