<!DOCTYPE html>
<html lang="en-US">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>@yield('page_title')</title>
   <!-- Favicon -->
   <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend_assets/images/favicon/apple-touch-icon.png') }}">
   <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend_assets/images/favicon/favicon-32x32.png') }}">
   <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend_assets/images/favicon/favicon-16x16.png') }}">
   <link rel="shortcut icon" href="{{ asset('frontend_assets/images/favicon/favicon.ico') }}" />
   <!-- Fav end -->
<link rel="stylesheet" href="{{ asset('frontend_assets/css/all.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/typography.css') }}">
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css?v=2') }}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/tilteffect.css') }}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/vendor/aos/aos.css') }}">
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/responsive.css') }}" />
   <!-- <link rel="stylesheet" href="css/responsive.css" /> -->

   <style>
      .shape{position: absolute;width: 150px;}
      .shape.one{bottom: 0;}
      .shape.two{right: 0; transform: rotate(180deg);}
      .shape.three{transform: scaleY(-1); opacity: .2;width: 200px}
      .shape.four{right: 0;bottom: 0;transform: scaleX(-1); opacity: .2;width: 200px}
   </style>
</head>

<body>

   <section class="position-relative" style="height: 100vh;background-image: url(frontend_assets/images/404bg.png);background-size: cover;
   background-repeat: no-repeat;">
      <img src="frontend_assets/images/shape.png" alt="" class="shape one">
      <img src="frontend_assets/images/shape.png" alt="" class="shape two">
      <img src="frontend_assets/images/shape.png" alt="" class="shape three">
      <img src="frontend_assets/images/shape.png" alt="" class="shape four">
      <div class="container h-30">
         <!-- <h5 class="text-center fs-1 py-5 fw-light text-gray" data-aos="zoom-in"> Websites We Deal In </h5> -->
         <div class="d-flex align-items-center justify-content-center flex-column h-100">
            <img src="frontend_assets/images/squadcloud-logo.png" alt="maintenance page">

            <p style="font-weight: bold;
            font-size: 30px;
            color: #a91525;
            font-family: system-ui;">Site Maintenance in Progress!
            </p>
            <p style="font-size: 30px;margin-bottom: 0;
            margin-top: 24px;">We are currently performing maintenance on our site. We apologize for any inconvenience this may cause. Please check back soon as we expect to be back up and running shortly. Thank you for your patience.</p>
            <!-- <a href="#" class="btn btn-project" style="padding: 8px 30px;">Home</a> -->

         </div>
      </div>

   </section>
 

    <script src="{{ asset('frontend_assets/js/jquery-3.6.0.min.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/popper.min.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/slick.min.js') }}"></script>
     <script src="{{ asset('frontend_assets/vendor/aos/aos.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/slick-animation.min.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/custom.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/tiltfx.js') }}"></script>
  
     <script type="text/javascript">
        $(document).ready(function () {
           $('#loading').delay(4000).fadeOut("slow");
        });
     </script>
     <script>
        window.addEventListener('load', function() { AOS.init(); });
     </script>
  
     <script>
        $(document).ready(function(){
           $('#menucheckbox').click(function() {
              // alert("Checkbox state (method 1) = " + $('#menucheckbox').prop('checked'));
              if($('#menucheckbox').is(':checked')){
                 $('.nav-overlay').css('opacity', 1);
                 $('.nav-overlay').css('visibility', 'visible');
                 $('body').css('overflow', 'hidden');
              }else{
                 $('.nav-overlay').css('opacity', 0);
                 $('.nav-overlay').css('visibility', 'hidden');
                 $('body').css('overflow', 'auto');
              }
           });
        })
     </script>
      <script>
        $(document).ready(function(){
           $('#menucheckbox').click(function() {
              // alert("Checkbox state (method 1) = " + $('#menucheckbox').prop('checked'));
              if($('#menucheckbox').is(':checked')){
                 $('.nav-overlay').css('opacity', 1);
                 $('.nav-overlay').css('visibility', 'visible');
                 $('#responsive--menu2').css('opacity', 1);
                 $('#responsive--menu2').css('visibility', 'visible');
                 $('body').css('overflow', 'hidden');
              }else{
                 $('.nav-overlay').css('opacity', 0);
                 $('.nav-overlay').css('visibility', 'hidden');
                 $('#responsive--menu2').css('opacity', 0);
                 $('#responsive--menu2').css('visibility', 'hidden');
                 $('body').css('overflow', 'auto');
              }
           });
        })
     </script>
  </body>
  
  </html>