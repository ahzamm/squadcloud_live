@extends('layouts/frontend')
@section('page_title', $home_menu->page_title)
@section('home_select', 'active')
@section('content')
  <style>
    section {
      padding-top: 100px;
    }


    .error-message {
      display: none;
      color: red;
      font-size: 0.875rem;
    }
    #contact-section .section-heading {
      font-size: 4rem;
    font-weight: 900;
    margin-top: 0;
    letter-spacing: 3px;
    color: #000 !important;
    }
    hr {
  border: 0;
  margin: 1.35em auto;
  max-width: 60%;
  background-position: 50%;
  box-sizing: border-box;
}
hr.accessory {
  height: 6px;
  background-image: radial-gradient(
    closest-side,
    hsla(0, 0%, 50%, 1.0),
    hsla(0, 0%, 50%, 0) 100%);
  position: relative;
}
hr.accessory::before {
  position: absolute;
  top:  50%;
  left: 50%;
  display:block;
  background-color: red;
  height: 12px;
  width:  12px;
  transform: rotate(45deg);
  margin-top:  -10px;
  margin-left: -10px;
  border-radius: 4px 0;
  border: 4px solid hsla(0, 0%, 100%, 0.35);
  background-clip: padding-box;
  box-shadow: -10px 10px 0 hsla(0, 0%, 100%, 0.15), 10px -10px 0 hsla(0, 0%, 100%, 0.15);
}

  </style>

  @if ($showAnimation)
    <div id="loading">
      <div class="position-relative loading-inner">
        <div class="svg_path">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="-8.1 -0.1 50.31 18.34">
            <path
              d="M 9 3 L 7 1 L 5 3 L 2 0 C 2 0 6 0 24.319 0.04 Z L 9 3 M 7 1.5 C 1 7 3 13 9.796 17.968 L 9.782 14.991 C 6.9 11.4 4.3 8 8.7 3.1 L 7 1.5 Z M 4.2 4.3 C 3.4 5.4 3 6.7 3 8 L -8 8 L 4.2 4.3 Z M 12 13 C 14 12 14.95 10.769 15 9 C 14.962 6.306 13.94 5.141 11 5 Q 7 5 7 9 C 7 10 8 12 10 13 V 11 C 9.328 10.665 9.022 9.962 9 9 C 8.998 8.24 9.226 7.502 10 7 C 10.362 6.718 11.698 6.71 12 7 C 12.72 7.535 12.972 7.977 13 9 C 13.021 9.968 12.64 10.676 12 11 L 12 13 Z M 16 5 H 18 V 10 A 1 1 0 0 0 22 10 V 5 H 24 V 10 C 23.977 15.287 15.976 15.287 16 10 V 5 Z M 25 14 L 28 5 H 30 L 33 14 H 31 L 29 7 L 27 14 H 25 Z M 28.152 9.996 H 29.866 L 30.326 11.634 H 27.678 L 28.151 9.988 Z M 34.043 13.934 V 5.058 H 37.995 C 43.405 5.423 43.557 13.387 38.025 13.903 H 34.043 Z m 1.976 -6.869 V 11.958 H 37.934 C 41.125 11.685 40.791 7.247 37.995 7.065 H 36.019 Z M 11 15 V 18 H 13 V 17.059 H 12 V 15 H 11 Z M 15 15 C 13 15 13 18 15 18 L 15 17 C 14.34 16.995 14.369 16.011 15 16 C 15.671 16.015 15.692 17.003 15 17 V 17.994 C 17 18 17 15 15 15 Z M 17 15 V 17 C 16.976 18.543 19.999 18.489 19.979 17.037 V 15 H 19.004 V 16.704 C 18.991 17.402 17.991 17.423 17.987 16.699 V 15.015 H 16.999 Z M 20.556 15.005 V 18.005 H 21.708 C 24.051 17.999 24.085 15.028 21.72 15.006 H 20.556 Z M 21.471 15.987 L 21.897 15.987 C 22.658 16.02 22.625 17.029 21.864 17.021 H 21.468 V 15.995 Z M 10.415 10.048 H 11.58 V 13.958 H 10.426 V 10.048 Z"
              stroke="#f00" stroke-width="0.2" fill="none" class="path" />
          </svg>
        </div>
      </div>
    </div>
  @endif

  <!-- -------HOME SLIDER------- -->
  @if (@isset($video->video))
    <div class="video_wrapper">
      <video autoplay muted loop style="width:100%;height:100%">
        <source src="{{ asset('frontend_assets/images/home_sliders/' . $video->video) }}" type="video/mp4">
      </video>
    </div>
  @else
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
                      <img src="{{ asset('frontend_assets/images/home_sliders/' . $home_slider->image_1) }}" class="position-absolute sub-img-1" alt="" data-animation-in="fadeInDown"
                        data-delay-in="0.6">
                      <img src="{{ asset('frontend_assets/images/home_sliders/' . $home_slider->image_2) }}" class="position-absolute sub-img-2" alt="" data-animation-in="fadeInDown"
                        data-delay-in="1">
                      <img src="{{ asset('frontend_assets/images/home_sliders/' . $home_slider->image_3) }}" class="position-absolute sub-img-3" alt="" data-animation-in="fadeInDown"
                        data-delay-in="1.4">
                      <img src="{{ asset('frontend_assets/images/home_sliders/' . $home_slider->image_4) }}" class="position-absolute sub-img-4" alt="" data-animation-in="fadeInDown"
                        data-delay-in="1.6">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle" fill="none" stroke="currentColor">
          <circle r="20" cy="22" cx="22" id="test"></circle>
        </symbol>
      </svg>
      <a href="#service-section" class="moveDownBtn"><i class="fa fa-chevron-down chevron_animate"></i></a>
    </section>
  @endif

  <!-- -------SERVICES------- -->
  <section id="service-section" class="position-relative">
    <div class="container mb-5">
      <div class="text-center" data-aos="zoom-in-down">
        <div style="margin-bottom:2rem;">
          <h2 class="section-heading text-uppercase">Services</h2>
          <h3 class="section-subheading text-muted">{{ $service_menu->tagline }}</h3>
        </div>
      </div>
      <div class="d-lg-flex d-block justify-content-center position-relative">
        @foreach ($services->take(4) as $list)
          <div class="position-relative hex-container">
            <a href="/services/{{ $list->slug }}" data-aos="zoom-in" data-aos-duration="1000" class="d-block hex-anchor aos-init aos-animate">
              <span class="span aos-init aos-animate" style="display:block;width:100%;text-align:center;z-index:1;color: #961b04;top: 30px;font-size:26px" data-aos="fade-down" data-aos-delay="600"
                data-aos-duration="1000">{{ $list->service }}</span>
              <div class="hex"></div>
              <img src="frontend_assets/images/services/{{ $list->logo }}" alt="App" class="svg--img" style="width:40%;top:60%">
            </a>
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
        <h2 class="section-heading text-uppercase">Portfolio</h2>
        <h3 class="section-subheading text-muted2">{{ $portfolio_menu->tagline }}</h3>
      </div>
      <div class="row">
        @foreach ($portfolios->take(3) as $list)
          <div class="col-lg-4 mt-3">
            <a href="{{ $list->link }}">
              <div class="card" data-aos="flip-right" data-aos-duration="1000">
                <div class="card-header">
                  <p class="p-3 d-inline-block mb-0 text-center w-100">{{ $list->title }}</p>
                </div>
                <div class="card-body">
                  <p class="text-center">{!! substr($list->description, 0, 100) !!}</p>
                  <img src="{{ asset('frontend_assets/images/portfolio/' . $list->image) }}" class="w-100" alt="">
                </div>
                <div class="card-footer">
                  <a href="{{ $list->link }}">
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

  <!-- -------CLIENTS Slider------- -->
  {{-- <section id="service-section" class="clients position-relative" style="padding-bottom: 100px">
    <div class="container">
      <div class="text-center" data-aos="zoom-in-down" style="">
        <h2 class="section-heading text-uppercase">Clients</h2>
        <h3 class="section-subheading text-muted">{{ $client_menu->tagline }}</h3>
      </div>
      <div class="client-slider">
        @foreach($Clients as $list)
          <div class="slider-1 d-flex align-items-center justify-content-center py-3">
            <div class="card" data-aos="flip-right" data-aos-duration="1000">
              <a href="{{ $list->link }}" target="_blank" class="card-header d-flex justify-content-center align-items-center" >
                <div class="clients-logo">
                  <img src="{{ asset('frontend_assets/images/clients/' . $list->logo) }}" alt="{{ $list->title }}" class="p-2 d-inline-block">
                </div>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section> --}}
  <!-- <section id="service-section" class="clients position-relative">
    <div class="container">
      <div class="text-center" data-aos="zoom-in-down" style="">
        <h2 class="section-heading text-uppercase">Clients</h2>
        <h3 class="section-subheading text-muted">{{ $client_menu->tagline }}</h3>
      </div>
      <div class="row">
        @forelse($Clients->take(6) as $list)
          <div class="col-lg-4 col-md-6" style="margin-top:-50px;">
            <div class="card" data-aos="flip-right" data-aos-duration="1000">
              <a href="{{ $list->link }}" target="_blank" class="card-header d-flex justify-content-center align-items-center" style="height: 100px">
                <div class="clients-logo">
                  <img src="{{ asset('frontend_assets/images/clients/' . $list->logo) }}" alt="{{ $list->title }}" class="p-2 d-inline-block">
                </div>
              </a>
              <div style="height:auto;" class="card-body">
                <p><b>
                    <h5 class="text-center">{!! substr($list->title, 0, 20) !!}</h5>
                  </b></p>
              </div>
            </div>
          </div>
        @empty
          <div class="alert alert-danger">No Clients Found</div>
        @endforelse
      </div>
    </div>
    <br><br>
    <div style="display: flex; justify-content: center">
      <a href="client" class="more_action">
        View All
      </a>
    </div>
  </section> -->
  <!-- -------CLIENTS Slider end ------- -->

  <!-- -------SLIDER------- -->
  <section id="section-slider" class="slider m-0 p-0 position-relative">
    <div class="strategy-bg"></div>
    <div class="strategy-slider" data-aos="fade" data-aos-delay="300">
      @foreach ($bottom_sliders as $bottom_slider)
        <div class="slider-1 d-flex align-items-center justify-content-center py-3">
          <img src="frontend_assets/images/bottom_sliders/{{ $bottom_slider->image }}" style="width: 1200px;" class="w-50" alt="{{ $bottom_slider->title }}">
        </div>
      @endforeach
    </div>
  </section>



  <!-- -------Contact Us------- -->
  <section id="portfolio-section" class="contact position-relative pb-5" style="padding-top:40px">
    <div class="contact-bg"></div>
    <div class="container pb-1">
      <div class="text-center" data-aos="zoom-in-down">
        <h2 class="section-heading text-uppercase">Got New Project</h2>
        <h3 class="section-subheading text-muted">{!! $contact_menu->tagline !!}</h3>
      </div>
      <div class="main-form">
        @include('component.front.contact')
      </div>
    </div>
  </section>
  <hr class="accessory">
    <!-- -------New projects------- -->
  <div id="contact-section" class="project position-relative py-5">
    <div class="project-bg"></div>
    <div class="container">
      <div class="text-center" data-aos="zoom-in-down">
        <h2 class="section-heading text-uppercase text-white">CONTACT US</h2>
        <h5 class="section-subheading text-muted">Contact us using the following links.</h3>
      </div>
      <div class="d-flex align-items-center justify-content-center mt-4" style="column-gap: 12px">
        @foreach ($socials as $index => $social)
          <a href="{{ $social->url }}" class="social-btn" data-aos="fade-{{ $index % 2 == 0 ? 'up' : 'down' }}" data-aos-duration="1000"><i class="{{ $social->icon }}"></i></a>
        @endforeach
      </div>
    </div>
  </div>
