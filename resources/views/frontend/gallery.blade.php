@extends('layouts/frontend')
@section('page_title', $gallery_menu->page_title)
@section('home_select', 'active')
@section('content')


  <style>
    header#main-header {
      background: rgb(100 5 15) !important;
    }

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

    #section-slider .slick-nav i:before,
    #section-slider .slick-nav i:after {
      background: #FFF;
    }
  </style>
  <section id="about" class="position-relative pb-5">
    <div class="our-portfolio-bg"></div>
    <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
          <img src="frontend_assets/images/title/" alt="" style="width: 50%;">
          <h2 class="text-center mb-5">Gallery</h2>
          <div class="gallery">
            @foreach ($gallery as $image)
            <a href="{{ asset('frontend_assets/images/gallary/' . $image->image) }}" data-lightbox="example-set">
              <img src="{{ asset('frontend_assets/images/gallary/' . $image->image) }}">
              </a>
            @endforeach
          </div>
      </div>
    </div>
  </section>
@endsection
