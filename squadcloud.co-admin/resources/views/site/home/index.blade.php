<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 @extends('site.layout.app')
 @section('content')
 @php
 $popUpdeals = \App\Models\PopUp::where('status' , 1) ->first();
 @endphp
 @push('style')
 <link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">
 <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">
 @endpush
 <div class="popup" id="captchaPopupPartner">
   <button class="mb-3" style="float:right; color: black!important; background:transparent!important;" onclick="closecaptchaPartner()">X</button>
   <div class="clearfix"></div>
   <div class="captcha-box">
     <div class="captcha">
       <p>Please solve the addition:</p>
       <div class="numbers">
         <span id="num1">8</span>
         <span>+</span>
         <span id="num2">5</span>
         <span><i class="fa fa-refresh" aria-hidden="true" onclick="refreshCaptcha()"></i></span>
       </div>
       <form id="captchaFormPartner">
         <input type="text" id="answer" placeholder="Your answer">
         <button type="submit" id="captchaSubmitPartner">Submit</button>
       </form>
       <p id="result"></p>
     </div>
   </div>
 </div>
 <script>
   function closecaptchaPartner() {
     document.getElementById('captchaPopupPartner').style.display = 'none';
     document.querySelector('.overlay').style.display = 'none';
   }
 </script>
 <div class="popup" id="captchaPopupUser">
   <button class="mb-3" style="float:right; color: black!important; background:transparent!important;" onclick="closecaptchauser()">X</button>
   <div class="clearfix"></div>
   <div class="captcha-box">
     <div class="captcha">
       <p>Please solve the addition:</p>
       <div class="numbers">
         <span id="usernum1">8</span>
         <span>+</span>
         <span id="usernum2">5</span>
         <span><i class="fa fa-refresh" aria-hidden="true" id="refreshCaptcha"></i></span>
       </div>
       <form action="" id="captchaFormUser">
         <input type="text" id="useranswer" placeholder="Your answer">
         <button type="submit" id="captchaSubmitUser">Submit</button>
       </form>
       <p id="result"></p>
     </div>
   </div>
 </div>
 <script>
   function closecaptchauser() {
     document.getElementById('captchaPopupUser').style.display = 'none';
     document.querySelector('.overlay').style.display = 'none';
   }
 </script>
 <!-- Social icons -->
 <div class="social">
  @foreach($links as $link)
  <a href="{{$link->url}}" target="_blank">
   <div class="social-btn" style="background-color: {{$link->color}};">
     <p class="order-1 google-font margin-instagram">{{$link->name}}</p>
     <div class="{{$link->icon}}" style="color: white; width: 30px; height: 30px;" ></div>
   </div>
 </a>
 @endforeach
</div>
<!-- End -->
<div class="modal fade" id="selectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-sm">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title">Discover Us</h4>
     </div>
     <div class="modal-body px-md-5">
       <form action="" method="get" id="selectlocationform">
         <div class="row">
           <div class="col-lg-12">
             <div class="form-group">
               <select name="" id="province" class="form-control custom-form-input">
                 <option value="">Select Province (صوبہ)</option>
                 @foreach ($proviences as $key=> $item)
                 <option value="{{$item->id}}">{{ $item->name}}</option>
                 @endforeach
               </select>
             </div>
           </div>
           <div class="col-lg-12">
             <div class="form-group">
               <select name="" id="cities" class="form-control custom-form-input">
                 <option value="">Select City (شہر)</option>
               </select>
             </div>
           </div>
           <div class="col-lg-12">
             <div class="form-group">
               <select name="" id="coreareas" class="form-control custom-form-input">
                 <option value="">Select Core Area (مرکزی علاقہ)</option>
               </select>
             </div>
           </div>
           <div class="col-lg-12">
             <div class="form-group">
               <select name="" id="zoneareas" class="form-control custom-form-input">
                 <option value="">Select Zone (زون)</option>
               </select>
             </div>
           </div>
         </div>
         <div class="form-group message-btn centred mt-3">
           <button type="submit" class="btn btn-primary" id="submit-form-btn" name="submit-form">Search</button>
         </div>
       </form>
     </div>
   </div>
 </div>
