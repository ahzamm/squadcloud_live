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
   .client-list {
            display: flex;
            align-items: center;
            justify-content: center;

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
      <div class="client-list">
         @forelse ($clients as $client)
         {{-- <div class="col-lg-4 col-md-6">
            <div class="card" data-aos="flip-left" data-aos-duration="1000">
              <a href="{{ $client->link }}" target="_blank" class="card-client d-flex justify-content-center align-items-center" style="height: 100px">
                <div class="clients-logo">
                  <img src="frontend_assets/images/clients/{{$client->logo}}" class="p-2 d-inline-block">
                </div>
              </a>
              <div class="card-body" style=" display: flex;
              justify-content: center;
              align-items: center;
              height: 100%;">
                <!-- <p><b><h5>{!! substr($client->title, 0, 20) !!}</h5></b></p> -->
              </div>
            </div>
          </div> --}}

            <div class="position-relative hex-container">
               <div class="hex"></div>
               <img src="frontend_assets/images/clients/{{$client->logo}}" alt="App" class="svg--img">
               <div class="client-btn">
                  <a href="{{ $client->link }}" class="client_links">Visit Site</a>
                  <a href="#" class="client_links">More Info</a>
               </div>
            </div>



         @empty
         <div class="alert alert-danger">No Record Found!</div>
         @endforelse
         </div>
      </div>
   </div>
</section>

@endsection()
