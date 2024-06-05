@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')


    <style>
        section {
            padding-top: 100px;
        }

        .more_action {
            display: inline-block;
            padding: 0.75rem 1.25rem;
            border-radius: 10rem;
            color: #fff;
            text-transform: uppercase;
            font-size: 1rem;
            letter-spacing: 0.15rem;
            transition: all 0.3s;
            position: relative;
            bottom: 15px;
            overflow: hidden;
            z-index: 1;
        }

        .more_action:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #71030f;

            border-radius: 10rem;
            z-index: -2;
        }

        .more_action:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background-color: lightgrey;
            opacity: 0.2;

            transition: all 0.3s;
            border-radius: 10rem;
            z-index: -1;
        }

        .more_action:hover {
            color: white;
        }

        .more_action:hover:before {
            width: 100%;
        }
    </style>


    {{-- <div id="loading">
        <div class="position-relative loading-inner">
            <div class="svg_path">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-8.1 -0.1 50.31 18.34">
                    <path
                        d="M 9 3 L 7 1 L 5 3 L 2 0 C 2 0 6 0 24.319 0.04 Z L 9 3 M 7 1.5 C 1 7 3 13 9.796 17.968 L 9.782 14.991 C 6.9 11.4 4.3 8 8.7 3.1 L 7 1.5 Z M 4.2 4.3 C 3.4 5.4 3 6.7 3 8 L -8 8 L 4.2 4.3 Z M 12 13 C 14 12 14.95 10.769 15 9 C 14.962 6.306 13.94 5.141 11 5 Q 7 5 7 9 C 7 10 8 12 10 13 V 11 C 9.328 10.665 9.022 9.962 9 9 C 8.998 8.24 9.226 7.502 10 7 C 10.362 6.718 11.698 6.71 12 7 C 12.72 7.535 12.972 7.977 13 9 C 13.021 9.968 12.64 10.676 12 11 L 12 13 Z M 16 5 H 18 V 10 A 1 1 0 0 0 22 10 V 5 H 24 V 10 C 23.977 15.287 15.976 15.287 16 10 V 5 Z M 25 14 L 28 5 H 30 L 33 14 H 31 L 29 7 L 27 14 H 25 Z M 28.152 9.996 H 29.866 L 30.326 11.634 H 27.678 L 28.151 9.988 Z M 34.043 13.934 V 5.058 H 37.995 C 43.405 5.423 43.557 13.387 38.025 13.903 H 34.043 Z m 1.976 -6.869 V 11.958 H 37.934 C 41.125 11.685 40.791 7.247 37.995 7.065 H 36.019 Z M 11 15 V 18 H 13 V 17.059 H 12 V 15 H 11 Z M 15 15 C 13 15 13 18 15 18 L 15 17 C 14.34 16.995 14.369 16.011 15 16 C 15.671 16.015 15.692 17.003 15 17 V 17.994 C 17 18 17 15 15 15 Z M 17 15 V 17 C 16.976 18.543 19.999 18.489 19.979 17.037 V 15 H 19.004 V 16.704 C 18.991 17.402 17.991 17.423 17.987 16.699 V 15.015 H 16.999 Z M 20.556 15.005 V 18.005 H 21.708 C 24.051 17.999 24.085 15.028 21.72 15.006 H 20.556 Z M 21.471 15.987 L 21.897 15.987 C 22.658 16.02 22.625 17.029 21.864 17.021 H 21.468 V 15.995 Z M 10.415 10.048 H 11.58 V 13.958 H 10.426 V 10.048 Z"
                        stroke="#f00" stroke-width="0.2" fill="none" class="path" />
                </svg>
            </div>
        </div>
    </div> --}}

    <!-- End Social Links -->
    <section id="home" class="iq-main-slider p-0">
        <div id="home-slider" class="slider m-0 p-0">
            @foreach ($home_sliders as $home_slider)
            <div class="slide slick-slide slick-bg s-bg-1">
                <div class="container-fluid position-relative h-100">
                    <div class="slider-inner h-100">


                            <div class="row align-items-center h-100">


                                <div class="col-lg-6 zIndex">
                                    <h1 class="slider-text title" data-animation-in="fadeInLeft" data-delay-in="0.6">
                                        {{ $home_slider->heading }}</h1>

                                    <h4 class="text-white" data-animation-in="fadeInLeft" data-delay-in="0.6">
                                        {{ $home_slider->subheading }}</h4>
                                    <div class="d-flex align-items-center" data-animation-in="fadeInUp" data-delay-in="1">
                                    </div>
                                    <p data-animation-in="fadeInUp" data-delay-in="1.2">{{ $home_slider->description }}
                                    </p>

                                </div>
                                <div class="col-lg-6 minusZindex">
                                    <div class="position-relative">
                                        <img src="{{ asset('frontend_assets/images/home_sliders/' . $home_slider->image_1) }}"
                                            class="position-absolute sub-img-1" alt=""
                                            data-animation-in="fadeInDown" data-delay-in="0.6">
                                        <img src="{{ asset('frontend_assets/images/home_sliders/' . $home_slider->image_2) }}"
                                            class="position-absolute sub-img-2" alt=""
                                            data-animation-in="fadeInDown" data-delay-in="1">
                                        <img src="{{ asset('frontend_assets/images/home_sliders/' . $home_slider->image_3) }}"
                                            class="position-absolute sub-img-3" alt=""
                                            data-animation-in="fadeInDown" data-delay-in="1.4">
                                        <img src="{{ asset('frontend_assets/images/home_sliders/' . $home_slider->image_4) }}"
                                            class="position-absolute sub-img-4" alt=""
                                            data-animation-in="fadeInDown" data-delay-in="1.6">
                                    </div>
                                </div>

                            </div>



                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
                fill="none" stroke="currentColor">
                <circle r="20" cy="22" cx="22" id="test"></circle>
            </symbol>
        </svg>
        <a href="#service-section" class="moveDownBtn"><i class="fa fa-chevron-down chevron_animate"></i></a>
    </section>


