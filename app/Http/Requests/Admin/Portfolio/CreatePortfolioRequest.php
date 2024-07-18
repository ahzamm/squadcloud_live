<?php

namespace App\Http\Requests\Admin\Portfolio;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePortfolioRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('portfolios.index', 'create_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to Add Portfolio'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
