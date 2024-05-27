<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Backend\Checkout;
use App\Models\Backend\Product;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{

    public function create(request $request, $id)
    {

        $price = Product::find($id);
        return view('frontend/checkout', compact('price'));
      
    }

    public function admin_index()
    {
        $checkoutdata = Checkout::all();
        return view('admin/checkout',compact('checkoutdata'));
    }

    public function store(request $request)
    {

        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'postal_code' => 'required',
            'company' => 'required',
            
        ]);
            
        $checkout = new Checkout();
        $checkout->first_name = $request['first_name'];
        $checkout->last_name = $request['last_name'];
        $checkout->email = $request['email'];
        $checkout->phone = $request['phone'];
        $checkout->country = $request['country'];
        $checkout->state = $request['state'];
        $checkout->address_line_1 = $request['address_line_1'];
        $checkout->address_line_2 = $request['address_line_2'];
        $checkout->company = $request['company'];
        $checkout->postal_code = $request['postal_code'];
        $checkout->total_amount = $request['total_amount'];
        $checkout->status = $request['status'];
        
        $checkout->save();
        return redirect()->back();

    }

    public function checkout_delete($id){

        $checkout = Checkout::find($id);
        $checkout->delete();
        return redirect()->back();

    }

    public function status(Request $request, $status, $id)
    {
        $checkout=Checkout::find($id);
        $checkout->status=$status;
        $checkout->save();
        $request->session()->flash('message', 'checkout Status Updated');
        return redirect('admin/checkout');

    }

    public function show($id){

        $checkout=Checkout::find($id);
        return view('admin/checkoutview', compact('checkout'));

    }


}
