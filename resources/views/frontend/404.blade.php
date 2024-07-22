@extends('layouts/frontend')
@section('page_title', '404 - SquadCloud')
@section('home_select', 'active')
@section('content')

  <style>
    header#main-header {
      background: rgb(100 5 15) !important;
    }

    section#services {
      padding-top: 150px;
    }
  </style>
  <section id="services" class="position-relative pb-5">
    <div class="our-portfolio-bg"></div>
    <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
        <img src="frontend_assets/images/404.png" alt="" style="width: 50%;">
      </div>
      <h1><span style="font-family: &quot;Arial Black&quot;;">
          <font color="#ce0000">Oops! Page Not Found</font>
        </span></h1>
      <p><br></p>
      <h3>Looks like you took a wrong turn.</h3>
      <p>Don't worry, it happens to the best of us. The page you're looking for might have been moved, deleted, or never existed.</p>
      <p><strong>Here are some helpful links instead:</strong></p>
      <ul>
        <li><a rel="noreferrer" href="/">
            <font color="#ce0000">Home</font>
          </a></li>
        <li><a rel="noreferrer" href="about">
            <font color="#ce0000">About Us</font>
          </a></li>
        <li><a rel="noreferrer" href="contact">
            <font color="#ce0000">Contact Support</font>
          </a></li>
      </ul>
    </div>
  </section>
@endsection()
