<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Auth;
use DB;
use Illuminate\Support\Str;
use Image;

class MessageController extends Controller
{
    public function __construct()
    {
        // $this->middleware('checkuseraccess', ['only' => ['index','create']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Str::random(5).''.time().''.Str::random(5));
        $message = Message::all();
        return view('admin.message.index',compact('message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.message.create');
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
           
            'message'=>'required',
            'image' => 'required|image|max:2000',
          
        ]);
        try {
            DB::transaction(function () use ($request){
                $message_store = new Message();
           
                $message_store->message = $request->message;
                $message_store->active = $request->status != null?true:false;
                $message_store->save();

                //upload Image
                if($request->hasFile('image'))
                {
                    $image = $request->file('image');
                    $extension = $request->file('image')->extension();
                    $fileName = Str::random(10).'_'.time().'.'.$extension; //File Name for save file in folder

                    $img = Image::make($image->path());
                    $img->resize(1800, 1200, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('/message').'/'.$fileName);
                    $message_store->image = $fileName;
                    $message_store->save();
                }
            },2);
            return redirect()->route('message.index');

        } catch (\Throwable $th) {
            
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
        $message_data = Message::find($id);
        return view('admin.message.show-modal',compact('message_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message_edit = Message::find($id);
        return view('admin.message.edit',compact('message_edit'));
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
           
            'message'=>'required',
            'image' => 'image|max:4000',
   
        ]);
        // try {
            DB::transaction(function () use ($request,$id){
                $message_update = Message::find($id);
                
                $message_update->message = $request->message;
                $message_update->active = $request->status != null?true:false;
                $message_update->save();
                //upload Image
                if(!empty($request->hasFile('image')))
                {
                    if($message_update->image != null)
                    {
                        if(file_exists(public_path('/message/'.$message_update->image))){

                             unlink(public_path('/message/'.$message_update->image));
                        }   
                    }
                    $files = $request->file('image');
                    $destinationPath = public_path('/message/');
                     // Upload Orginal Image           
                    $profileImage = date('d-M-Y').$files->getClientOriginalExtension();
                   $files->move($destinationPath, $profileImage);
                   $message_update->image = $profileImage;
                  $message_update->save();
                }
                
            },2);
                
        
            return redirect()->route('message.index');

        // } catch (\Throwable $th) {
            
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
   
        $delete_message = Message::find($request->message)->delete();
        return "Message has been Deleted Successfully";

    }
    
}
