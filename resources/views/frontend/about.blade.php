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
   .video-container{
      border-radius: 20px;
   }
.overlay{
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
         @foreach($inner_page_setting as $aboutUs)
         <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
            <img src="storage/media/innerpagesetting/{{$aboutUs->title_image}}" alt="{{$aboutUs->title}}" style="width: 50%;">
            <p class="text-center">{{$aboutUs->description}}</p>
         </div>
         @endforeach


         <div class="video-container" data-aos="zoom-in" data-aos-duration="1000">
     

      <iframe width="100%" height="700px" src="{{$AboutUs[0]->video_url}}">
         </iframe>
      
      </div>
      </div>

   </section>

   <section style="min-height: 430px;padding:100px 0; background-image: url(frontend_assets/images/about-bg.jpg);">
      <div class="container">
         <div class="d-flex flex-wrap flex-lg-nowrap gap-3">
            <div class="sec-one" data-aos="fade-down" data-aos-duration="1000">
               <div class="d-flex">
                  <div class="p-3">
                     <img src="storage/media/about/icon_1/{{$AboutUs[0]->icon_1}}" alt="">
                  </div>
                  <div>
                     <h2 class="text-white mb-2">{{$AboutUs[0]->title_1}}</h2>
                     <p class="text-white line-clamp-5">{!!$AboutUs[0]->description_1!!}</p>
                  </div>
               </div>
            </div>
            <div class="sec-two" data-aos="fade-up" data-aos-duration="1000">
               <div class="d-flex">
                  <div class="p-3">
                     <img src="storage/media/about/icon_2/{{$AboutUs[0]->icon_2}}" alt="">
                  </div>
                  <div>
                     <h2 class="text-white mb-2">{{$AboutUs[0]->title_2}}</h2>
                     <p class="text-white line-clamp-5">{!!$AboutUs[0]->description_2!!}</p>
                  </div>
               </div>
            </div>
            <div class="sec-three" data-aos="fade-down" data-aos-duration="1000">
               <div class="d-flex">
                  <div class="p-3">
                     <img src="storage/media/about/icon_3/{{$AboutUs[0]->icon_3}}" alt="">
                  </div>
                  <div>
                     <h2 class="text-white mb-2">{{$AboutUs[0]->title_3}}</h2>
                     <p class="text-white line-clamp-5">{!!$AboutUs[0]->description_3!!}</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   
   <section id="" class="position-relative" style="padding: 100px 0">
      <div class="our-portfolio-bg"></div>
      <div class="container">
         <div class="title-img d-flex align-items-center justify-content-center flex-column" data-aos="zoom-in" data-aos-duration="1000">
            <p class="text-center mb-0">{!!$AboutUs[0]->main_description!!}</p>
         </div>
      </div>
     
   </section>
@endsection()