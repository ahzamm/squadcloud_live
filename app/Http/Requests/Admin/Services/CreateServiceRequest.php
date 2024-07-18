<?php

namespace App\Http\Requests\Admin\Services;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateServiceRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('services.index', 'create_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to Create Service'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
