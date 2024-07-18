<?php

namespace App\Http\Requests\Admin\Clients;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateClientRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('clients.index', 'create_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to Add Clients'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
