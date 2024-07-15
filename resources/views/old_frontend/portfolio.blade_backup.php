@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')

<style>
   header#main-header {
      background: rgb(100 5 15) !important;
   }
   section#our-portfolio {
      padding-top: 150px;
   }
  
</style>

<section id="our-portfolio" class="position-relative">
   <div class="our-portfolio-bg"></div>
   <div class="container">
      @foreach($inner_page_setting as $ourPortfolio)
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
         <img src="storage/media/innerpagesetting/{{$ourPortfolio->title_image}}"  alt="" style="width: 50%;">
         <p class="text-center">{{ $ourPortfolio->description }}</p>
      </div>
      @endforeach

      <div class="d-flex align-items-center justify-content-center flex-wrap">
         
         @forelse ($portfolios as $list)
         <div class="outer-folder" data-aos="fade-down">

            <div class="inner-folder" data-aos="zoom-in" data-aos-delay="400" style="display: flex;justify-content: center;align-items: center; background-color: #b01828;">
               <img src="storage/media/portfolio/{{$list->image}}" alt="{{ $list->heading }}" class=" d-inline-block" style="height: 220px; width: 90%; " >
            </div>
            <span class="folder-name">{{ $list->heading }}</span>

         </div>
         @empty
         <div class="alert alert-danger">No Record Found!</div>
         @endforelse
      </div>

   </div>
</section>

@endsection()