</div>
{{-- Message Modal --}}
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-sm">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title">Blink Broadband</h4>
     </div>
     <div class="modal-body px-5 custom-modal-body">
       <p class="text-center">We are happy to see you here. <b>Congrats,</b> we are obtainable in your selected location!</p>
       <p class="text-center">Choose our service to be a Member or a Consumer</p>
       <div class="form-group message-btn centred mt-3">
         <button type="button" style="width:100%" class="btn btn-primary" id="showpartner" name="submit-form">Be a Member</button>
       </div>
       <div class="form-group message-btn centred mt-3">
         <button type="button" style="width: 100%" class="btn btn-primary" id="showuser" name="submit-form">Be a Consumer</button>
       </div>
     </div>
   </div>
 </div>
</div>
{{-- Message Modal End --}}
{{-- Partner Modal --}}
<div class="modal fade" id="PartnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-sm">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title">Be a Member</h4>
     </div>
     <div class="modal-body px-md-5 custom-modal-body">
       <ul class="alert alert-danger" id="pError" style="display:none">
       </ul>
       <form action="" method="get" id="becomeAPartnerFrm" autocomplete="off">
         <input type="hidden" name="province_id" id="p_province_id" value="">
         <input type="hidden" name="city_id" id="p_city_id" value="">
         <input type="hidden" name="core_area_id" id="p_core_area_id" value="">
         <input type="hidden" name="zone_area_id" id="p_zone_area_id" value="">
         <div class="form-group">
           <input type="text" class="form-control custom-form-input" name="name" id="p_name" placeholder="Your Good Name" style="border-radius: 5px;">
         </div>
         <div class="form-group">
           <input type="text" class="form-control custom-form-input" name="address" id="p_address" placeholder="Enter (Full Address)" style="border-radius: 5px;">
         </div>
         <div class="form-group">
           <input type="text" class="form-control custom-form-input" name="landmark" id="p_landmark" placeholder="Enter (Nearest Landmark)" style="border-radius: 5px;">
         </div>
         <div class="form-group">
           <input type="number" class="form-control custom-form-input" name="mobile_no" id="p_number" placeholder="Enter (Mobile Number)" style="border-radius: 5px;">
         </div>
         <div class="form-group">
           <input type="text" class="form-control custom-form-input" name="email" id="p_email" placeholder="Enter (Email Address)" style="border-radius: 5px;">
         </div>
         <div class="form-group">
           <input type="number" class="form-control custom-form-input" name="no_of_users" id="p_user" placeholder="Enter (Number Of Consumers)" style="border-radius: 5px;">
         </div>
         <div class="form-group message-btn centred mt-3">
           <button type="submit" class="btn btn-primary" id="p-btn" name="submit-form">Apply Now</button>
         </div>
       </form>
     </div>
   </div>
 </div>
</div>
{{-- Partner Modal End --}}
{{-- User  Modal --}}
<div class="modal fade " id="UserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-sm">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title">Be a Consumer</h4>
     </div>
     <div class="modal-body px-md-5 custom-modal-body">
       <ul class="alert alert-danger" id="uError" style="display:none">
       </ul>
       <form action="" method="get" id="becomeAUserFrm" autocomplete="off">
         <input type="hidden" name="province_id" id="u_province_id" value="">
         <input type="hidden" name="city_id" id="u_city_id" value="">
         <input type="hidden" name="core_area_id" id="u_core_area_id" value="">
         <input type="hidden" name="zone_area_id" id="u_zone_area_id" value="">
         <div class="form-group">
           <input type="text" class="form-control" name="name" id="name" placeholder="Your Good Name">
         </div>
         <div class="form-group">
           <input type="text" class="form-control" name="address" id="address" placeholder="Enter (Full Address)">
         </div>
         <div class="form-group">
           <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Enter (Nearest Landmark)">
         </div>
         <div class="form-group">
           <input type="number" class="form-control" name="mobile_no" id="number" placeholder="Enter (Mobile Number)">
         </div>
         <div class="form-group">
           <input type="text" class="form-control" name="email" id="email" placeholder="Enter (Email Address)">
         </div>
         <div class="form-group message-btn centred mt-3">
           <button type="submit" class="btn btn-primary" id="u-btn" name="submit-form">Apply Now</button>
         </div>
       </form>
     </div>
   </div>
 </div>
