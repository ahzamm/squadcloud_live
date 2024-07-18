<?php

namespace App\Http\Requests\Admin\Services;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditServiceRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('services.index', 'update_status');
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
