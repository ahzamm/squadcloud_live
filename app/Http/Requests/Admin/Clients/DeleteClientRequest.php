<?php

namespace App\Http\Requests\Admin\Clients;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteClientRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('clients.index', 'delete_status');
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
