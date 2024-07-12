@extends('layouts/frontend')
@section('page_title', 'Terms - SquadCloud')
@section('home_select', 'active')
@section('content')

  <section id="about" class="position-relative pb-5">
    <div class="our-portfolio-bg"></div>
    <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
        <div class="gallery">
          {!! $privacy->privacy !!}
        </div>
      </div>
    </div>
  </section>
@endsection