<!-- -------SERVICES------- -->
<section id="service-section" class="position-relative">
    <div class="container">
       <div class="text-center" data-aos="zoom-in-down">
          <div style="margin-bottom:11rem;">
          <h2  class="section-heading text-uppercase" >Services</h2>
          <h3 class="section-subheading text-muted" >{{$service_menu->tagline}}</h3>
            </div>
       </div>


       <div class="row">

          @foreach ($services->take(6) as $list)

          <div class="col-lg-4 col-md-6" style="margin-top:-105px; height:300px;">

                <div class="card" data-aos="flip-left" data-aos-duration="1000">
                   <a href="/services/{{$list->slug}}" class="card-service" style='background-color: white'>
                      <div style="display:inline-block; width: 70px; height: 70px;">
                         <img src="frontend_assets/images/services/{{$list->logo}}" alt="" class="p-2" style="width:100%;height: 100%;">
                      </div>
                      <p style="height:auto;" class="p-3 d-inline-block mb-0" style="transform: translate(7px, 6px);">{{$list->service}}</p>
                   </a>
                   <div class="card-body">
                      {{-- <p class="para-text">{!!$list->description!!} --}}
                      <p class="para-text">{!! substr($list->description, 0, 100) !!}
                         <span>[<a href="/services/{{$list->slug}}" class="button">...</a>]</span>
                      </p>
                   </div>
                </div>

          </div>
          @endforeach
       </div>
    </div>
    <div style="display: flex; justify-content: center">
       <a href="services" class="more_action">
          View All
       </a>
    </div>

 </section>


<!-- -------PORTFOLIO------- -->
<section id="portfolio-section" class="position-relative">
    <div class="portfolio-bg"></div>
    <div class="container pb-5">
       <div class="text-center " data-aos="zoom-in-down">
          <h2 class="section-heading text-uppercase" >Portfolio</h2>
          <h3 class="section-subheading text-muted2">{{$portfolio_menu->tagline}}</h3>
       </div>

       <div class="row">
          @foreach ($portfolios->take(3) as $list)
          <div class="col-lg-4 mt-3">
             <a href="{{ $list->link }}">
                <div class="card" data-aos="flip-right" data-aos-duration="1000">
                   <div class="card-header">
                      <p class="p-3 d-inline-block mb-0 text-center w-100">{{$list->title}}</p>

                   </div>
                   <div class="card-body">
                      <p class="text-center">{!! substr($list->description, 0, 100) !!}</p>
                      <img src="{{ asset('frontend_assets/images/portfolio/'. $list->image) }}" class="w-100" alt="">
                   </div>
                   <div class="card-footer">
                      <a href="{{$list->link}}">
                         <div class="d-flex align-items-center justify-content-between pt-3">
                            <p class="mb-0" style="font-weight:bold;">View Case Study</p>
                            <img src="{{ asset('frontend_assets/images/arrow-small.png') }}" alt="" style="width: 15%;">
                         </div>
                      </a>
                   </div>
                </div>
             </a>
          </div>
          @endforeach
       </div>
    </div>

    <div style="display: flex; justify-content: center">
       <a href="portfolio" class="more_action">
          View All
       </a>
    </div>
 </section>



@endsection()
