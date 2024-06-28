<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralConfiguration;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Services\EmailService;
use App\Models\FrontEmail;
use Carbon\Carbon;

class AuthController extends Controller
{
    protected $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('admin')->user();
            if ($user->active == 1) {
                $general_configuration = GeneralConfiguration::first();
                if ($general_configuration->otp_status == 0) {
                    return redirect()->intended(route('admin.dashboard'));
                }

                $token = random_int(1000, 9999);
                $otpCreationTime = now();
                $request->session()->forget('login_token');
                $request->session()->put('login_token', $token);
                $request->session()->put('otp_creation_time', $otpCreationTime);
                $request->session()->put('login_credentials', ['email' => $request->email, 'password' => $request->password]);
                $email_settings = FrontEmail::where('status', 1)->first();

                $this->emailService->sendEmail('Squad Cloud OTP', 'EmailTemplates.otpEmailTemplate', ['otp' => $token], $email_settings->emails, $request->email);
                Auth::guard('admin')->logout();

                return redirect()->route('admin.verifyOTP');
            }
            Auth::guard('admin')->logout();
            return redirect()->back()->withInput($request->only('email', 'remember'))->withMessage('User account is not active.');
        }
        return redirect()->back()->withInput($request->only('email', 'remember'))->withMessage('Invalid username or password.');
    }

    public function showVerifyOTPForm(Request $request)
    {
        return view('admin.auth.verifyOTPForm');
    }

    public function verifyOTP(Request $request)
    {
        $validatedData = [
            'token' => 'required',
        ];
        $validate = Validator::make($request->all(), $validatedData);
        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Provide an OTP.');
        }

        $otpCreationTime = $request->session()->get('otp_creation_time');
        $currentTime = now();
        $otpExpiryTime = Carbon::parse($otpCreationTime)->addMinutes(1);
        if ($currentTime->greaterThan($otpExpiryTime)) {
            return redirect()->back()->withInput()->withMessage('OTP has expired.');
        }

        if ($request->token == $request->session()->get('login_token')) {
            $credentials = $request->session()->get('login_credentials');
            if ($credentials) {
                Auth::guard('admin')->attempt($credentials);
                return redirect()->intended(route('admin.dashboard'));
            }
        }
        return redirect()->back()->withInput()->withMessage('Invalid OTP.');
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required|confirmed|min:6',
        ]);
        if ($validator->passes()) {
            if (Hash::check($request->oldpassword, Auth::user()->password)) {
                Auth::user()->update([
                    'password' => Hash::make($request->newpassword),
                ]);
                return response()->json(['status' => true]);
            } else {
                $validator->getMessageBag()->add('password', 'Old Password doesn\'t matched');
                return response()->json(['status' => false, 'error' => $validator->errors()->all()]);
            }
        } else {
            return response()->json(['status' => false, 'error' => $validator->errors()->all()]);
        }
    }
}
