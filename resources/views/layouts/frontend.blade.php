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

    <!-- <div id="loading">
       <div class="position-relative loading-inner">
       <div class="svg_path">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-8.1 -0.1 50.31 18.34">
                <path d="M 9 3 L 7 1 L 5 3 L 2 0 C 2 0 6 0 24.319 0.04 Z L 9 3 M 7 1.5 C 1 7 3 13 9.796 17.968 L 9.782 14.991 C 6.9 11.4 4.3 8 8.7 3.1 L 7 1.5 Z M 4.2 4.3 C 3.4 5.4 3 6.7 3 8 L -8 8 L 4.2 4.3 Z M 12 13 C 14 12 14.95 10.769 15 9 C 14.962 6.306 13.94 5.141 11 5 Q 7 5 7 9 C 7 10 8 12 10 13 V 11 C 9.328 10.665 9.022 9.962 9 9 C 8.998 8.24 9.226 7.502 10 7 C 10.362 6.718 11.698 6.71 12 7 C 12.72 7.535 12.972 7.977 13 9 C 13.021 9.968 12.64 10.676 12 11 L 12 13 Z M 16 5 H 18 V 10 A 1 1 0 0 0 22 10 V 5 H 24 V 10 C 23.977 15.287 15.976 15.287 16 10 V 5 Z M 25 14 L 28 5 H 30 L 33 14 H 31 L 29 7 L 27 14 H 25 Z M 28.152 9.996 H 29.866 L 30.326 11.634 H 27.678 L 28.151 9.988 Z M 34.043 13.934 V 5.058 H 37.995 C 43.405 5.423 43.557 13.387 38.025 13.903 H 34.043 Z m 1.976 -6.869 V 11.958 H 37.934 C 41.125 11.685 40.791 7.247 37.995 7.065 H 36.019 Z M 11 15 V 18 H 13 V 17.059 H 12 V 15 H 11 Z M 15 15 C 13 15 13 18 15 18 L 15 17 C 14.34 16.995 14.369 16.011 15 16 C 15.671 16.015 15.692 17.003 15 17 V 17.994 C 17 18 17 15 15 15 Z M 17 15 V 17 C 16.976 18.543 19.999 18.489 19.979 17.037 V 15 H 19.004 V 16.704 C 18.991 17.402 17.991 17.423 17.987 16.699 V 15.015 H 16.999 Z M 20.556 15.005 V 18.005 H 21.708 C 24.051 17.999 24.085 15.028 21.72 15.006 H 20.556 Z M 21.471 15.987 L 21.897 15.987 C 22.658 16.02 22.625 17.029 21.864 17.021 H 21.468 V 15.995 Z M 10.415 10.048 H 11.58 V 13.958 H 10.426 V 10.048 Z" stroke="#f00" stroke-width="0.2" fill="none" class="path"/>
            </svg>
        </div> -->
        
          <!-- <div class="loading-images">
             <img src="{{ asset('frontend_assets/images/loader/SQ-01.png') }}" alt="" class="sq1">
             <img src="{{ asset('frontend_assets/images/loader/SQ-02.png') }}" alt="" class="sq2">
             <img src="{{ asset('frontend_assets/images/loader/SQ-03.png') }}" alt="" class="sq3">
             <div class="quad-letter">
                <img src="{{ asset('frontend_assets/images/loader/SQ-04.png') }}" alt="" class="sq4">
                <img src="{{ asset('frontend_assets/images/loader/SQ-05.png') }}" alt="" class="sq5">
                <img src="{{ asset('frontend_assets/images/loader/SQ-06.png') }}" alt="" class="sq6">
                <img src="{{ asset('frontend_assets/images/loader/SQ-07.png') }}" alt="" class="sq7">
             </div>
             <div class="cloud-letters">
                <img src="{{ asset('frontend_assets/images/loader/SQ-08.png') }}" alt="" class="sq8">
                <img src="{{ asset('frontend_assets/images/loader/SQ-09.png') }}" alt="" class="sq9">
                <img src="{{ asset('frontend_assets/images/loader/SQ-10.png') }}" alt="" class="sq10">
                <img src="{{ asset('frontend_assets/images/loader/SQ-11.png') }}" alt="" class="sq11">
             </div>
          </div> -->

       <!-- </div>
     </div> -->

    <!-- <div id="loading">
       <div id="loading-center">
       </div>
    </div> -->
    <header id="main-header">
       <div class="main-header">
          <div class="row">
             <div class="col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                   
                   <a class="navbar-brand" href="/"> <img class="img-fluid logo" src="{{ asset('frontend_assets/images/logo.png') }}"
                   alt="SquadCloud" />
                   </a>
                   <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <div class="menu-main-menu-container">
                        <ul id="top-menu" class="navbar-nav ml-auto">
                            @php
                                $menus = DB::table('menus')->where('status', 1)->get();
                                //echo ($menu);
                            @endphp
                            @foreach ($menus as $item)
                            <li class="menu-item">
                                <a href="{{ $item->link }}"></i>{{ $item->menu_name }}</a>
                            </li>
                            @endforeach
                        </ul>
                      </div>
                   </div>
                   <div class="navbar-right menu-right">
                      <div class="d-flex align-items-center justify-content-center">
                         <a href="#" class="btn btn-project">Get A Projects</a>
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
          <a href="{{ $item->link }}"><li>{{ $item->menu_name }}</li></a>
        @endforeach
          <a href="#" target="_blank"><li>Get A Project</li></a>
       </ul>
    </div>

    @yield('content')


    <footer class="mb-0">
        <div class="container">
           <div class="py-2">

           @php
            $GeneralConfiguration = DB::table('general_configurations')->where('status', 1)->get();        
           @endphp
              <div class="container">
                 <div class="footer-wrapper" style="text-align:center; font-size:14px;">
                  {!! $GeneralConfiguration[0]->footer_text !!}
                    <!-- <p class="mb-0 font-size-14 text-body text-center"><img src="{{ asset('frontend_assets/images/copyright.png') }}" alt="Copyright" style="width: 16px;">{!! $GeneralConfiguration[0]->footer_text !!}<span></p> -->   
                    <!-- <p class="mb-0 font-size-14 text-body text-center"><img src="assets/images/copyright.png" alt="Copyright" style="width: 16px;"><span style="padding-left:-420px;"> All Rights Reserved. Designed and
                     Developed by <a class="text-primary" target="_blank" href="#"> SquadCloud.</a></p> -->
                    <div class="footer-links">
                       <a href="{{$GeneralConfiguration[0]->facebook_url}}"><i class="fab fa-facebook"></i></a>
                       <a href="{{$GeneralConfiguration[0]->linkedin_url}}"><i class="fab fa-linkedin-in"></i></a>
                       <a href="{{$GeneralConfiguration[0]->twitter_url}}"><i class="fab fa-twitter"></i></a>
                    </div>
                 </div>
              </div>

           </div>
        </div>
     </footer>
  
     <!-- <div id="back-to-top">
        <a class="top" href="#top" id="top">
           <img src="{{ asset('frontend_assets/images/back-to-top.png') }}" alt="Top icon" class="w-100">
        </a>
     </div> -->
            <!-- <i class="fa fa-angle-up"></i> -->
  
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
  
     <script type="text/javascript">
      //   $(document).ready(function () {
         // setTimeout(
         // function() 
         // {
         //    $('#loading').fadeOut();
         // }, 100000);
          
      //   });
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

  </body>
  
  </html>
