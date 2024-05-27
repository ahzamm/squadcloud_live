<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect()->intended(route('admin.dashboard'));
        }
        else{
            return redirect()->back()->withInput($request->only('email','remember'))->withMessage("Invalid User name or Passowrd");
        }
    }
    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('admin.login');
        
    }
    // public function verify()
    // {
    //     return view('admin.auth.verify');
    // }
    // public function verifyPost(Request $request)
    // {
    //     $code = session()->get('verification_code');
    //     $data = session()->get('verification_data');
    //     // Attempt to log the user in
    //     if($code != null && $code == $request->code)
    //     {
    //         $request->session()->forget(['verification_code', 'verification_data']);
    //         Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'],'active'=>1]);
    //         return redirect()->intended(route('admin.dashboard'));
    //     }
    //     else
    //     {
    //         return redirect()->route('admin.verify')->withMessage("Verification code is invalid");
    //     }
    // }
    // private function sendMail($to,$code)
    // {
    //     $subject = 'Logon Home Admin Panel Login Request | Date: '.date("F j, Y, g:i a");
    //     // Always set content-type when sending HTML email
    //     $headers = "MIME-Version: 1.0" . "\r\n";
    //     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    //     $headers .= "From: info@logon.com.pk";
    //     $message = view('email.verify',['code'=>$code])->render();
    //     mail($to,$subject,$message,$headers);
    // }
    public function changePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required|confirmed|min:6',
        ]);
        if ($validator->passes()) {
            if(Hash::check($request->oldpassword, Auth::user()->password))
            {
                Auth::user()->update([
                    'password' => Hash::make($request->newpassword)
                ]);
                return response()->json(['status'=>true]);
            }
            else
            {
                $validator->getMessageBag()->add('password', 'Old Password doesn\'t matched');
                return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
            }
        }
        else
        {
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
    }
}
