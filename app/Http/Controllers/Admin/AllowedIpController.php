<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AllowedIp;
use Validator;
class AllowedIpController extends Controller
{
    public function __construct()
    {
        // $this->middleware('checkuseraccess', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ips = AllowedIp::all();
        return view('admin.allowedip.index',compact('ips'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.allowedip.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'person_name' => 'required',
            'ip_address'=>'required|ip',
        ]);
        if ($validator->passes()) {
            $ipAllowed =  new AllowedIp;
            $ipAllowed->person_name = $request->person_name;
            $ipAllowed->ip_address = $request->ip_address;
            $ipAllowed->save();
            return response()->json(['status'=>true]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
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
        $ip = AllowedIp::find($id);
        return view('admin.allowedip.edit',compact('ip'));
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
        $validator = Validator::make($request->all(), [
            'person_name' => 'required',
            'ip_address'=>'required|ip',
        ]);
        if ($validator->passes()) {
            $ipAllowed =  AllowedIp::find($request->id);
            $ipAllowed->person_name = $request->person_name;
            $ipAllowed->ip_address = $request->ip_address;
            $ipAllowed->save();
            return response()->json(['status'=>true]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ipAllowed =  AllowedIp::find($id);
        $ipAllowed->delete();
        return response()->json(['status'=>true]);
    }
}