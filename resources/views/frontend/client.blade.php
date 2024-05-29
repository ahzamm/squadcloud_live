@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')

<style>
   header#main-header {
      background: rgb(100 5 15) !important;
   }
   /* Client Section */
   section#our-client {
      padding-top: 150px;
   }

</style>

<section id="our-client" class="position-relative">
   <div class="our-portfolio-bg"></div>
   <div class="container">
       {{-- @php
               $inner_page_setting = DB::table('inner_page_settings')
               ->where([
                  ['status', '=', 1]])
                  ->where([
                  ['setting_key', '=', 'our_clients']])
                  ->get();
            @endphp --}}
            {{-- @foreach($inner_page_setting as $ourClients) --}}
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
         <img src="frontend_assets/images/title/{{$client_menu->title_image}}" alt="" style="width: 50%;">
         <p class="text-center">{!!$client_menu->tagline!!}</p>
      </div>
      {{-- @endforeach --}}

      <div class="row">
         @forelse ($clients as $client)
         <div class="col-lg-4 col-md-6">
            <div class="card" data-aos="flip-left" data-aos-duration="1000">
               <a href="{{ $client->link }}" target="_blank" class="card-client d-flex justify-content-center align-items-center" style="height: 100px">
                  <div class="clients-logo"> 
                     <img src="frontend_assets/images/clients/{{$client->logo}}"  class="p-2 d-inline-block">
                  </div>
               </a>
               <div class="card-body">
                  <p>{!! $client->description !!}</p>
               </div>
            </div>
         </div>
         @empty
         <div class="alert alert-danger">No Record Found!</div>
         @endforelse
      </div>
   </div>
</section>

@endsection()