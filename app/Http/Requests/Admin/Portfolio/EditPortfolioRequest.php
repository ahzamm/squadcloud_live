<?php

namespace App\Http\Requests\Admin\Portfolio;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditPortfolioRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('portfolios.index', 'update_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to edit a Portfolio'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
