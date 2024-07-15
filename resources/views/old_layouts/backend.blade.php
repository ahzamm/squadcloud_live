<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('page_title')</title>
  <!-- Favicon -->

  <!-- Custom styles -->
  <link rel="stylesheet" href="{{ asset('admin_assets/css/style.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css?v=150') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/css/fontawesome-free-6.2.1-web/css/all.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js" ></script>
</head>

<body>
  <div class="layer"></div>
<!-- ! Body -->
<a class="skip-link sr-only" href="#skip-target">Skip to content</a>
<div class="page-flex">
  <!-- ! Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="/" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <!-- <span class="icon logo" aria-hidden="true"></span> -->
                <div class="llogo">
                  <img src="{{ Config::get('constants.SITE_LOGO') }}" style="width: 180px; height: 52px;" alt="Logo">
                </div>
                <div class="logo-text">
                    <span class="logo-title">SquadCloud</span>
                    <span class="logo-subtitle"></span>
                </div>
            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li class="@yield('dashboard_select')">
                  <a href="{{ url('admin/dashboard') }}">
                    <i class="fa fa-dashboard"></i>  Dashboard
                  </a>
                </li>

                <!-- <li class="@yield('product_select')">
                  <a class="{{ Request::is('admin/product') ? 'active' : null }}" href="{{ url('admin/product') }}">
                    <i class="fa-solid fa-table-columns"></i>  Product
                  </a>
                </li> -->

                <li class="{{ Request::is('admin/product') || Request::is('admin/feature') || Request::is('admin/product_class') ? 'active' : null }} treeview">
                  <a class="show-cat-btn" href="#">
                    <i class="fa fa-cart-plus"></i> Products
                      <span class="category__btn transparent-btn" title="Open list">
                          <span class="sr-only">Open list</span>
                          <i class="fa fa-angle-down"></i><!-- <i class="icon-copy fa fa-cart-plus" aria-hidden="true"></i> -->
                      </span>
                  </a>

                  <ul class="cat-sub-menu">
                      <li class="{{ Request::is('admin/product') ? 'active' : null }}">
                          <a href="{{ url('admin/product') }}">Add Product</a>
                      </li>
                      <li class="{{ Request::is('admin/feature') ? 'active' : null }}">
                          <a href="{{ url('admin/feature') }}">Add Product Feature</a>
                      </li>
                      <li class="{{ Request::is('admin/product_class') ? 'active' : null }}">
                          <a href="{{ url('admin/product_class') }}">Add Product Class</a>
                      </li>
                  </ul>
              </li>

              <li>
                  <a class="show-cat-btn" href="#">
                    <i class="fa fa-bar-chart"></i> Trafic
                      <span class="category__btn transparent-btn" title="Open list">
                          <span class="sr-only">Open list</span>
                          <i class="fa fa-angle-down"></i>
                      </span>
                  </a>

                  <ul class="cat-sub-menu">
                      <li>
                          <a href="{{ url('admin/rating') }}">Ratings</a>
                      </li>
                      <!-- <li>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Form-02</a>
                      </li> -->
                      <li>
                          <a href="{{ url('admin/contact_forms') }}">Contact Forms</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/checkout') }}">Checkouts</a>
                      </li>
                  </ul>
              </li>

              <li>
                  <a class="show-cat-btn" href="#">
                    <i class="fa fa-clipboard"></i> Pages
                      <span class="category__btn transparent-btn" title="Open list">
                          <span class="sr-only">Open list</span>
                          <i class="fa fa-angle-down"></i>
                      </span>
                  </a>

                  <ul class="cat-sub-menu">
                    <li>
                          <a href="{{ url('admin/portfolio') }}">Portfolio</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/services') }}">Services</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/client') }}">Clients</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/about') }}">About</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/blog') }}">Blog</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/contact') }}">Contact</a>
                      </li>
                  </ul>
              </li>


              <li>
                  <a class="show-cat-btn" href="#">
                    <i class="fa fa-cog"></i> Settings
                      <span class="category__btn transparent-btn" title="Open list">
                          <span class="sr-only">Open list</span>
                          <i class="fa fa-angle-down"></i>
                      </span>
                  </a>

                  <ul class="cat-sub-menu">
                    <li>
                          <a href="{{ url('admin/menu') }}">Menus</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/social') }}">Social</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/header') }}">Header Slider</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/slider') }}">Image Slider</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/setting') }}">Home Page Headings</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/innerpage_setting') }}">Inner Page Headings</a>
                      </li>
                  </ul>
              </li>




                <!-- <li class="@yield('slider_select')">
                  <a class="{{ Request::is('admin/slider') ? 'active' : null }}" href="{{ url('admin/slider') }}">
                    <i class="fa-solid fa-table-columns"></i>  Slider
                  </a>
                </li>

                <li class="@yield('header_select')">
                  <a class="{{ Request::is('admin/header') ? 'active' : null }}" href="{{ url('admin/header') }}">
                    <i class="fa-solid fa-table-columns"></i>  Header
                  </a>
                </li>
 -->
                <!-- <li class="@yield('client_select')">
                  <a class="{{ Request::is('admin/client') ? 'active' : null }}" href="{{ url('admin/client') }}">
                    <i class="fa-solid fa-table-columns"></i>  Client
                  </a>
                </li> -->


                <!-- <li class="@yield('portfolio_select')">
                  <a class="{{ Request::is('admin/portfolio') ? 'active' : null }}" href="{{ url('admin/portfolio') }}">
                    <i class="fa-solid fa-table-columns"></i>  Portfolio
                  </a>
                </li> -->

                <!-- <li class="@yield('services_select')">
                  <a class="{{ Request::is('admin/services') ? 'active' : null }}" href="{{ url('admin/services') }}">
                    <i class="fa-solid fa-table-columns"></i>  Services
                  </a>
                </li> -->

                <!-- <li class="@yield('menu_select')">
                  <a class="{{ Request::is('admin/menu') ? 'active' : null }}" href="{{ url('admin/menu') }}">
                    <i class="fa-solid fa-table-columns"></i>  Menu
                  </a>
                </li> -->

                <!-- <li class="@yield('general_configuration_select')">
                  <a class="{{ Request::is('admin/general_configuration') ? 'active' : null }}" href="{{ url('admin/general_configuration') }}">
                    <i class="fa-solid fa-table-columns"></i>  General Configuration
                  </a>
                </li> -->

                <!-- <li class="@yield('about_select')">
                  <a class="{{ Request::is('admin/about') ? 'active' : null }}" href="{{ url('admin/about') }}">
                    <i class="fa-solid fa-table-columns"></i>  About
                  </a>
                </li> -->

                <!-- <li class="@yield('contact_forms_select')">
                  <a class="{{ Request::is('admin/contact_forms') ? 'active' : null }}" href="{{ url('admin/contact_forms') }}">
                    <i class="fa-solid fa-table-columns"></i>  Contact Forms
                  </a>
                </li> -->

                <!-- <li class="@yield('contact_select')">
                  <a class="{{ Request::is('admin/contact') ? 'active' : null }}" href="{{ url('admin/contact') }}">
                    <i class="fa-solid fa-table-columns"></i>  Contact
                  </a>
                </li> -->

                <!-- <li class="@yield('setting_select')">
                  <a class="{{ Request::is('admin/setting') ? 'active' : null }}" href="{{ url('admin/setting') }}">
                    <i class="fa-solid fa-table-columns"></i>  Home Page Settings
                  </a>
                </li>

                <li class="@yield('innerpage_select')">
                  <a class="{{ Request::is('admin/innerpage_setting') ? 'active' : null }}" href="{{ url('admin/innerpage_setting') }}">
                    <i class="fa-solid fa-table-columns"></i>  InnerPage Settings
                  </a>
                </li> -->

                <!-- <li class="@yield('blog_select')">
                  <a class="{{ Request::is('admin/blog') ? 'active' : null }}" href="{{ url('admin/blog') }}">
                    <i class="fa-solid fa-table-columns"></i>  Blog
                  </a>
                </li> -->

                <!-- <li class="@yield('social_select')">
                  <a class="{{ Request::is('admin/social') ? 'active' : null }}" href="{{ url('admin/social') }}">
                    <i class="fa-solid fa-table-columns"></i>  Social
                  </a>
                </li> -->

                <!-- <li class="@yield('rating_select')">
                  <a class="{{ Request::is('admin/rating') ? 'active' : null }}" href="{{ url('admin/rating') }}">
                    <i class="fa-solid fa-table-columns"></i>  Rating
                  </a>
                </li> -->

                <!-- <li class="@yield('feature_select')">
                  <a class="{{ Request::is('admin/feature') ? 'active' : null }}" href="{{ url('admin/feature') }}">
                    <i class="fa-solid fa-table-columns"></i>  Feature
                  </a>
                </li>

                <li class="@yield('product_class_select')">
                  <a class="{{ Request::is('admin/product_class') ? 'active' : null }}" href="{{ url('admin/product_class') }}">
                    <i class="fa-solid fa-table-columns"></i>  Product Class
                  </a>
                </li>
 -->

            </ul>

            <span class="system-menu__title">system</span>
            <ul class="sidebar-body-menu">
                <li>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="extention-01.html">Extentions-01</a>
                        </li>
                        <li>
                            <a href="extention-02.html">Extentions-02</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('admin/general_configuration') }}"><i class="fa fa-cogs"></i>  General Configuration</a>
                </li>
            </ul>
        </div>
    </div>
