<?php

namespace App\Http\Requests\Admin\Portfolio;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ViewPortfolioRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('portfolios.index', 'view_status');
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