</div>
{{-- User Modal End --}}
<!-- Pop-up Modal -->
<style>
 #imagePopup {
   display: none;
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: rgba(0, 0, 0, 0.8);
   justify-content: center;
   align-items: center;
   z-index: 9999;
 }
 #popupContent {
   max-width: 500px;
   max-height: 500px;
   overflow: hidden;
   position: relative;
   /* Add this line */
 }
 #popupImage {
   width: 100%;
   height: 100%;
   display: block;
   margin: auto;
 }
 #closeButton {
   position: absolute;
   top: -5px;
   right: 5px;
   color: white;
   cursor: pointer;
   font-size: 40px;
 }
</style>
<!-- Image Popup -->
<div id="imagePopup">
 <div id="popupContent">
   <span id="closeButton" onclick="closeImagePopup()">&times;</span>
   <img id="popupImage" src="" alt="Popup Image">
 </div>
</div>
<script>
   // Function to Count The Current Date and Time For The Pop to show Up
   let startDate = '{{ optional($popUpdeals)->start_date }}'; // Highlighted
    let startTime = '{{ optional($popUpdeals)->start_time }}'; // Highlighted
    let endDate = '{{ optional($popUpdeals)->end_date }}'; // Highlighted
    let endTime = '{{ optional($popUpdeals)->end_time }}'; // Highlighted
    const popup = document.getElementById('imagePopup');
    const popupImage = document.getElementById('popupImage');
  //  console.log(startDate, startTime, endDate, endTime);
  function openImagePopup(imagePath) {
   popupImage.src = imagePath;
        //  console.log('Image path:', popuiImage.src);
        popup.style.display = 'flex';
      }
      function closeImagePopup() {
       popup.style.display = 'none';
     }
     function parseDate(dateString, timeString) {
       let [year, month, day] = dateString.split('-');
       let [hours, minutes] = timeString.match(/\d+|pm|am/gi);
       if (hours !== '12') {
         hours = (timeString.includes('pm') ? +hours + 12 : +hours).toString();
       } else {
         hours = (timeString.includes('am') ? '0' : '12');
       }
       return new Date(year, month - 1, day, hours, minutes);
     }
     let startDateAndTime = parseDate(startDate, startTime);
     let endDateAndTime = parseDate(endDate, endTime);
     function updateTime() {
       let currentDate = new Date();
       console.log(startDate);
       if (currentDate >= startDateAndTime && currentDate < endDateAndTime) {
         const delay = 3000;
         let baseUrl = "{{asset('')}}";
         let imageUrl = "{{ optional($popUpdeals)->image }}";
         setTimeout(function() {
           openImagePopup(baseUrl + '/PopUpImages/' + imageUrl);
         }, delay);
       } else if (currentDate >= endDateAndTime) {
         popup.style.display = 'none';
       } else {
        popup.style.display = 'none';
      }
    }
   updateTime(); // Call the function to display the initial countdown status
 </script>
 @include('site.partial.header')
 <div class="content-block stick-to-footer">
   <div class="page-container container">
     <div class="row">
       <div class="col-md-12 entry-content">
         <article>
           <div id="home" data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true" class="vc_row wpb_row vc_row-fluid vc_row-no-padding">
            @if($Videos->video)
            <div class="video_wrapper">
              <video autoplay muted loop style="width:100%;height:100%">
                <source src="{{asset('VideoHeader/' . $Videos->video)}}" type="video/mp4">
                </video>
              </div>
              @else
              <div class="wpb_column vc_column_container vc_col-sm-12">
               <div class="vc_column-inner">
                 <div class="wpb_wrapper">
                   <div class="wpb_revslider_element wpb_content_element">
                     <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-source="gallery" style="background: transparent; padding: 0px;">
                       @livewire('front.slides')
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             @endif
           </div>
           <div class="vc_row-full-width vc_clearfix"></div>
           <!-- <div class="vc_row wpb_row vc_row-fluid">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_grey">
                                    <span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div> -->
                  <div id="bundle-offers" class="vc_row wpb_row vc_row-fluid vc_custom_1501509841376 vc_row-o-equal-height vc_row-flex">
                   <div class="wpb_column vc_column_container vc_col-sm-3">
                     <div class="vc_column-inner vc_custom_1487239752272">
                       <div class="wpb_wrapper"></div>
                     </div>
                   </div>
                   <div class="wpb_column vc_column_container vc_col-sm-6">
                     <div class="vc_column-inner">
                       <div class="wpb_wrapper">
                         <div class="mgt-header-block clearfix text-center text-black wpb_animate_when_almost_visible wpb_fadeInDown fadeInDown wpb_content_element mgt-header-block-style-1 mgt-header-block-fontsize-medium mgt-header-texttransform-subheader mgt-header-block-63207372 vc_custom_1501339177251">
                           <h2 class="mgt-header-block-title text-font-weight-default">Bundle Offer</h2>
                           <div class="mgt-header-line mgt-header-line-margin-large"></div>
                         </div>
                         <div class="wpb_text_column wpb_content_element wpb_animate_when_almost_visible wpb_fadeInDown fadeInDown ">
                           <div class="wpb_wrapper">
                             <p style="text-align: center;">Bigger the package double the fun Blink Broadband gives the limited time offer and best fiber optic internet packages to its valued customer these packages covered with automated internet breakdown supervision, customer support and maintenance management.</p>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="wpb_column vc_column_container vc_col-sm-3">
                     <div class="vc_column-inner">
                       <div class="wpb_wrapper"></div>
                     </div>
                   </div>
                 </div>
                 {{-- packages --}}
                 @livewire('front.pakage-detail')
                 {{-- end packages --}}
                 <div class="vc_row-full-width vc_clearfix"></div>
                 <div class="vc_row-full-width vc_clearfix"></div>
                 <div class="vc_row-full-width vc_clearfix"></div>
                 <hr class="accessory">
                 <div id="team" data-vc-full-width="true" class="vc_row wpb_row vc_row-fluid vc_custom_1501509947428">
                   <div class="wpb_column vc_column_container vc_col-sm-12">
                     <div class="vc_column-inner vc_custom_1501257004641">
                       <div class="wpb_wrapper">
                         <div class="mgt-header-block clearfix text-center text-black wpb_animate_when_almost_visible wpb_fadeInDown fadeInDown wpb_content_element mgt-header-block-style-1 mgt-header-block-fontsize-medium mgt-header-texttransform-subheader mgt-header-block-85237970 vc_custom_1501506413103">
                           <h2 class="mgt-header-block-title text-font-weight-default">Reseller <span style="color:#22a638">&</span> Contractor</h2>
                           <!-- <p class="mgt-header-block-subtitle">Reseller Details</p> -->
                           <div class="mgt-header-line mgt-header-line-margin-large"></div>
                         </div>
                         <div>
                           @livewire('front.reseller-detail')
                         </div>
                         <div class="clearfix"></div>
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class="vc_row-full-width vc_clearfix"></div>
                 <div class="vc_row wpb_row vc_row-fluid" style="display:none">
                   <div class="wpb_column vc_column_container vc_col-sm-12">
                     <div class="vc_column-inner">
                       <div class="wpb_wrapper">
                         <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_grey">
                           <span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class="vc_row-full-width vc_clearfix"></div>
                 <hr class="accessory">
                 <div id="about-us" class="vc_row wpb_row vc_row-fluid vc_custom_1501509753637 vc_row-o-equal-height vc_row-flex">
                   <div class="wpb_column vc_column_container vc_col-sm-3">
                     <div class="vc_column-inner vc_custom_1487239752272">
                       <div class="wpb_wrapper"></div>
                     </div>
                   </div>
                   <div class="wpb_column vc_column_container vc_col-sm-6">
                     <div class="vc_column-inner">
                       <div class="wpb_wrapper">
                         <div class="mgt-header-block clearfix text-center text-black wpb_animate_when_almost_visible wpb_fadeInDown fadeInDown wpb_content_element mgt-header-block-style-1 mgt-header-block-fontsize-medium mgt-header-texttransform-subheader mgt-header-block-10140475 vc_custom_1501253102638">
                           <h2 class="mgt-header-block-title text-font-weight-default">About Us</h2>
                           <p class="mgt-header-block-subtitle">Fast and Robust Network</p>
                           <div class="mgt-header-line mgt-header-line-margin-large"></div>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="wpb_column vc_column_container vc_col-sm-3">
                     <div class="vc_column-inner">
                       <div class="wpb_wrapper"></div>
                     </div>
                   </div>
                   @livewire('front.about')
                   @if($message[0]->active == 1)
                   @livewire('front.messages')
                   @endif
                   <hr class="accessory">
                   <div id="why-choose-us" data-vc-full-width="true" data-vc-full-width-init="false" data-vc-parallax="1.5" data-vc-parallax-image="" class="vc_row wpb_row vc_row-fluid vc_custom_1501511161351 vc_row-has-fill vc_general vc_parallax vc_parallax-content-moving">
                     <div class="wpb_column vc_column_container vc_col-sm-12">
                       <div class="vc_column-inner">
                         <div class="wpb_wrapper">
                           <div class="vc_row wpb_row vc_inner vc_row-fluid">
                             <div class="wpb_column vc_column_container vc_col-sm-2">
                               <div class="vc_column-inner">
                                 <div class="wpb_wrapper"></div>
                               </div>
                             </div>
                             <div class="wpb_column vc_column_container vc_col-sm-8">
                               <div class="vc_column-inner">
                                 <div class="wpb_wrapper">
                                   <div class="mgt-header-block clearfix text-center text-white wpb_animate_when_almost_visible wpb_fadeInDown fadeInDown wpb_content_element mgt-header-block-style-1 mgt-header-block-fontsize-medium mgt-header-texttransform-subheader mgt-header-block-60330538 vc_custom_1501258662976">
                                     <h2 class="mgt-header-block-title text-font-weight-default " style="color:#2A2F35">
                                     Why Choose Us</h2>
                                     <p class="mgt-header-block-subtitle">what we can do</p>
                                     <div class="mgt-header-line mgt-header-line-margin-large"></div>
                                   </div>
                                 </div>
                               </div>
                             </div>
                             <div class="wpb_column vc_column_container vc_col-sm-2">
                               <div class="vc_column-inner">
                                 <div class="wpb_wrapper"></div>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                     @livewire('front.why-us-details')
                   </div>
                   <!-- start Contact us -->
                   <div class="vc_row-full-width vc_clearfix"></div>
                   <div class="vc_row-full-width vc_clearfix"></div>
                   <hr class="accessory">
                   <div id="contact" data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1501510085146 vc_row-has-fill vc_row-o-equal-height vc_row-flex">
                     <div class="wpb_column vc_column_container vc_col-sm-2">
                       <div class="vc_column-inner">
                         <div class="wpb_wrapper"></div>
                       </div>
                     </div>
                     <div class="wpb_column vc_column_container vc_col-sm-8">
                       <div class="vc_column-inner">
                         <div class="wpb_wrapper">
                           <div class="mgt-header-block clearfix text-center text-white wpb_animate_when_almost_visible wpb_fadeInDown fadeInDown wpb_content_element mgt-header-block-style-1 mgt-header-block-fontsize-medium mgt-header-texttransform-subheader mgt-header-block-50649710 vc_custom_1501504330185">
                             <h2 class="mgt-header-block-title text-font-weight-default" style="color: black;">Contact Us</h2>
                             <p class="mgt-header-block-subtitle">GET IN TOUCH</p>
                             <div class="mgt-header-line mgt-header-line-margin-large"></div>
                           </div>
                           @livewire('front.contact')
                         </div>
                       </div>
                     </div>
                     <div class="wpb_column vc_column_container vc_col-sm-2">
                       <div class="vc_column-inner">
                         <div class="wpb_wrapper"></div>
                       </div>
                     </div>
                   </div>
                   <div class="vc_row-full-width vc_clearfix"></div>
                   <!-- End Contact Us -->
                   <hr class="accessory">
                   <div id="faqs" class="vc_row wpb_row vc_row-fluid vc_custom_1501509947428 faq_padding">
                     <div class="wpb_column vc_column_container vc_col-sm-12">
                       <div class="vc_column-inner vc_custom_1501257004641">
                         <div class="wpb_wrapper">
                           <div class="mgt-header-block clearfix text-center text-black wpb_animate_when_almost_visible wpb_fadeInDown fadeInDown wpb_content_element mgt-header-block-style-1 mgt-header-block-fontsize-medium mgt-header-texttransform-subheader mgt-header-block-85237970 vc_custom_1501506413103">
                             <h2 class="mgt-header-block-title text-font-weight-default">FAQs</h2>
                             <p class="mgt-header-block-subtitle">Frequently Asked Questions</p>
                             <div class="mgt-header-line mgt-header-line-margin-large"></div>
                           </div>
                           <div>
                             @livewire('front.faqs')
                           </div>
                           <div class="clearfix"></div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </article>
               </div>
             </div>
           </div>
           @php
           $frontSettings = \App\Models\Logo::where('active' , 1)->first();
           @endphp
           <div class="row custom__footer" style="padding: 10px 0px 0px 0px">
             <div class="col-md-12 col-sm-12">
               <p style="color: white; line-height: 1.8; margin-left: 20px; font-size: 16px; text-align:center">
                 &copy; 2012 Blink Broadband. Powered by <a target="_blank" class="powered-link" href="https://logon.com.pk" style="color: #FFF">{{$frontSettings->footer}}</a>
               </p>
             </div>
     {{-- <!-- <div class="col-md-6 col-sm-6">
        <div class="text-right">
            <php
            $links = \App\Models\Social::where("status", 1)->orderBy("created_at", "desc")->get();
            ?>
            <ul style="list-style-type: none;">
                @foreach($links as $social)
                <li style="display: inline-block; font-size: 18px; padding: 0px 10px">
                    <a style="color: white;" href="{{$social->url}}" target="_blank"
     onmouseover="changeColor(this, '{{$social->color}}')"
     onmouseout="changeColorBack(this)">
     <i class="{{$social->icon}}"></i>
     </a>
     </li>
     @endforeach
     </ul>
   </div>
 </div> --> --}}
