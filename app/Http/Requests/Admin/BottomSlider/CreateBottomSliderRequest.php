<?php

namespace App\Http\Requests\Admin\BottomSlider;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SubMenu;
use Auth;
use App\Models\UserMenuAccess;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateBottomSliderRequest extends FormRequest
{
    public function authorize()
    {
        $subMenuid = SubMenu::where('route_name', 'bottom_sliders.index')->first();
        $userOperation = 'create_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            throw new HttpResponseException(redirect()->back()->withInput()->with('error', 'No right to Add Bottom Slider'));
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
