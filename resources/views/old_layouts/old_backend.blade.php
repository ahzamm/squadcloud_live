<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Title Page-->
    <title>@yield('page_title')</title>

    <!-- Favicon -->
   <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend_assets/images/favicon/apple-touch-icon.png') }}">
   <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend_assets/images/favicon/favicon-32x32.png') }}">
   <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend_assets/images/favicon/favicon-16x16.png') }}">
   

   <link rel="shortcut icon" href="{{ asset('frontend_assets/images/favicon/favicon.ico') }}" />
   <!-- Fav end -->

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin_assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">


    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin_assets/css/theme.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" media="all">
 
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a href="{{ url('admin/dashboard') }}" class="logo">
                            <img src="{{ Config::get('constants.SITE_LOGO') }}" style="width: 180px; height: 52px;" alt="Logo">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="@yield('dashboard_select')">
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            </a>
                        </li>
                        <li class="@yield('slider_select')">
                            <a href="{{ url('admin/slider') }}">
                                <i class="fas fa-list"></i>Slider</a>
                            </a>
                        </li>
                        <li class="@yield('header_select')">
                            <a href="{{ url('admin/header') }}">
                                <i class="fas fa-list"></i>Header</a>
                            </a>
                        </li>
                        <li class="@yield('client_select')">
                            <a href="{{ url('admin/client') }}">
                                <i class="fas fa-list"></i>Client</a>
                            </a>
                        </li>
                        <li class="@yield('product_select')">
                            <a href="{{ url('admin/product') }}">
                                <i class="fas fa-list"></i>Product
                            </a>
                        </li>

                        <li class="treeview">
                <a href="#">
                    <i class="fa fa-bars"></i> <span>hello</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/home_slider') ? 'active' : null }}"><a href="/admin/home_slider"><i class="fa fa-circle-o"></i> Home Slider </a></li>

                    <li class="{{ Request::is('admin/home_banner') ? 'active' : null }}"><a href="/admin/home_banner"><i class="fa fa-circle-o"></i> Home Banner </a></li>
                </ul>
            </li>

                        <li class="@yield('portfolio_select')">
                            <a href="{{ url('admin/portfolio') }}">
                                <i class="fas fa-list"></i>Portfolio
                            </a>
                        </li>
                        
                        <li class="@yield('services_select')">
                            <a href="{{ url('admin/services') }}">
                                <i class="fas fa-list"></i>Services
                            </a>
                        </li>
                        
                        <li class="@yield('menu_select')">
                            <a href="{{ url('admin/menu') }}">
                                <i class="fas fa-list"></i>Menu
                            </a>
                        </li>

                        <li class="@yield('general_configuration_select')">
                            <a href="{{ url('admin/general_configuration') }}">
                                <i class="fas fa-list"></i>General Configuration
                            </a>
                        </li>

                        <li class="@yield('about_select')">
                            <a href="{{ url('admin/about') }}">
                                <i class="fas fa-list"></i>About</a>
                            </a>
                        </li>
                        <li class="@yield('contact_select')">
                            <a href="{{ url('admin/contact') }}">
                                <i class="fas fa-list"></i>Contact</a>
                            </a>
                        </li>

                        <li class="@yield('contact_form_select')">
                            <a href="{{ url('admin/contact_forms') }}">
                                <i class="fas fa-list"></i>Contact Form</a>
                            </a>
                        </li>



                        <li class="@yield('setting_select')">
                            <a href="{{ url('admin/setting') }}">
                                <i class="fas fa-list"></i>Home Page Settings</a>
                            </a>
                        </li>

                        <li class="@yield('innerpage_setting_select')">
                            <a href="{{ url('admin/innerpage_setting') }}">
                                <i class="fas fa-list"></i>Inner Page Settings</a>
                            </a>
                        </li>

                        <li class="@yield('blog_select')">
                            <a href="{{ url('admin/blog') }}">
                                <i class="fas fa-list"></i>Blog
                            </a>
                        </li>

                        <li class="@yield('servicepage_select')">
                            <a href="{{ url('admin/servicepage') }}">
                                <i class="fas fa-list"></i>Service Page
                            </a>
                        </li>
                        <li class="@yield('innerservice_select')">
                            <a href="{{ url('admin/innerservice') }}">
                                <i class="fas fa-list"></i>Inner Service Page
                            </a>
                        </li>

                        <li class="@yield('social_select')">
                            <a href="{{ url('admin/social') }}">
                                <i class="fas fa-list"></i>Social</a>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{ url('admin/dashboard') }}">
                    <img src="{{ Config::get('constants.SITE_LOGO') }}" alt="Logo">
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dashboard_select')">
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            </a>
                        </li>
                        <li class="@yield('slider_select')">
                            <a href="{{ url('admin/slider') }}">
                                <i class="fas fa-list"></i>Slider</a>
                            </a>
                        </li>
                        <li class="@yield('header_select')">
                            <a href="{{ url('admin/header') }}">
                                <i class="fas fa-list"></i>Header</a>
                            </a>
                        </li>
                        <li class="@yield('client_select')">
                            <a href="{{ url('admin/client') }}">
                                <i class="fas fa-list"></i>Client</a>
                            </a>
                        </li>
                        <li class="@yield('product_select')">
                            <a href="{{ url('admin/product') }}">
                                <i class="fas fa-list"></i>Product
                            </a>
                        </li>

                        <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-bars"></i> <span>hello</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/home_slider') ? 'active' : null }}"><a href="/admin/home_slider"><i class="fa fa-circle-o"></i> Home Slider </a></li>

                    <li class="{{ Request::is('admin/home_banner') ? 'active' : null }}"><a href="/admin/home_banner"><i class="fa fa-circle-o"></i> Home Banner </a></li>
                </ul>
            </li> -->

            <div class="dropdown">
  <button class="dropbtn">Dropdown</button>
  <div class="dropdown-content">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
