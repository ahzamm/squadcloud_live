<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Admin;
use App\Models\Backend\Blog;
use App\Models\Backend\Client;
use App\Models\Backend\InnerService;
use App\Models\Backend\Portfolio;
use App\Models\Backend\Product;
use App\Models\Backend\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }
        else{
            return View('admin.login');
        }
    }

    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        //$result = Admin::where(['email'=>$email, 'password'=>$password])->get();
        $result=Admin::where(['email'=>$email])->first();
        if($result){
            if(Hash::check($request->post('password'), $result->password)){
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN_ID', $result->id);
                return redirect('admin/dashboard');
            }
            // else{
            //     $request->session()->flash('error', 'Password is invalid');
            //     return redirect('admin');
            // }
        }
        else{
            $request->session()->flash('error', 'Email or Password is invalid');
            return redirect('admin');
        }
    }

    // public function encryptpassword(){
    //     $x = Admin::find(1);
    //     $x->password=Hash::make('123');
    //     $x->save();
    // }

    public function dashboard(){
        $result['blog']=Blog::count();
        $result['client']=Client::where('status',1)->count();
        // $result['innerService']=InnerService::count();
        // $result['portfolio']=Portfolio::count();
        $result['product']=Product::where('status',1)->count();
        $result['services']=Services::count();
        return view('admin.dashboard', $result);
    }
}