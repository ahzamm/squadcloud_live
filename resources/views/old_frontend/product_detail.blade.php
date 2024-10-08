@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')

<style>
      body{background-image: linear-gradient(#fff, #cfcfcf);}
      header#main-header {
         background: rgb(100 5 15) !important;
      }
      
   </style>


   <div class="product-jumbotron position-relative">
      <div class="bgopacty"></div>
   
      <div class="container product-wrapper d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="top-content" data-aos="fade-right" data-aos-duration="1000">
         <div class="product--title"><p>{{$product->product_name}} <span>{{$product->product_name_2}}</span></p></div>
            <div class="product--rating">
               <div class="number-part d-inline-block">4.5</div>
               <div class="star-part d-inline-block">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star star"></i>
               </div>
            </div>
            <div class="rating-review-text">633 Reviews and Ratings</div>
         </div>
         <div class="product-buttons" data-aos="fade-left" data-aos-duration="1000">
            <a href="{{$product->link}}" class="btn btn-demo" style="padding: 8px 30px;">View Demo</a>
            <a href="#" class="btn btn-project" style="padding: 8px 30px;">Buy Now</a>
         </div>
        
       </div>
    </div>
  
    <section id="product-inner">
      <div class="container mt-4 d-md-flex">
        <div class="first">
          <div data-aos="fade-up" data-aos-duration="500">
            <a href=""><img class="me-2 icons1" src="/frontend_assets/images/product-detail-icon.png" alt=""><span
                class="fixed w-75 tabs"> Product Details</span> </a>
          </div>
          <div class="mt-1" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500">
            <a href=""><img class=" me-2 icons1" src="/frontend_assets/images/features-Icon.png" alt=""><span
                class="fixed w-75 tabs"> Features</span> </a>
          </div>
          <div class="mt-1" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
            <a href=""><img class=" me-2 icons1" src="/frontend_assets/images/screenshots-Icon.png" alt=""><span
                class="fixed w-75 tabs"> Screenshots</span> </a>
          </div>
          <div class="mt-1" data-aos="fade-up" data-aos-delay="300" data-aos-duration="500">
            <a href=""><img class=" me-2 icons1" src="/frontend_assets/images/pricing-Icon.png" alt=""><span class="fixed w-75 tabs">
                Pricing</span> </a>
          </div>
          <div class="text-center mt-4">
            <p class="d-inline" data-aos="fade-up" data-aos-delay="400" data-aos-duration="500"> Starting at <strong>{{$product->price}} {!!$product->price_description!!}</strong></p>
            <div data-aos="fade-up" data-aos-delay="500">
              <a href="{{$product->link}}" type="button" class="btn btn-dark mt-4 weblink-button">See {{$product->product_name}} {{$product->product_name_2}}<img class="weblink"
                  src="/frontend_assets/images/web-link-Icon.png"></a>
            </div>
          </div>
        </div>
        <div class="second px-4" data-aos="fade-up" data-aos-duration="1000">
          <h3 class="fw-bold">Product Details</h4>
          <h2 class="fw-light py-3">What is {{$product->product_name}} {{$product->product_name_2}}?</h2>
          <p>{!!$product->long_description!!}</p>
  
          </p>
        </div>
      </div>
    </section>
  
    <section>
      @if( isset($featureTable[0]->feature))
        {!!$featureTable[0]->feature!!}
      @else
        <div class="alert alert-danger">No Features Found</div>
      @endif
    </section>
  
    <section>
      <div class="container mt-4">
        <div data-aos="fade-up" data-aos-delay="50">
          <h2 class="mt-1">{{$product->product_name}} {{$product->product_name_2}} Screenshots </h2>
        </div>
        <div class="screenshot-wrapper">
          <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#imageModal" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1000">
            <div class=" mt-3 screensht">
               <div class="screensht-bg">
                  <img src="/storage/media/product/img2/{{$product->img_2}}" alt="" class="w-100 h-100">
               </div> 
            </div>
          </a>
          <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#imageModal" data-aos="zoom-in" data-aos-delay="150" data-aos-duration="1000">
          <div class=" mt-3 screensht">
            <div class="screensht-bg">
               <img src="/storage/media/product/img3/{{$product->img_3}}" alt="" class="w-100 h-100">
            </div> 
         </div>
         </a>
         <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#imageModal" data-aos="zoom-in" data-aos-delay="250" data-aos-duration="1000">
          <div class=" mt-3 screensht">
            <div class="screensht-bg">
               <img src="/storage/media/product/img4/{{$product->img_4}}" alt="" class="w-100 h-100">
            </div> 
         </div>
         </a>
        </div>
      </div>
    </section>
  
    <section class="pb-5">
      <div class="container mt-4">
        <h2 class="my-3" data-aos="fade-up">Pricing </h1>

        <div class="bg-image">
          <div class="ms-5 py-3 text-white prgtxt">
            <p class="fnt-size" data-aos="fade-up"> {{$product->price}} </p> 
            <small class="pe-0 fnt-cloud" data-aos="fade-up" data-aos-delay="100">Cloud</small>
            <p class="mb-2 fnt-cloud"  data-aos="fade-up" data-aos-delay="200">{!!$product->price_description!!}</p>
            <p class="fnt-recomend" data-aos="fade-up" data-aos-delay="300">{{$product->linkProductClass->title}}</p>
          </div>
        </div>
      </div>
    </section>

    @endsection()