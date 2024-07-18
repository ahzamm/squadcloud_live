@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')


  <style>
    html {
      scroll-behavior: smooth;
    }

    body {
      min-height: 100vh;
      height: auto;
      background-image: linear-gradient(#fff, #cfcfcf);
    }

    header#main-header {
      background: rgb(100 5 15) !important;
    }
  </style>

  <div class="product-jumbotron position-relative">
    <div class="bgopacty"></div>

    <div class="container product-wrapper d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <div class="top-content" data-aos="fade-right" data-aos-duration="1000">
        <div class="product--title">
          <p class="mb-0">{{ $portfolio->title }} <span></span></p>
        </div>
        {{-- <div class="product--rating">
          <div class="number-part d-inline-block">{{ $portfolio->rating }}</div>
          <div class="star-part d-inline-block">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star star"></i>
          </div>
        </div>
        <div class="rating-review-text">{{ $portfolio->rating_number }} Reviews and Ratings</div> --}}
      </div>
      <div class="product-buttons" data-aos="fade-left" data-aos-duration="1000">
        <a href="{{ $portfolio->link }}" class="btn btn-demo" style="padding: 8px 30px;">View Demo</a>
        <a href="#" class="btn btn-project" style="padding: 8px 30px;">Buy Now</a>
      </div>

    </div>
  </div>

  <section id="product-inner">
    <div class="container mt-4 d-md-flex">
      <div class="first">
        <div data-aos="fade-up" data-aos-duration="500">
          <a href="#productDetail"><img class="me-2 icons1" src="/frontend_assets/images/product-detail-icon.png" alt=""><span class="fixed w-75 tabs"> Product Details</span> </a>
        </div>
        <div class="mt-1" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500">
          <a href="#productFeatures"><img class=" me-2 icons1" src="/frontend_assets/images/features-Icon.png" alt=""><span class="fixed w-75 tabs"> Features</span> </a>
        </div>
        <div class="mt-1" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
          <a href="#productSS"><img class=" me-2 icons1" src="/frontend_assets/images/screenshots-Icon.png" alt=""><span class="fixed w-75 tabs"> Screenshots</span> </a>
        </div>
        <div class="mt-1" data-aos="fade-up" data-aos-delay="300" data-aos-duration="500">
          <a href="#productPrice"><img class=" me-2 icons1" src="/frontend_assets/images/pricing-Icon.png" alt=""><span class="fixed w-75 tabs">
              Pricing</span> </a>
        </div>
        <div class="text-center mt-4">
          <p class="d-inline" data-aos="fade-up" data-aos-delay="400" data-aos-duration="500"> Starting at <strong> {{ $portfolio->price }} {!! $portfolio->price_description !!}</strong></p>
          <div data-aos="fade-up" data-aos-delay="500">
            <a href="{{ $portfolio->link }}" type="button" class="btn btn-dark mt-4 weblink-button">See {{ $portfolio->product_name }}<img class="weblink"
                src="/frontend_assets/images/web-link-Icon.png"></a>
          </div>
        </div>
      </div>
      <div id="productDetail" class="second px-4" data-aos="fade-up" data-aos-duration="1000">
        <h3 class="fw-bold">Product Details</h3>
        <p>{!! $portfolio->description !!}</p>
        <h3 class="fw-bold">Product Features</h3>
        <p id="productFeatures">{!! $portfolio->features !!}</p>
      </div>
    </div>
    </div>
  </section>

  <section id="productSS">
    <div class="container mt-4">
      <div data-aos="fade-up" data-aos-delay="50">
        <h2 class="mt-1">{{ $portfolio->name }} Screenshots </h2>
      </div>
      <div class="screenshot-wrapper">
        @foreach ($portfolio->images as $image)
          <a href="{{ asset('frontend_assets/images/portfolio/' . $image->images) }}" data-lightbox="example-set" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1000">
            <div class=" mt-3 screensht">
              <div class="screensht-bg">
                <img src="{{ asset('frontend_assets/images/portfolio/' . $image->images) }}" alt="" class="w-100 h-100">
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  <section id="productPrice" class="pb-5">
    <div class="container mt-4">
      <h2 class="my-3" data-aos="fade-up">Pricing </h1>

        <div class="bg-image">
          <div class="ms-5 py-3 text-white prgtxt">
            <p class="fnt-size" data-aos="fade-up"> ${{ $portfolio->price }} </p>
            {{-- <small class="pe-0 fnt-cloud" data-aos="fade-up" data-aos-delay="100">Cloud</small> --}}
            <p class="mb-2 fnt-cloud" data-aos="fade-up" data-aos-delay="200">{!! $portfolio->price_description !!}</p>
          </div>
        </div>
    </div>
  </section>

@endsection()
