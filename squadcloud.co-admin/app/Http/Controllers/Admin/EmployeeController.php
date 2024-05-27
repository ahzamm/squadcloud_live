<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\UserMenuAccess;
use DB;
use App\Models\SubMenu;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Admin::where('role','employee')->get();
        return view('admin.employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        DB::transaction(function () use ($request){
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'active' => $request->active != null ? true : false,
                'role' => 'employee'
            ]);
        },3);
        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Admin::find($id);
        return view('admin.employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'password' => ['nullable', 'string', 'min:8'],
        ]);
        if($request->password != null)
        {
            Admin::find($id)->update([
                'password' => Hash::make($request->password),
                'active' => $request->active != null?1:0
            ]);
        }
        else
        {
            Admin::find($id)->update([
                'active' => $request->active != null?1:0
            ]);
        }
        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
    public function showAccess($id)
    {
        $userAccesses = UserMenuAccess::where('user_id',$id)->get();
        return view('admin.employee.showAccess',compact('userAccesses'));
    }
    public function updateAccess(Request $request,$id)
    {
        $userAccess = UserMenuAccess::find($id);
        $userAccess->status = $request->access_status;
        $userAccess->save();
        return response()->json(['status' => true]);
    }
}
