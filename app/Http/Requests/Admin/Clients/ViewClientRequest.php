<?php

namespace App\Http\Requests\Admin\Clients;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ViewClientRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('clients.index', 'view_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to View Clients'));
        }
        return true;
    }
    public function rules()
    {
        return [];
    }
}