</div>

                        <li class="@yield('portfolio_select')">
                            <a href="{{ url('admin/portfolio') }}">
                                <i class="fas fa-list"></i>Portfolio
                            </a>
                        </li>
                        
                        <li class="@yield('services_select')">
                            <a href="{{ url('admin/services') }}">
                                <i class="fas fa-list"></i>Services
                            </a>
                        </li>
                        
                        <li class="@yield('menu_select')">
                            <a href="{{ url('admin/menu') }}">
                                <i class="fas fa-list"></i>Menu
                            </a>
                        </li>

                        <li class="@yield('general_configuration_select')">
                            <a href="{{ url('admin/general_configuration') }}">
                                <i class="fas fa-list"></i>General Configuration
                            </a>
                        </li>

                        <li class="@yield('about_select')">
                            <a href="{{ url('admin/about') }}">
                                <i class="fas fa-list"></i>About</a>
                            </a>
                        </li>
                        <li class="@yield('contact_select')">
                            <a href="{{ url('admin/contact') }}">
                                <i class="fas fa-list"></i>Contact</a>
                            </a>
                        </li>

                        <li class="@yield('contact_form_select')">
                            <a href="{{ url('admin/contact_forms') }}">
                                <i class="fas fa-list"></i>Contact Form</a>
                            </a>
                        </li>
                        
                        <li class="@yield('setting_select')">
                            <a href="{{ url('admin/setting') }}">
                                <i class="fas fa-list"></i>Home Page Settings</a>
                            </a>
                        </li>

                        <li class="@yield('innerpage_setting_select')">
                            <a href="{{ url('admin/innerpage_setting') }}">
                                <i class="fas fa-list"></i>Inner Page Settings</a>
                            </a>
                        </li>

                        <li class="@yield('blog_select')">
                            <a href="{{ url('admin/blog') }}">
                                <i class="fas fa-list"></i>Blog
                            </a>
                        </li>

                        <li class="@yield('servicepage_select')">
                            <a href="{{ url('admin/servicepage') }}">
                                <i class="fas fa-list"></i>Service Page
                            </a>
                        </li>
                        <li class="@yield('innerservice_select')">
                            <a href="{{ url('admin/innerservice') }}">
                                <i class="fas fa-list"></i>Inner Service Page
                            </a>
                        </li>

                        <li class="@yield('social_select')">
                            <a href="{{ url('admin/social') }}">
                                <i class="fas fa-list"></i>Social</a>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button">
            
                                <div class="account-wrap">
                                    <a href="{{ url('admin/logout') }}">
                                        Logout</a>
                                    <div class="account-item clearfix js-item-menu">
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
        
        @yield('content')

        </div>

    

    </div>

    <!-- Jquery JS-->
    <script src="vendors/scripts/core.js"></script>
    <!--<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>-->
    <!--<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>-->
    <!-- <script src="https://cdn.ckeditor.com/4.20.1/standard-all/ckeditor.js"></script> -->
    <script src="https://github.com/xing/wysihtml5"></script>
    <script src="{{ asset('admin_assets/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- <script src="https://cdn.ckeditor.com/4.20.1/standard-all/ckeditor.js"></script> -->
    <!-- <script src="{{ asset('admin_assets/ckeditor/ckeditor.js') }}"></script> -->

 
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
// 		$('.js-example-basic-multiple').select2({
// 			placeholder: 'Select users',
// 			allowClear: true
// 		});


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



    
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin_assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/wow/wow.min.js') }}"></script>
    <!-- Main JS-->
    <script src="{{ asset('admin_assets/js/main.js') }}"></script>
    <script src="{{ asset('admin_assets/jquery.dataTables.min.js') }}"></script>
    <!-- <script src="{{ asset('admin_assets/js/ckeditor.js') }}"></script> -->
   
    

    @stack('scripts')

</body>

</html>
<!-- end document-->