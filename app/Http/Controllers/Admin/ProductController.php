<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Auth ;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("df");
        $products = Product::all();
        // dd($Products);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'products.create')->first();
        // dd($subMenuid);
        $userOperation =  "create_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        // dd($request->all());
        $validatedData = [
            "name"=>"required",
            "short_description"=>"required",
            "link"=>"required",
            "rating"=>"required",
            "rating_number"=>"required",
            "question"=>"required",
            "answer"=>"required",
            "price"=>"required",
            "price_description"=>"required",
        ];

        $valdiate = Validator::make($request->all(), $validatedData);
        
        if ($valdiate->fails()) {
            return redirect()->back()->with('error' , 'All Fields are required');
        } else {


            $imageFiles = ['image', 'screenshot_1', 'screenshot_2', 'screenshot_3', 'background_image'];
            $fileNames = [];

            foreach($imageFiles as $imageFile) {
                if ($request->hasFile($imageFile)) {
                    $file = $request->file($imageFile);
                    $extension = $file->getClientOriginalExtension();
                    $filename = Str::random(40) . '.' . $extension;
                    // dd($filename);
                    $file->move(public_path('frontend_assets/images/products'), $filename);
                    $fileNames[$imageFile] = $filename;
                } else {
                    $fileNames[$imageFile] = null;
                }
            }
            // dd($request->name);

            Product::create([
                'name' => $request['name'],
                'short_description' => $request['short_description'],
                'image' => $fileNames['image'],
                'link' => $request['link'],
                'rating' => $request['rating'],
                'rating_number' => $request['rating_number'],
                'question' => $request['question'],
                'answer' => $request['answer'],
                'price' => $request['price'],
                'price_description' => $request['price_description'],
                'screenshot_1' => $fileNames['screenshot_1'],
                'screenshot_2' => $fileNames['screenshot_2'],
                'screenshot_3' => $fileNames['screenshot_3'],
                'background_image' => $fileNames['background_image'],
                'is_active' => $request->has('status') ? 1 : 0
            ]);

            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } 
    }
    else {
        return redirect()->back()->with('error', 'Unauthorized access');
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
         $packageData = Product::find($id);
         return view('admin.Products.show-modal',compact('packageData'));
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $product = Product::findOrFail($id);
        // dd($product);
        return view('admin.products.edit',compact('product'));
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
        // dd("===");
        $subMenuid     =  SubMenu::where('route_name' , 'Products.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $request->validate([
            "name"=>"required",
            "short_description"=>"required",
            "link"=>"required",
            "rating"=>"required",
            "rating_number"=>"required",
            "question"=>"required",
            "answer"=>"required",
            "price"=>"required",
            "price_description"=>"required",
        ]);
        
        // dd("===");
        $product = Product::findOrFail($id);
        

        // dd($request->hasFile('image'));
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path('frontend_assets/images/products/' . $product->image))) {
                unlink(public_path('frontend_assets/images/products/' . $product->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/products'), $filename);
            $product->image = $filename;
        }
        
        if ($request->hasFile('screenshot_1')) {
            if ($product->image && file_exists(public_path('frontend_assets/images/products/' . $product->screenshot_1))) {
                unlink(public_path('frontend_assets/images/products/' . $product->screenshot_1));
            }
            $file = $request->file('screenshot_1');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/products'), $filename);
            $product->screenshot_1 = $filename;
        }
        
        if ($request->hasFile('screenshot_2')) {
            if ($product->image && file_exists(public_path('frontend_assets/images/products/' . $product->screenshot_2))) {
                unlink(public_path('frontend_assets/images/products/' . $product->screenshot_2));
            }
            $file = $request->file('screenshot_2');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/products'), $filename);
            $product->screenshot_2 = $filename;
        }
        
        if ($request->hasFile('screenshot_3')) {
            if ($product->image && file_exists(public_path('frontend_assets/images/products/' . $product->screenshot_3))) {
                unlink(public_path('frontend_assets/images/products/' . $product->screenshot_3));
            }
            $file = $request->file('screenshot_3');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/products'), $filename);
            $product->screenshot_3 = $filename;
        }
        
        if ($request->hasFile('background_image')) {
            if ($product->image && file_exists(public_path('frontend_assets/images/products/' . $product->background_image))) {
                unlink(public_path('frontend_assets/images/products/' . $product->background_image));
            }
            $file = $request->file('background_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/products'), $filename);
            $product->background_image = $filename;
        }
        

        $product->name = $request['name'];
        $product->short_description = $request['short_description'];
        $product->link = $request['link'];
        $product->rating = $request['rating'];
        $product->rating_number = $request['rating_number'];
        $product->question = $request['question'];
        $product->answer = $request['answer'];
        $product->price = $request['price'];
        $product->price_description = $request['price_description'];
        $product->is_active = $request->has('is_active') ? 1 : 0;

        $product->save();

       
         return redirect()->route('products.index')->with('success', 'Product updated successfully!');

        }
    
    else{
        return redirect()->back()->with('error' , 'No Access To Update Products');
    }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {  $subMenuid     =  SubMenu::where('route_name' , 'Products.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $delete =  Product::find($id)->delete();
        if($delete == true)
        {
            return response()->json(["status" => true ]);
        }}
        else{
            return response()->json(["unauthorized" => true ]);

        }
    }
    public function crud_access($submenuId = null , $operation = null , $uId = null) {
        if (!$submenuId == null) { 
        $CheckData = UserMenuAccess::where(["user_id" => $uId , "sub_menu_Id" => $submenuId , $operation => 1 , 'view_status' => 1])->count();
   
        if($CheckData > 0 ){
            return true;
        }
        else
        {
            return false;
        }
        }
    }
}
