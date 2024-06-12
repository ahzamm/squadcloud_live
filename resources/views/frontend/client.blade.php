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
      min-height: 100vh;
   }
   .client-list {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap; /* Add this line */
}
        .client-list .hex-container {
            position: relative;
            width: 175px;
            height: 152px;
        }
        .client-list .hex-container:before{
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .client-list .client-btn {
            position: absolute;
            top: 34%;
            left: 20%;
            display: none;
        }
        .client-btn .client_links {
            display: block;
            margin-bottom: 5px;
    text-decoration: none;
    background: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 10px 10px 26px -2px rgba(0, 0, 0, 52%) inset;
        }
        .client-list .hex-container:hover .hex{

            background-color:rgb(178 24 40);
        }
        .client-list .hex-container:hover .svg--img{
             display: none;
        }
        .client-list .hex-container:hover .client-btn {
            display: block;
        }
        .client-list .hex {
            position: relative;
            margin: .5em auto;
            width: 6em;
            height: 10.32em;
            border-radius: .5em / .3em;
            background: white;
            transition: opacity .5s;
            transform: rotate(90deg);
            transition: .5s ease;
        }
        .client-list .hex:before, .hex:after {
            position: absolute;
            width: inherit;
            height: inherit;
            border-radius: inherit;
            background: inherit;
            content: '';
        }
        .client-list .hex:before {
            -webkit-transform: rotate(60deg);
            transform: rotate(60deg);
        }
        .client-list .hex:after {
            -webkit-transform: rotate(-60deg);
            transform: rotate(-60deg);
        }
        .client-list .svg--img {
            transform: translate(-50%, -50%);
            width: 60%;
            position: absolute;
            left: 50%;
            top: 50%;
        }

</style>

<section id="our-client" class="position-relative">
   <div class="our-portfolio-bg"></div>
   <div class="container">


      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
         <img src="frontend_assets/images/title/{{$client_menu->title_image}}" alt="" style="width: 50%;">

      </div>


      <div class="row">




        @php
    $row = 0;
@endphp

@foreach($clients as $index => $client)
    @if($index % 9 == 0 || $index % 9 == 5)
        @php
            $row++;
        @endphp
        <div class="client-list"> <!-- Start new row for indices 0, 5, 9, 14, etc. -->
    @endif

    <div class="position-relative hex-container">
        <div class="hex"></div>
        <img src="frontend_assets/images/clients/{{ $client->logo }}" alt="App" class="svg--img">
        <div class="client-btn">
            <a href="#" class="client_links">Visit Site</a>
            <a href="#" class="client_links">More Info</a>
        </div>
    </div>

    @if($index % 9 == 4 || $index % 9 == 8)
        </div> <!-- Close row for indices 4, 8, 13, 18, etc. -->
    @endif
@endforeach

@if(count($clients) % 9 != 4 && count($clients) % 9 != 8)
    </div> <!-- Close the client-list div if there are remaining clients -->
@endif








   </div>
</section>

@endsection()
