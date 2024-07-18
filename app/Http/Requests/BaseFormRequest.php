<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserMenuAccess;
use App\Models\SubMenu;
use Auth;

class BaseFormRequest extends FormRequest
{
    public function rules()
    {
        return [];
    }

    public function checkCrudAccess($routeName, $userOperation)
    {
        $subMenuid = SubMenu::where('route_name', $routeName)->first();
        $userId = Auth::user()->id;
        return $this->crud_access($subMenuid->id, $userOperation, $userId);
    }

    public function crud_access($submenuId = null, $operation = null, $uId = null)
    {
        if (!$submenuId == null) {
            $CheckData = UserMenuAccess::where(['user_id' => $uId, 'sub_menu_Id' => $submenuId, $operation => 1, 'view_status' => 1])->count();

            if ($CheckData > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
}
