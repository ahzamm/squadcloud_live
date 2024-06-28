@extends('layouts/frontend')
@section('home_select', 'active')
@section('content')

  <style>
    header#main-header {
      background: rgb(100 5 15) !important;
    }

    /* Client Section */
    section#career {
      min-height: 100vh;
    }
  </style>

  <section id="career" class="position-relative">
    <div class="our-portfolio-bg"></div>
    <div class="">
      <!-- start banner Area -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <section class="banner-area relative" id="jumbotron">
        <div class="overlay overlay-bg"></div>
        <div class="container">
          <div class="row fullscreen d-flex align-items-center justify-content-center" style="height: calc(100vh - 100px)">
            <div class="banner-content col-lg-12">
              {!! $career->top_heading !!}
            </div>
          </div>
        </div>
      </section>
      <!-- End banner Area -->

      <!-- Start features Area -->
      <section class="features-area">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="single-feature">
                <h2>01</h2>
                <h4>Apply</h4>
                <p>
                  Submit your application and resume to start your journey with us.
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="single-feature">
                <h2>02</h2>
                <h4>Review</h4>
                <p>
                  Our team will carefully evaluate your qualifications and experience.
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="single-feature">
                <h2>03</h2>
                <h4>Interview</h4>
                <p>
                  Participate in interviews to discuss your skills and potential fit.
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="single-feature">
                <h2>04</h2>
                <h4>On board</h4>
                <p>
                  Join our team and begin your exciting new role with comprehensive onboarding.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End features Area -->

      <!-- Start popular-post Area -->
      {{-- <section class="popular-post-area pt-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="active-popular-post-carusel">
                <div class="single-popular-post d-flex flex-row">
                    <div class="thumb">
                        <img class="img-fluid" src="{{ asset('frontend_assets/images/p2.png') }}" alt="">
                        <a class="btns text-uppercase" href="#">view job post</a>
                    </div>
                    <div class="details">
                        <a href="#"><h4>Creative Designer</h4></a>
                        <h6>Karachi</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc ididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis.
                        </p>
                    </div>
                </div>
                <div class="single-popular-post d-flex flex-row">
                    <div class="thumb">
                        <img src="{{ asset('frontend_assets/images/p2.png') }}" alt="">
                        <a class="btns text-uppercase" href="#">view job post</a>
                    </div>
                    <div class="details">
                        <a href="#"><h4>Creative Designer</h4></a>
                        <h6>Karachi</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc ididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis.
                        </p>
                    </div>
                </div>
                <div class="single-popular-post d-flex flex-row">
                    <div class="thumb">
                        <img src="{{ asset('frontend_assets/images/p2.png') }}" alt="">
                        <a class="btns text-uppercase" href="#">view job post</a>
                    </div>
                    <div class="details">
                        <a href="#"><h4>Laravel Developer</h4></a>
                        <h6>Karachi</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc ididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
      <!-- End popular-post Area -->

      <!-- Start feature-cat Area -->
      {{-- <section class="feature-cat-area pt-100" id="category">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    {!!$career->middle_heading!!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="single-fcat">
                    <a href="">
                        <img src="{{ asset('frontend_assets/images/o1.png') }}" alt="">
                    </a>
                    <p>Accounting</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="single-fcat">
                    <a href="">
                        <img src="{{ asset('frontend_assets/images/o2.png') }}" alt="">
                    </a>
                    <p>Development</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="single-fcat">
                    <a href="">
                        <img src="{{ asset('frontend_assets/images/o3.png') }}" alt="">
                    </a>
                    <p>Technology</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="single-fcat">
                    <a href="category.html">
                        <img src="{{ asset('frontend_assets/images/o4.png') }}" alt="">
                    </a>
                    <p>Media & News</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="single-fcat">
                    <a href="category.html">
                        <img src="{{ asset('frontend_assets/images/o5.png') }}" alt="">
                    </a>
                    <p>Support</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="single-fcat">
                    <a href="category.html">
                        <img src="{{ asset('frontend_assets/images/o6.png') }}" alt="">
                    </a>
                    <p>Networking</p>
                </div>
            </div>
        </div>
    </div>
</section> --}}
      <!-- End feature-cat Area -->

      <!-- Start post Area -->
      <section class="post-area section-gap">
        <div class="container">
          <div class="row justify-content-center d-flex">
            <div class="col-lg-8 post-list" id="job-list"></div>
          </div>
        </div>
      </section>
      <!-- End post Area -->

      <!-- Start callto-action Area -->
      <section class="callto-action-area section-gap" id="join">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="menu-content col-lg-9">
              <div class="title text-center">
                {!! $career->bottom_heading !!}
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End calto-action Area -->

    </div>
  </section>
  <!-- Alert -->
  <div id="uploadModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content" style="border: 2px solid #007d88">
        <div class="modal-header" style="background: #007d88;">
          <h6 class="modal-title mt-0 text-white" id="myModalLabel"><i class="fa-solid fa-upload"></i> Upload Resume</h6>
          <span style="font-size:22px; cursor:pointer;" class="text-white" id="closecontactupdatemodal" data-bs-dismiss="modal">x</span>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Upload Resume *</label>
                <input type="file">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function() {
      // Attach the event listener to a parent element
      $(document).on('click', '.filter-button', function(e) {
        e.preventDefault();

        var employmentType = $(this).data('employment-type');

        $.ajax({
          url: '{{ route('site.career') }}',
          type: 'GET',
          data: {
            employment_type: employmentType
          },
          success: function(response) {
            $('#job-list').html(response);
          },
          error: function(xhr) {
            console.log('Error:', xhr.responseText);
          }
        });
      });

      // Load all jobs when the page is first loaded
      $.ajax({
        url: '{{ route('site.career') }}',
        type: 'GET',
        data: {
          employment_type: 'View All'
        },
        success: function(response) {
          $('#job-list').html(response);
        },
        error: function(xhr) {
          console.log('Error:', xhr.responseText);
        }
      });
    });
  </script>


@endsection