</div>
</div>
 <!-- <div class="container-fluid footer-wrapper">
     <div class="row"></div>
   </div> -->
   <nav id="offcanvas-sidebar-nav" class="st-sidebar-menu st-sidebar-effect-2">
     <div class="st-sidebar-menu-close-btn"><i class="pe-7s-close"></i></div>
     <div class="offcanvas-sidebar sidebar">
       <ul id="offcanvas-sidebar" class="clearfix">
         <li id="text-11" class="widget widget_text">
           <h2 class="widgettitle">We Are Here</h2>
           <div class="textwidget">
             <p class="text-justify"></p>
           </div>
         </li>
         <li id="text-10" class="widget widget_text">
           @php
           $sideMenuHomeData = \App\Models\HomeSideMenu::where('status' , 1)->first();
           @endphp
           <div class="textwidget">
             <p><span><i class="fa fa-location-dot" style="color: white;font-size: 15px;"></i> </span> {{$sideMenuHomeData->address}}</p>
             <p>
               <span><i class="fa fa-phone-volume" style="color: white;font-size: 15px;"></i> </span> {{$sideMenuHomeData->phone}}<br />
               <span><i class="fa fa-envelope" style="color: white;font-size: 15px;"></i> </span> <span class="text-color-theme"><a href="mailto:{{$sideMenuHomeData->email}}" class="__cf_email__">{{$sideMenuHomeData->email}}</a></span>
             </p>
           </div>
         </li>
         <li id="barrel-social-icons-3" class="widget widget_barrel_social_icons">
           <h2 class="widgettitle">Subscribe & Follow</h2>
           <div class="textwidget">
             <div class="social-icons-wrapper">
               <?php
               $links =  \App\Models\Social::where("status", 1)->orderby("sortIds" , "asc")->get();
               ?>
               <ul>
                 @foreach($links as $social)
                 <li>
                   <a style="color: white;font-size:30px" href="{{$social->url}}" target="_blank" onmouseover="changeColor(this, '{{$social->color}}')" onmouseout="changeColorBack(this)">
                     <i class="{{$social->icon}}"></i>
                   </a>
                 </li>
                 @endforeach
               </ul>
             </div>
           </div>
         </li>
       </ul>
     </div>
     <script>
       function changeColor(element, newColor) {
         element.style.color = newColor;
       }
       function changeColorBack(element) {
         element.style.color = 'white';
       }
     </script>
   </nav>
   @push('scripts')
   <script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
   <script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
   <script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
   <script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
   <script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
   <script>
     $("#becomeAPartnerFrm").submit(function(e) {
       e.preventDefault();
       alert('working')
     });
   </script>
   @endpush
   @endsection