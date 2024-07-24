<!DOCTYPE html>
<html lang="en-US">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>SquadCloud | Digital Company</title>
   <!-- Favicon -->
   <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend_assets/images/favicon/apple-touch-icon.png')}}">
   <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend_assets/images/favicon/favicon-32x32.png')}}">
   <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend_assets/images/favicon/favicon-16x16.png')}}">
   <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" />
   <!-- Fav end -->
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/all.min.css')}}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css')}}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/typography.css')}}">
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css')}}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/tilteffect.css')}}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/vendor/aos/aos.css')}}">

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

   <section class="position-relative" style="height: 100vh;background-image: url(assets/images/404bg.png);background-size: cover;
   background-repeat: no-repeat;">
      <img src="{{ asset('frontend_assets/images/shape.png')}}" alt="" class="shape one">
      <img src="{{ asset('frontend_assets/images/shape.png')}}" alt="" class="shape two">
      <img src="{{ asset('frontend_assets/images/shape.png')}}" alt="" class="shape three">
      <img src="{{ asset('frontend_assets/images/shape.png')}}" alt="" class="shape four">
      <div class="container h-100">
         <!-- <h5 class="text-center fs-1 py-5 fw-light text-gray" data-aos="zoom-in"> Websites We Deal In </h5> -->
         <div class="d-flex align-items-center justify-content-center flex-column h-100">
            <img src="{{ asset('frontend_assets/images/404.png')}}" alt="" style="width: 50%">

            <p style="font-size: 30px;margin-bottom: 0;
            margin-top: 24px;">OOPS!</p>
            <p style="font-weight: bold;
            font-size: 30px;
            color: #a91525;
            font-family: system-ui;">PAGE NOT FOUND</p>
            <a href="/" class="btn btn-project" style="padding: 8px 30px;">Home</a>

         </div>
      </div>

   </section>


   <script src="{{ asset('frontend_assets/js/jquery-3.6.0.min.js')}}"></script>
   <script src="{{ asset('frontend_assets/js/popper.min.js')}}"></script>
   <script src="{{ asset('frontend_assets/js/bootstrap.min.js')}}"></script>
   <script src="{{ asset('frontend_assets/js/slick.min.js')}}"></script>
   <script src="{{ asset('frontend_assets/js/slick-animation.min.js')}}"></script>
   <script src="{{ asset('frontend_assets/js/custom.js')}}"></script>
   <script src="{{ asset('frontend_assets/js/tiltfx.js')}}"></script>
   <script src="{{ asset('frontend_assets/vendor/aos/aos.js')}}"></script>

   <script>
      window.addEventListener('load', function() { AOS.init(); });
   </script>
</body>

</html>
