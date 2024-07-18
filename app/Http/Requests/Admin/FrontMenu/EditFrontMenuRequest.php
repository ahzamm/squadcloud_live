<?php

namespace App\Http\Requests\Admin\FrontMenu;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditFrontMenuRequest extends BaseFormRequest
{
    public function authorize()
    {
        $crudAccess = $this->checkCrudAccess('frontmenu.index', 'update_status');
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to edit a Front Menu'));
        }
        return true;
    }

    public function rules()
    {
        return [];
    }
}
