@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')

<style>
   header#main-header {
      background: rgb(100 5 15) !important;
   }


   /* Client Section */
   section#services {
      padding-top: 150px;
   }
</style>

<section id="services" class="position-relative pb-5">
         <div class="our-portfolio-bg"></div>
         <div class="container">
            <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5"
               data-aos="zoom-in-down">
               <img src="frontend_assets/images/title/{{$service_menu->title_image}}" alt="" style="width: 50%;">
               <p class="text-center">{{$service_menu->tagline}}</p>
            </div>

         @php
         $count = 1
         @endphp
               @foreach($services as $service)
                @if($count == 1 || $count == 2)
                @if($count == 2)

               <div class="position-relative hex-container">
                  <a href="{{ url('/services/' . $service->slug) }}" data-aos="zoom-in" data-aos-duration="1000" class="d-block hex-anchor">
                     <div class="hex"></div>
                        <img src="frontend_assets/images/services/{{$service->logo}}" alt="{{$service->service}}" class="svg--img">
                  </a>
                     <img src="frontend_assets/images/red-arrow.png" alt="left-arrow" class="red-arrow" data-aos="fade-right" data-aos-delay="500" data-aos-duration="1000">
                     <span class="span right" data-aos="fade-down" data-aos-delay="600" data-aos-duration="1000">{{$service->service}}</span>
               </div>
            </div>

            @else
            <div class="d-lg-flex d-block justify-content-center position-relative cs-height">
               <div class="position-relative hex-container" >
                  <span class="span left" data-aos="fade-down" data-aos-delay="600" data-aos-duration="1000">{{$service->service}}</span>
                  <img src="frontend_assets/images/black-arrow.png" alt="" class="black-arrow" data-aos="fade-left" data-aos-delay="500" data-aos-duration="1000">
                  <a href="{{ url('/services/' . $service->slug) }}" data-aos="zoom-in" data-aos-duration="1000" class="d-block hex-anchor" >
                     <div class="hex"></div>
                     <img src="frontend_assets/images/services/{{$service->logo}}" alt="{{$service->service}}" class="svg--img">
                  </a>
               </div>
            @endif

         @elseif($count == 3 || $count == 4)
         @if($count == 4)
         <div class="position-relative hex-container">
            <a href="{{ url('/services/' . $service->slug) }}" data-aos="zoom-in" data-aos-duration="1000" class="d-block hex-anchor">
               <div class="hex"></div>
               <img src="frontend_assets/images/services/{{$service->logo}}" alt="{{$service->service}}" class="svg--img">
            </a>
               <img src="frontend_assets/images/red-arrow.png" alt="left-arrow" class="red-arrow" data-aos="fade-right" data-aos-delay="500" data-aos-duration="1000">
               <span class="span right" data-aos="fade-down" data-aos-delay="600" data-aos-duration="1000">{{$service->service}}</span>
         </div>
      </div>
      @php
      $count = 0;
      @endphp

   @else
   <div class="d-lg-flex d-block justify-content-center position-relative hex-wrapper cs-ml">
      <div class="position-relative hex-container">
         <span class="span left"  data-aos="fade-down" data-aos-delay="600" data-aos-duration="1000">{{$service->service}}</span>
         <img src="frontend_assets/images/black-arrow.png" alt="" class="black-arrow" data-aos="fade-left" data-aos-delay="500" data-aos-duration="1000">
         <a href="{{ url('/services/' . $service->slug) }}" data-aos="zoom-in" data-aos-duration="1000" class="d-block hex-anchor">
            <div class="hex"></div>
            <img src="frontend_assets/images/services/{{$service->logo}}" alt="{{$service->service}}" class="svg--img">
         </a>
      </div>

      @endif
      @endif
      @php

     $count++;


      @endphp
      @endforeach
     @php
     if ($count % 2 == 0) {
     echo '<div class="position-relative hex-container">
          </div> ';
     } @endphp
       </div>
</section>

@endsection()
