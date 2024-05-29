@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')

<style>
      header#main-header {
         background: rgb(100 5 15) !important;
      }
      
   </style>

   <div class="jumbotron position-relative">
      <div class="bgopacty"></div>
      <div class="mt-5 jumbotron-content">
         <h2 class="text-center fs-1  graphic" data-aos="zoom-in-down">{{$service->service}}</h2>
         <p class="text-center text-white" data-aos="zoom-in-up">{!!$service->tagline!!}</p>
         
      </div>
   </div>

   <section id="service-inner" class="position-relative pb-5">
      {!!$service->description!!}
   </section>

   	


   @endsection()