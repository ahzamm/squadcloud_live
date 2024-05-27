@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')

<style>
   body {
      height: 100vh;
   }
   header#main-header {
      background: rgb(100 5 15) !important;
   }
   section#our-portfolio {
      padding-top: 150px;
      min-height: calc(100vh - 36px);
   }
   .product-list img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    /* filter: grayscale(70%); */
    border-radius: 7px;
}

/* .product-list h3{
    font-weight: 500;
} */

.product-list p{
    font-style: italic;
    color: rgb(217, 217, 217);
    margin-bottom: 0;
    color: #961b04;
}

.product-list button{
    display: inline-block;
    width: auto; 
    padding: 0.6rem 1.5rem;
    border: 1px solid #961b04;
    background: none;
    font-weight: 400;
    border-radius: 50px;
    cursor: pointer;
    color: #961b04;
}

.product_container{
    margin: 0 auto 0 auto;
    padding-bottom: 59px;
    width: 90%;
}

.product-list{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 20px;
}

.product-list:has(.product:hover) .product:not(:hover){
    filter: grayscale(90%) blur(1px);
    opacity: 0.7;
}

.product{
    /* border: 1px solid #606060; */
    height: 300px;
    /* padding: 10px 10px 20px 10px; */
    padding-bottom: 20px;
    border-radius: 10px;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    transition: filter 0.1s ease-in-out, opacity 0.1s ease-in-out;
}

.product-list .img{
    height: 60%;
    width: 100%;
}

.product-list .info{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 0 15px;
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

      {{-- <div class="d-flex align-items-center justify-content-center flex-wrap">
         
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
      </div> --}}
      <div class="product_container">

<!-- <div class="input">
    <input type="range" min="50" max="1000" value="10" step="10" id="priceSlider" >
    <span id="sliderValue">$10</span>
</div> -->

<div class="product-list">
@forelse ($portfolios as $list)
  <div class="product" data-price="50">
    <div class="img">
        <img src="storage/media/portfolio/{{$list->image}}" alt="{{ $list->heading }}">
    </div>
    <div class="info">
        <h5>{{ $list->heading }}</h5>
        <p><i class="fa fa-heart"></i></p>
    </div>
    <button>More Info</button>
  </div>
  @empty
         <div class="alert alert-danger">No Record Found!</div>
         @endforelse
</div>

</div>
   </div>
</section>

@endsection()