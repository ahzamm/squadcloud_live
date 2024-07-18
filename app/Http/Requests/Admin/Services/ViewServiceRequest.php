<?php

namespace App\Http\Requests\Admin\Services;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ViewServiceRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('services.index', 'view_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to View Service'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