</aside>
  <div class="main-wrapper">
    <!-- ! Main nav -->

    <nav class="main-nav--bg">
        <div class="container main-nav">
        <div class="main-nav-start">
      <!-- <div class="search-wrapper">
        <i data-feather="search" aria-hidden="true"></i>
        <input type="text" placeholder="Enter keywords ..." required>
      </div> -->
    </div>
    <div class="main-nav-end">
      <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
        <span class="sr-only">Toggle menu</span>
        <span class="icon menu-toggle--gray" aria-hidden="true"></span>
        <!-- <i class="fa-solid fa-bars"></i> -->
      </button>
   
      <div class="nav-user-wrapper">
        <button href="" class="nav-user-btn dropdown-btn" title="My profile" type="button">
          <span class="sr-only">My profile</span>
          <span class="nav-user-img">
            <picture><source srcset="./img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
          </span>
        </button>
        <ul class="users-item-dropdown nav-user-dropdown dropdown">
          <li></li>

          <li><a class="danger" href="{{ url('admin/logout') }}">
              <i data-feather="log-out" aria-hidden="true"></i>
              <span>Log out</span>
            </a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>


        
        @yield('content')

   <!-- ! Footer -->
    <footer class="footer">
      <div class="container footer--flex">
        <div class="footer-start">
            <p>2023 © Copyright All Rights Reserved. Designed and Developed by SquadCloud Team.</p>
        </div>
