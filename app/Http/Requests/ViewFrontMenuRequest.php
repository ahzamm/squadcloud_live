<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class ViewFrontMenuRequest extends FormRequest
{
    public function authorize()
    {
        $subMenuid = SubMenu::where('route_name', 'frontmenu.index')->first();
        $userOperation = 'view_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to View Site Menu'));
        }
        return true;
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

    public function rules()
    {
        return [];
    }
}
