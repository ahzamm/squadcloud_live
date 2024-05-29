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
   .video-container {
      border-radius: 20px;
   }
   .overlay {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #000000b3;
      border-radius: 20px;
   }
</style>

<section id="about" class="position-relative pb-5">
   <div class="our-portfolio-bg"></div>
   <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
         @if(isset($about_menu))
            <img src="frontend_assets/images/title/{{$about_menu->title_image}}" alt="{{$about_menu->menu}}" style="width: 50%;">
            <p class="text-center">{{$about_menu->tagline}}</p>
         @else
            <p>No about menu data found.</p>
         @endif
      </div>

      <div class="video-container" data-aos="zoom-in" data-aos-duration="1000">
         @if(isset($about))
         <iframe width="100%" height="100%" src="{{$about->video_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
         @else
            <p>No about data found.</p>
         @endif
      </div>
   </div>
</section>

<section style="min-height: 430px; padding: 100px 0; background-image: url(frontend_assets/images/about-bg.jpg);">
   <div class="container">
      @if(isset($about))
         <div class="d-flex flex-wrap flex-lg-nowrap gap-3">
            <div class="sec-one" data-aos="fade-down" data-aos-duration="1000">
               <div class="d-flex">
                  <div class="p-3">
                     <img src="frontend_assets/images/abouts/{{$about->icon_1}}" alt="">
                  </div>
                  <div>
                     <h2 class="text-white mb-2">{{$about->heading_1}}</h2>
                     {{-- <p class="text-white line-clamp-5">{!! $about->description_1 !!}</p> --}}
                     <p class="text-white line-clamp-5">{!! $about->description_1 !!}</p>
                  </div>
               </div>
            </div>
            <div class="sec-two" data-aos="fade-up" data-aos-duration="1000">
               <div class="d-flex">
                  <div class="p-3">
                     <img src="frontend_assets/images/abouts/{{$about->icon_2}}" alt="">
                  </div>
                  <div>
                     <h2 class="text-white mb-2">{{$about->heading_2}}</h2>
                     <p class="text-white line-clamp-5">{!! $about->description_2 !!}</p>
                  </div>
               </div>
            </div>
            <div class="sec-three" data-aos="fade-down" data-aos-duration="1000">
               <div class="d-flex">
                  <div class="p-3">
                     <img src="frontend_assets/images/abouts/{{$about->icon_3}}" alt="">
                  </div>
                  <div>
                     <h2 class="text-white mb-2">{{$about->heading_3}}</h2>
                     <p class="text-white line-clamp-5">{!! $about->description_3 !!}</p>
                  </div>
               </div>
            </div>
         </div>
      @else
         <p class="text-center text-white">No about data found.</p>
      @endif
   </div>
</section>

<section id="" class="position-relative" style="padding: 100px 0">
   <div class="our-portfolio-bg"></div>
   <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column" data-aos="zoom-in" data-aos-duration="1000">
         @if(isset($about))
            <p class="text-center mb-0">{!! $about->closing_remarks !!}</p>
         @else
            <p class="text-center mb-0">No closing remarks available.</p>
         @endif
      </div>
   </div>
</section>

@endsection