<!--     <ul class="footer-end">
      <li><a href="##">About</a></li>
      <li><a href="##">Support</a></li>
      <li><a href="##">Puchase</a></li>
    </ul> -->
  </div>
</footer>

<!-- Chart library -->
<script src="{{ asset('admin_assets/plugins/chart.min.js') }}"></script>
<!-- Icons library -->
<script src="{{ asset('admin_assets/plugins/feather.min.js') }}"></script>
<!-- Custom scripts -->
<script src="{{ asset('admin_assets/js/script.js') }}"></script>

<script>
    ClassicEditor
    .create( document.querySelector( '#editor3'))
    .catch( error => {
    console.error( error );
    });
 </script>  


 <script>
CKEDITOR.replace( 'editor' );
    $('.js-example-basic-multiple').select2({
      placeholder: 'Select users',
      allowClear: true
    });
</script>


<script>
CKEDITOR.replace( 'editor1' );
    $('.js-example-basic-multiple').select2({
      placeholder: 'Select users',
            'config.maxLength': 100,
      allowClear: true
    });
</script>


<script>
// CKEDITOR.replace( 'editor2' );
//    $('.js-example-basic-multiple').select2({
//      placeholder: 'Select users',
//      allowClear: true
//    });
 </script>

<script>
    CKEDITOR.replace('editor2', {
      fullPage: false,
      extraPlugins: 'docprops',
      // Disable content filtering because if you use full page mode, you probably
      // want to  freely enter any HTML content in source mode without any limitations.
      allowedContent: true,
      height: 320,
      removeButtons: 'PasteFromWord'
    });
  </script>


<script>
CKEDITOR.replace( 'editor3' );
    $('.js-example-basic-multiple').select2({
      placeholder: 'Select users',
      allowClear: true
    });
</script>


    @stack('scripts')

</body>
</html>