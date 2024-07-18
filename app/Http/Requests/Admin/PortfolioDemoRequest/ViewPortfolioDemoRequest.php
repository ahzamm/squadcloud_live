<?php

namespace App\Http\Requests\Admin\PortfolioDemoRequest;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ViewPortfolioDemoRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('portfolio_demo_requests.index', 'view_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to View Portfolio Demo Requests'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
