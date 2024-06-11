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
   #section-slider .slick-nav i:before, #section-slider .slick-nav i:after {
      background: #FFF;
   }
</style>

<section id="about" class="position-relative pb-5">
   <div class="our-portfolio-bg"></div>
   <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
         @if(isset($about_menu))
            <img src="frontend_assets/images/title/{{$about_menu->title_image}}" alt="{{$about_menu->menu}}" style="width: 50%;">
            <p class="text-center">{!! $about->description !!}</p>
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

<section style="min-height: 430px; padding: 100px 0; background-image: url(frontend_assets/images/about-bg.jpg);" id="section-slider">
   <div class="container">
   <h2 class="text-white text-center mb-5">Meet Our Team</h2>
        <!-- -------SLIDER------- -->

      <div class="strategy-slider" data-aos="fade" data-aos-delay="300">
        @foreach ($team as $member)
         <div class="position-relative hex-container" style="height:340px">
            <img src="frontend_assets/images/teams/{{$member->image}}" alt="App" class="" style="width: 120px;
               border: 4px solid #64050f;border-radius: 50%;left: 50%;position: absolute;transform: translateX(-50%);z-index: 9;top:-3px;box-shadow:0 10px 30px rgb(100 5 15)">
            <div class="hex">
               <div style="position:absolute; transform:translate(-50%, -50%) rotate(270deg) ;z-index:9;white-space: nowrap;left:70%;top:50%;text-align:center;">
                  <h3 style="color: #64050f;">{{$member->name}}</h3>
                  <p>{{$member->designation}}</p>
               </div>
            </div>
         </div>


         @endforeach
      </div>
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
