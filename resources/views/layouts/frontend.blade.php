<!DOCTYPE html>
<html lang="en-US">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>@yield('page_title')</title>
   <!-- Favicon -->
   @php
   $general_configuration = DB::table('general_configurations')->first();
    @endphp
   <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend_assets/images/' . $general_configuration->brand_logo) }}">
   <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend_assets/images/' . $general_configuration->brand_logo) }}">
   <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend_assets/images/' . $general_configuration->brand_logo) }}">
   <link rel="shortcut icon" href="{{ asset('frontend_assets/images/' . $general_configuration->brand_logo) }}" />
   <!-- Fav end -->
   <link rel="stylesheet" href="{{ asset('site/sweet-alert/sweetalert2.css') }}">
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/all.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css?v=3') }}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/typography.css?v=1') }}">
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css?v=119') }}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/tilteffect.css') }}" />
   <link rel="stylesheet" href="{{ asset('frontend_assets/vendor/aos/aos.css') }}">
   <link rel="stylesheet" href="{{ asset('frontend_assets/css/responsive.css') }}" />
   <link rel="stylesheet" type="text/css" href="{{ asset('frontend_assets/css/form.css') }}">
<style>
   svg {
      width: 100%;
      display: block;
      position: absolute;
      top: 50%;
            transform: translateY(-50%);
    }
    svg .path {
      top:10px;
        stroke-dasharray: 100;
        stroke-dashoffset: 0;
        animation: dash 8s linear forwards;
      }

      @keyframes dash {
        from {
          stroke-dashoffset: 100;
        }
        to {
          stroke-dashoffset: 0;
          fill: #b21828;
          stroke: none;
        }

      }
      .tawk-branding
      {
        display: none !important;
      }
</style>
</head>
<body>
          @php
            $GeneralConfiguration = DB::table('general_configurations')->first();
            $menus = DB::table('front_menus')->where('is_active', 1)->orderby("sortIds" , "asc")->get();
            $socials =  DB::table('socials')->where('status', 1)->orderby("sortIds" , "asc")->get();
           @endphp

    <header id="main-header">
       <div class="main-header">
          <div class="row">
             <div class="col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                   <a class="navbar-brand" href="/">
                       @if(!empty($GeneralConfiguration->brand_logo))
                          <img class="img-fluid logo" src="{{ asset('frontend_assets/images/' . $GeneralConfiguration->brand_logo) }}" alt="SquadCloud" />
                       @endif
                   </a>
                   <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <div class="menu-main-menu-container">
                        <ul id="top-menu" class="navbar-nav ml-auto">
                            @foreach ($menus as $item)
                            <li class="menu-item">
                                <a href="{{ url($item->slug) }}">{{ $item->menu }}</a>
                            </li>
                            @endforeach
                        </ul>
                      </div>
                   </div>
                   <div class="navbar-right menu-right">
                      <div class="d-flex align-items-center justify-content-center">
                         <a href="#" class="btn btn-project">Get A Project</a>
                      </div>
                   </div>
                   <div class="navigation" role="navigation">
                      <div id="menuToggle2">
                        <input type="checkbox" id="menucheckbox"/>
                        <span></span>
                        <span></span>
                        <span></span>
                      </div>
                   </div>
                   <div class="nav-overlay"></div>
                </nav>
             </div>
          </div>
       </div>
    </header>
    <div id="responsive--menu2">
       <ul>
        @foreach ($menus as $item)
          <a href="{{ url($item->slug) }}"><li>{{ $item->menu }}</li></a>
        @endforeach
          <a href="#" target="_blank"><li>Get A Project</li></a>
       </ul>
    </div>

    @yield('content')
    <footer class="footer custom-svg">
    <div class="footer__bottom">
        <div class="container">
            <div class="d-flex align-items-start" style="padding: 30px 0 10px">
                <div style="flex: 1 1 30%">
                    <p class="text-left"><img src="{{ asset('frontend_assets/images/' . $general_configuration->brand_logo) }}" alt="" class="footer--logo mb-20" style="width: 250px"></p>
                    <p class="text-gray pe-5" style="text-align:justify">{!!$general_configuration->site_footer_description!!}</p>
                </div>
                <div style="flex: 1 1 20%">
                    <h6 class="text-white text-left p-3" style="font-size:1rem">Quick Links</h6>
                    <ul class="list-style-none">
                        @foreach ($menus as $item)
                        <li><a href="{{ url($item->slug) }}" class="nav nav-link text-left text-gray">{{ $item->menu }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div style="flex: 1 1 20%">
                    <h6 class="text-white text-left p-3" style="font-size:1rem">Helpful Links</h6>
                    <ul>
                        <li><a href="" class="nav nav-link text-left text-gray">Terms &amp; Conditions</a></li>
                        <li><a href="" class="nav nav-link text-left text-gray">Privacy Policy</a></li>
                        <li><a href="" class="nav nav-link text-left text-gray">Promotions</a></li>
                        <li><a href="" class="nav nav-link text-left text-gray">FAQs</a></li>
                    </ul>
                </div>
                <div style="flex: 1 1 auto">
                    <h6 class="text-white text-left">Subscribe for updates</h6>
                    <form class="text-left"  action="{{route('subscribers.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control text-white" placeholder="Enter your email" style="background-color: transparent; border:1px solid #b9c9c8;box-shadow:none;margin:20px 0">
                            <button type="submit" class="btn btn-sm text-dark" style="background: #d6d2cb;float: right;border-radius: 10px !important;">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr style="margin:5px 0">
            <div class="rowjustify-content-center">
                <!-- <div class="col-sm-6"> -->
                    <div class="footer__copyright">
                        <p class="m-0 text-center">© Copyright 2024 <a class="" href="http://squadcloud.co/" onmouseenter="mouseEnter()" onmouseleave="mouseLeave()">SquadCloud</a> All rights reserved.</p>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="{{ asset('frontend_assets/js/jquery-3.6.0.min.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/popper.min.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/slick.min.js') }}"></script>
     <script src="{{ asset('frontend_assets/vendor/aos/aos.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/slick-animation.min.js') }}"></script>
     <script src="{{ asset('frontend_assets/js/custom.js?v=2') }}"></script>
     <script src="{{ asset('frontend_assets/js/tiltfx.js') }}"></script>
     <script> CKEDITOR.replace('editor1'); </script>
     <script src="ckeditor/ckeditor.js"></script>

     <script>
        window.addEventListener('load', function() { AOS.init(); });
     </script>

     <script>
        $(document).ready(function(){
           $('#menucheckbox').click(function() {
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

     <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/63d231ce47425128790fb7a5/1gnmh547q';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

    <script>
        $(document).ready(function() {
            let errorMessage = "{{ session('error') }}";
            let infoMessage = "{{ session('message') }}";
            let successMessage = "{{ session('success') }}";

            if (errorMessage) {
                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }

            if (infoMessage) {
                Swal.fire({
                    title: 'Message!',
                    text: infoMessage,
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }

            if (successMessage) {
                Swal.fire({
                    title: 'Success!',
                    text: successMessage,
                    icon: 'success',
                    confirmButtonText: 'OK'
            });
        }
        });
    </script>


  </body>
</html>
