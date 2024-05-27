<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\SubMenu;


class HomeVideoController extends Controller
{
   public function index()
   {
      $videos = HomeVideo::orderby('id', 'asc')->get();
      return view('admin.homevideo.index', compact('videos'));
   }
   public function create()
   {
      $data['Title'] = 'Add Home (Video)';
      $data['Back'] = route('video.index');
      $data['SaveButoon'] = 'Save';
      $data['url'] = route('homevideo.store');

      return view('admin.homevideo.create_edit', $data);
   }

   public function store(Request $request)
   {
      $validationRules = [
         'video' => 'required|mimetypes:video/mp4',
      ];

      $validator = Validator::make($request->all(), $validationRules);

      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator->errors());
      } else {
         // Check if the file was successfully uploaded
         if ($request->hasFile('video') && $request->file('video')->isValid()) {
            // Store the video in the HomeVideo folder
            $videoPath = $request->file('video');
            $videoPath->move("HomeVideo/", $videoPath->getClientOriginalName());

            $status = $request['active'] ? 1 : 0;
            // Save the video path to the database
            HomeVideo::create([
               'video' => $videoPath->getClientOriginalName(),
               'active' => $status,
               // other fields if any
            ]);

            // Redirect back with success message
            Session::flash('success', 'Video uploaded successfully.');
            return redirect('admin/videoheader');
         } else {
            // Redirect back with error message if the file upload failed
            return redirect()->back()->with('error', 'Invalid video file.');
         }
      }
   }

   public function edit($id) 
   {
      $data['Title'] = 'Update Home (Video)';
      $data['Back'] = route('video.index');
      $data['SaveButoon'] = 'Update';
      $data['url'] = route('homevideo.update');
      $data['data'] = HomeVideo::findOrFail($id);

      return view('admin.homevideo.create_edit', $data);
   }

   public function update(Request $request)
   {
         // Find the HomeVideo record by its ID
         $homeVideo = HomeVideo::findOrFail($request->id);

         if ($request->hasFile('video') && $request->file('video')->isValid()) {
            $videoFile = $request->file('video');
            $videoFileName = $videoFile->getClientOriginalName();

            $videoPath = $videoFile->storeAs('HomeVideo', $videoFileName);

            $homeVideo->video = $videoFileName;
         }

            $homeVideo->active = $request['active'] ? 1 : 0;

         $homeVideo->save();

         return redirect('admin/videoheader')->with('success', 'Video updated successfully.');
      
   }
/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id) {
      // dd('s');
      $subMenuid     =  SubMenu::where('route_name' , 'video.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::user()->id;   
        $crudAccess   = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if ($crudAccess) {
        $deleteVideo  = HomeVideo::where('id' , $id)->delete();
        return response()->json(["status" => true]); }else{
            return response()->json(["unauthorized" => true]);
        }
   }
}