<!-- clients -->

<section id="client-section" class="clients position-relative" style="padding-top: 0px;background-color: #cfcfcf00">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="position:initial; transform:none"><path fill="#cfcfcf70" fill-opacity="1" d="M0,0L48,21.3C96,43,192,85,288,117.3C384,149,480,171,576,154.7C672,139,768,85,864,85.3C960,85,1056,139,1152,154.7C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    <div class="container client-container">
     {{-- <div class="text-center" data-aos="zoom-in-down" style="">
        <h2 class="section-heading text-uppercase">Clients</h2>
        <h3 class="section-subheading text-muted">{{ $client_menu->tagline }}</h3>
      </div>--}}
      <div class="client-slider">
        @foreach($Clients as $list)
          <div class="slider-1 d-flex align-items-center justify-content-center py-3">
            <div class="card" data-aos="flip-right" data-aos-duration="1000">
              <a href="{{ $list->link }}" target="_blank" class="card-header d-flex justify-content-center align-items-center" >
                <div class="clients-logo">
                  <img src="{{ asset('frontend_assets/images/clients/' . $list->logo) }}" alt="{{ $list->title }}" class="p-2 d-inline-block">
                </div>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
      let valid = true;
      document.querySelectorAll('.error-message').forEach(function(el) {
        el.style.display = 'none';
      });

      const fullName = document.getElementById('full_name').value.trim();
      if (!fullName) {
        valid = false;
        document.getElementById('name-error').style.display = 'inline';
      }

      const email = document.getElementById('email').value.trim();
      if (!email) {
        valid = false;
        document.getElementById('email-error').style.display = 'inline';
      }

      const phone = document.getElementById('phone_number').value.trim();
      if (!phone) {
        valid = false;
        document.getElementById('phone-error').style.display = 'inline';
      }

      const serviceRequired = document.getElementById('service_required').value.trim();
      if (!serviceRequired) {
        valid = false;
        document.getElementById('service-error').style.display = 'inline';
      }

      const message = document.getElementById('message').value.trim();
      if (!message) {
        valid = false;
        document.getElementById('message-error').style.display = 'inline';
      }

      if (!valid) {
        event.preventDefault();
      }
    });
  </script>


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function() {
      // hide placeholder
      $('.custom-textarea').on('keyup', function() {
        let textVal = $(this).val();
        console.log(textVal);
        if(!textVal) {
          console.log('no text');
          $('.textarea-placeholder').css('display', 'inline-block');
        } else {
          $('.textarea-placeholder').css('display', 'none');
        }
      })
      $('#contactForm').on('submit', function(e) {
        e.preventDefault();

        // Clear previous error states
        $('.error').removeClass('error');
        $('.error-message').hide();

        // $.ajax({
        //   url: $(this).attr('action'),
        //   method: $(this).attr('method'),
        //   data: $(this).serialize(),
        //   success: function(response) {
        //     if (response.status === 'success') {
        //       Swal.fire({
        //         title: 'Success!',
        //         text: response.message,
        //         icon: 'success',
        //         confirmButtonText: 'OK'
        //       }).then(() => {
        //         $('#contactForm')[0].reset();
        //       });
        //     } else if (response.status === 'error') {
        //       Swal.fire({
        //         title: 'Error!',
        //         text: response.message,
        //         icon: 'error',
        //         confirmButtonText: 'OK'
        //       });
        //     }
        //   },
        //   error: function(xhr) {
        //     if (xhr.status === 422) {
        //       var errors = xhr.responseJSON.errors;
        //       $.each(errors, function(key, error) {
        //         $('#' + key).addClass('error');
        //         $('#' + key + '-error').text(error[0]).show();
        //       });
        //     } else {
        //       Swal.fire({
        //         title: 'Error!',
        //         text: 'An unexpected error occurred. Please try again later.',
        //         icon: 'error',
        //         confirmButtonText: 'OK'
        //       });
        //     }
        //   }
        // });
      });
    });
  </script>
@endsection()
