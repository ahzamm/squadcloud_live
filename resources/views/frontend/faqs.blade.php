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

  {{--<section id="about" class="position-relative pb-5">
    <div class="our-portfolio-bg"></div>
    <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
        <div class="gallery">
          {!! $term->terms !!}
        </div>
      </div>
    </div>
  </section>--}}

  <section id="policy" class="position-relative pb-5">
    <div class="our-portfolio-bg"></div>
    <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5 aos-init aos-animate" data-aos="zoom-in-down">
          <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5 aos-init aos-animate" data-aos="zoom-in-down">
            <h1>FAQs</h1>
            @foreach ($faqs as $faq)
            <h4>Question:</h4> <br> {!! $faq->question !!} <br>
            <h4>Answer:</h4> <br> {!! $faq->answer !!} <br>

            @endforeach
            <!-- <img src="frontend_assets/images/title/ySH3hslrZoU9IBgjkHxyeuSvlwP6NSTnGvHWSNTK.png" alt="" style="width: 50%;"> -->
          </div>
      </div>
    </div>
  </section>
@endsection
