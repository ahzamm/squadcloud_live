@extends('layouts/frontend')
@section('page_title', $contact_menu->page_title)
@section('home_select', 'active')
@section('content')

  <style>
    header#main-header {
      background: rgb(100 5 15) !important;
    }

    section#about {
      padding-top: 150px;
    }

    .error {
      border-color: red;
    }

    .error-message {
      color: red;
      font-size: 0.9rem;
      display: none;
    }
  </style>

  <section id="about" class="position-relative pb-5">
    <div class="our-portfolio-bg"></div>
    <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
        @if (isset($contact_menu))
          <img src="frontend_assets/images/title/{{ $contact_menu->title_image }}" alt="" style="width: 50%;">
          <p class="text-center">{{ $contact_menu->tagline }}</p>
        @else
          <p>No about menu data found.</p>
        @endif
      </div>
      <div class="map-location" id="this-would-be-iframe" data-aos="zoom-in" data-aos-duration="1000">
        @if (isset($contact))
          <iframe src="{{ $contact->location_url }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        @else
          <p>No Location provided.</p>
        @endif
      </div>
    </div>
  </section>
  <section class="half-contact">
    <div class="container">
      <div class="half-contact-wrapper">
        <div class="ctctx">
          @if (isset($contact))
            <h1 class="text-white get-in-touch" data-aos="zoom-in-down">{{ $contact->title }}</h1>
          @endif
          <div class="contact-wrapper">
            @include('component.front.contact')
          </div>
        </div>
        @if (isset($contact))
          <div class="scalingText">
            <p class="mb-0 text-white text-center l-1">{{ $contact->tagline }}</p>
          </div>
        @endif
      </div>
    </div>
  </section>

  <section id="contact-detail" class="position-relative" style="padding: 0 0 50px 0; z-index: -1;">
    <div class="our-portfolio-bg"></div>
    <div class="container">
      <div class="address-wrapper">
        <div class="var-min-width"></div>
        <div class="contact--detail align-items-center flex-column m-5">
          @if (isset($contact))
            <div>
              <div class="phone mb-2">
                <p style="font-size: 1.5rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">Phone</p>
                <p style="font-size: 1.2rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">{{ $contact->phone }}</p>
              </div>
              <div class="email mb-2">
                <p style="font-size: 1.5rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">Email</p>
                <p style="font-size: 1.2rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">{{ $contact->email }}</p>
              </div>
              <div class="address mb-2">
                <p style="font-size: 1.5rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">Address</p>
                <p style="font-size: 1.2rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">{{ $contact->address }}</p>
              </div>
              <div class="timing mb-2">
                <p style="font-size: 1.5rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700">Office Timing</p>
                <p style="font-size: 1.2rem; font-weight: 500;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900">{{ $contact->office_hours_start }} to
                  {{ $contact->office_hours_end }}</p>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <script>
    // document.getElementById('contactForm').addEventListener('submit', function(event) {
    //   let valid = true;
    //   document.querySelectorAll('.error').forEach(function(el) {
    //     el.classList.remove('error');
    //   });
    //   document.querySelectorAll('.error-message').forEach(function(el) {
    //     el.style.display = 'none';
    //   });
    //   const fields = [{
    //       id: 'full_name',
    //       errorId: 'name-error'
    //     },
    //     {
    //       id: 'email',
    //       errorId: 'email-error'
    //     },
    //     {
    //       id: 'phone_number',
    //       errorId: 'phone-error'
    //     },
    //     {
    //       id: 'service_required',
    //       errorId: 'service-error'
    //     },
    //     {
    //       id: 'message',
    //       errorId: 'message-error'
    //     }
    //   ];

    //   fields.forEach(function(field) {
    //     const input = document.getElementById(field.id);
    //     if (!input.value.trim()) {
    //       valid = false;
    //       input.classList.add('error');
    //       document.getElementById(field.errorId).style.display = 'block';
    //     }
    //   });

    //   if (!valid) {
    //     event.preventDefault();
    //   }
    // });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- <script>
    $(document).ready(function() {
      $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        $('.error').removeClass('error');
        $('.error-message').hide();

        $.ajax({
          url: $(this).attr('action'),
          method: $(this).attr('method'),
          data: $(this).serialize(),
          success: function(response) {
            if (response.status === 'success') {
              Swal.fire({
                title: 'Success!',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
              }).then(() => {
                $('#contactForm')[0].reset();
              });
            } else if (response.status === 'error') {
              Swal.fire({
                title: 'Error!',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
          },
          error: function(xhr) {
            if (xhr.status === 422) {
              var errors = xhr.responseJSON.errors;
              $.each(errors, function(key, error) {
                $('#' + key).addClass('error');
                $('#' + key + '-error').text(error[0]).show();
              });
            } else {
              Swal.fire({
                title: 'Error!',
                text: 'An unexpected error occurred. Please try again later.',
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
          }
        });
      });
    });
  </script> --}}

@endsection
