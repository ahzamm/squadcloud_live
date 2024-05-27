<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\provience;
use App\Models\CoreArea;
use App\Models\ZoneArea;
use Validator;
use App\Models\CoverageRequest;
use Mail;
use App\Models\FrontEmail;
use App\Models\email_coverage;
class ConsumerController extends Controller
{
    // public function index()
    // {
    //     $cities = City::where('active',1)->get();
    //     return view('site.pages.coverage',compact('cities'));
    // }
    // public function getProvience($id)
    // {
    //     $provience = provience::where('active',1)->where('province',$id)->get();
    //     return response()->json(['provience'=> $cities]);
    // }
    //
    public function getCities($id)
    {
        $cities = City::orderBY('name','asc')->where('province_id',$id)->get();
        // dd($cities);
        return response()->json(['cities'=> $cities]);
    }
    public function getcoreAreas($cityId)
    {
        $coreareas = CoreArea::where('active',1)->where('city_id',$cityId)->get();
        return response()->json(['coreareas'=> $coreareas]);
    }
    public function getZoneAreas($id)
    {
        $zoneareas = ZoneArea::where('active',1)->where('core_area_id',$id)->get();
        return response()->json(['zoneareas'=> $zoneareas]);
    }
    public function becomePartner(Request $request)
    {
            $fullName  = $request->name ;
            $request_type  = 'partner' ;
            $email     = $request->email ;
            $address = $request->address;
            $nearest_landmark = $request->landmark;
            $mobile_no = $request->mobile_no;
            $no_of_users = $request->no_of_users;
            $province_id = $request->province_id;
            $city_id = $request->city_id;
            $core_area_id = $request->core_area_id;
            $zone_area_id = $request->zone_area_id;

            $coverageRequest = new CoverageRequest;
            $coverageRequest->name = $request->name;
            $coverageRequest->address = $request->address;
            $coverageRequest->nearest_landmark = $request->landmark;
            $coverageRequest->email = $request->email;
            $coverageRequest->mobile_no = $request->mobile_no;
            $coverageRequest->no_of_users = $request->no_of_users;
            $coverageRequest->request_type = 'partner';
            $coverageRequest->province_id = $request->province_id;
            $coverageRequest->city_id = $request->city_id;
            $coverageRequest->core_area_id = $request->core_area_id;
            $coverageRequest->zone_area_id = $request->zone_area_id;

            $coverageRequest->save();
            
            $email_settings = FrontEmail::where('status',1)->First();
            $adminEmails = email_coverage::pluck('adminemail')->toArray();
    
            // Send customer email
            email_coverage::sendEmail(
                'Blinkbroadband Contact Request',
                'email.thanks', // Blade view for customer email
                ['fullName' => $fullName,'request_type' => $request_type],
                $email_settings->emails, // Assuming $email_settings is available globally
                $email
            );
    
            // Send admin email
            foreach ($adminEmails as $adminEmail) {
                email_coverage::sendEmail(
                    'Contact Message From ' . $fullName,
                    'email.coverage_request', // Blade view for admin email
                        [
                            'fullName' => $fullName,
                            'email' => $email,
                            'request_type' => $request_type,
                            'address' => $address,
                            'nearest_landmark' => $nearest_landmark,
                            'mobile_no' => $mobile_no,
                            'no_of_users' => $no_of_users,
                            'province_id' => $province_id,
                            'city_id' => $city_id,
                            'core_area_id' => $core_area_id,
                            'zone_area_id' => $zone_area_id,
                        ],
                    $email_settings->emails, // Assuming $email_settings is available globally
                    $adminEmail
                );
            }
            return response()->json(['status' => true]);
       
    }
    public function becomeUser(Request $request)
    {
            $fullName  = $request->name ;
            $request_type  = 'user  ' ;
            $email     = $request->email ;
            $address = $request->address;
            $nearest_landmark = $request->landmark;
            $mobile_no = $request->mobile_no;
            $no_of_users = $request->no_of_users;
            $province_id = $request->province_id;
            $city_id = $request->city_id;
            $core_area_id = $request->core_area_id;
            $zone_area_id = $request->zone_area_id;

            $coverageRequest = new CoverageRequest;
            $coverageRequest->name = $request->name;
            $coverageRequest->address = $request->address;
            $coverageRequest->nearest_landmark = $request->landmark;
            $coverageRequest->email = $request->email;
            $coverageRequest->mobile_no = $request->mobile_no;
            $coverageRequest->no_of_users = $request->no_of_users;
            $coverageRequest->request_type = 'user';
            $coverageRequest->province_id = $request->province_id;
            $coverageRequest->city_id = $request->city_id;
            $coverageRequest->core_area_id = $request->core_area_id;
            $coverageRequest->zone_area_id = $request->zone_area_id;

            $coverageRequest->save();
            
            $email_settings = FrontEmail::where('status',1)->First();
            $adminEmails = email_coverage::pluck('adminemail')->toArray();
    
            // Send customer email
            email_coverage::sendEmail(
                'Blinkbroadband Contact Request',
                'email.thanks', // Blade view for customer email
                ['fullName' => $fullName,'request_type' => $request_type],
                $email_settings->emails, // Assuming $email_settings is available globally
                $email
            );
    
            // Send admin email
            foreach ($adminEmails as $adminEmail) {
                email_coverage::sendEmail(
                    'Contact Message From ' . $fullName,
                    'email.coverage_request', // Blade view for admin email
                        [
                            'fullName' => $fullName,
                            'email' => $email,
                            'request_type' => $request_type,
                            'address' => $address,
                            'nearest_landmark' => $nearest_landmark,
                            'mobile_no' => $mobile_no,
                            'no_of_users' => $no_of_users,
                            'province_id' => $province_id,
                            'city_id' => $city_id,
                            'core_area_id' => $core_area_id,
                            'zone_area_id' => $zone_area_id,
                        ],
                    $email_settings->emails, // Assuming $email_settings is available globally
                    $adminEmail
                );
            }
            return response()->json(['status' => true]);
            
    
    }
    
    private function sendDetailToManagement($to,$details)
    {
        $subject = 'Blink Braodband New Coverage Request for '.ucwords($details->request_type).' | Date: '.date("F j, Y, g:i a");
        // // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Blinkbroadband <info@blinkbroadband.pk>";
        $message = view('email.coverage_request',['details'=>$details])->render();
        $mail_check =  mail($to,$subject,$message,$headers);
        if ($mail_check) {
            echo "Email sent successfully.";
        } else {
            echo "Failed to send email.";
        }
    }
    private function sendDetailToUser($to,$name,$type)
    {     
        $subject = 'Blink Braodband | Thanks for choosing Us';
        // // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Blinkbroadband <info@blinkbroadband.pk>";
        $message = view('email.thanks',['name'=>$name,'type'=>$type])->render();
       $mail_check =  mail($to,$subject,$message,$headers);
       if ($mail_check) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
    }
}
