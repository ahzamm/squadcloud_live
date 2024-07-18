<?php

namespace App\Http\Requests\Admin\Clients;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditClientRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('clients.index', 'update_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to Edit Clients'));
        }
        return true;
    }
    public function rules()
    {
        return [];
    }
}
