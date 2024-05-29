@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')

<style>
   header#main-header {
      background: rgb(100 5 15) !important;
   }
   /* Client Section */
   section#about {
      padding-top: 150px;
   }
</style>

<section id="about" class="position-relative pb-5">
   <div class="our-portfolio-bg"></div>
   <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
      @if(isset($contact_menu))   
      <img src="frontend_assets/images/title/{{$contact_menu->title_image}}" alt="" style="width: 50%;">  
      <p class="text-center">{{$contact_menu->tagline}}</p>
      @else
            <p>No about menu data found.</p>
      @endif
      </div>
      <div class="map-location" id="this-would-be-iframe" data-aos="zoom-in" data-aos-duration="1000">
      @if(isset($contact)) 
      <!-- {{ $contact->location_url }} -->
            <iframe src="{{ $contact->location_url }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"></iframe>
         @else
            <p>No Location provided.</p>
         @endif
      </div>
   </div>
</section>
<section class="half-contact">
   <div class="container">
      <div class="half-contact-wrapper">
         <div class="ctctx">
         @if(isset($contact)) 
               <h1 class="text-white get-in-touch" data-aos="zoom-in-down">{{ $contact->title }}</h1>
         @endif
               <div class="contact-wrapper">
                  <!-- <form class="contact-form" action="{{ route('contact.manage_contact_forms_process') }}" method="post"> -->
                  <form class="contact-form" action="{{route('site.contact.request')}}" method="post">
                     @csrf
                     <div class="row mb-3">
                        <div class="col" data-aos="fade-right" data-aos-duration="1000">
                           <input type="text" id="full_name" class="form-control name" name="full_name" value="{{ old('full_name') }}" placeholder="Full Name*">
                        </div>
                        <div class="col" data-aos="fade-left" data-aos-duration="1000">
                           <input type="text" id="email" class="form-control email" name="email" value="{{ old('email') }}" placeholder="Email*">
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col" data-aos="fade-right" data-aos-duration="1000">
                           <input type="text" id="phone_number" class="form-control phone" name="phone" value="{{ old('phone') }}" placeholder="Phone Number*">
                        </div>
                        <div class="col" data-aos="fade-left" data-aos-duration="1000">
                           <input type="text" id="service_required" class="form-control service" name="service_required" value="{{ old('service_required') }}" placeholder="Service Required*">
                        </div>
                     </div>
                     <div class="row" style="margin-top: 25px; z-index: 9;">
                        <div class="col position-relative" data-aos="fade-up" data-aos-duration="1000">
                           <div class="overlay"></div>
                           <textarea class="form-control custom-textarea" name="message" id="message" placeholder="Message*" cols="30" rows="50" style="">{{ old('message') }}</textarea>
                           <div class="d-flex align-items-center justify-content-center">
                              <button type="submit" id="send" value="send me" class="" style="background: #fff; margin: auto; width: 250px; margin-top: -60px; height: 60px; color: #71030f; border-top-left-radius: 20px; border-top-right-radius: 20px; border:none; z-index: 9;">Send Message</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
         </div>

         @if(isset($contact)) 
            <div class="scalingText">
               <p class="mb-0 text-white text-center l-1">{{ $contact->tagline}}</p>
            </div>
         @endif
      </div>
   </div>
</section>

<section id="contact-detail" class="position-relative" style="padding: 0 0 50px 0; z-index: -1;">
   <div class="our-portfolio-bg"></div>
   <div class="container">
      <div class="address-wrapper">
         <div class="var-min-width"></div>
         <div class="contact--detail align-items-center flex-column m-5">
         @if(isset($contact)) 
               <div>
                  <div class="phone mb-2">
                     <p style="font-size: 1.5rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">Phone</p>
                     <p style="font-size: 1.2rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">{{ $contact->phone }}</p>
                  </div>
                  <div class="email mb-2">
                     <p style="font-size: 1.5rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">Email</p>
                     <p style="font-size: 1.2rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">{{ $contact->email }}</p>
                  </div>
                  <div class="address mb-2">
                     <p style="font-size: 1.5rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">Address</p>
                     <p style="font-size: 1.2rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">{{ $contact->address }}</p>
                  </div>
                  <div class="timing mb-2">
                     <p style="font-size: 1.5rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700">Office Timing</p>
                     <p style="font-size: 1.2rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900">{{ $contact->office_hours_start }} to {{ $contact->office_hours_end }}</p>
                  </div>
               </div>
            @endif
         </div>
      </div>
   </div>
</section>

@endsection
