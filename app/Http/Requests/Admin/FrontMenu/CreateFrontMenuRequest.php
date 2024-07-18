<?php

namespace App\Http\Requests\Admin\FrontMenu;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateFrontMenuRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('frontmenu.index', 'create_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to Create Site Menu'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
