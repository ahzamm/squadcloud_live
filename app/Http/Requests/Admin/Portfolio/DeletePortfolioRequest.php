<?php

namespace App\Http\Requests\Admin\Portfolio;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeletePortfolioRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('portfolios.index', 'delete_status');
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
