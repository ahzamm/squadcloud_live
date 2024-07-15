@extends('layouts/frontend')
@section('page_title', 'Terms - SquadCloud')
@section('home_select', 'active')
@section('content')

  <style>
    header#main-header {
      background: rgb(100 5 15) !important;
    }

    section#policy {
      padding-top: 150px;
      min-height: calc(100vh - 300px);
    }
  </style>
  <section id="policy" class="position-relative pb-5">
    <div class="our-portfolio-bg"></div>
    <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5 aos-init aos-animate" data-aos="zoom-in-down">

        <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5 aos-init aos-animate" data-aos="zoom-in-down">
            <img src="frontend_assets/images/title/{{ $privacy->title_image }}" alt="" style="width: 50%;">
        </div>

      </div>
      {!! $privacy->privacy !!}
    </div>
  </section>
@endsection
