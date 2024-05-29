@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')

<style>
   header#main-header {
      background: rgb(100 5 15) !important;
   }


   /* Product Section */
   section#products {
      padding-top: 150px;
   }

</style>

<section id="products" class="position-relative pb-5" style="min-height: 100vh;">
   <div class="our-portfolio-bg"></div>
   <div class="container">
      {{-- @foreach($inner_page_setting as $ourproducts) --}}
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
         <img src="frontend_assets/images/title/{{$product_menu->title_image}}" alt="" style="width: 50%;">
         <p class="text-center">{!! $product_menu->tagline !!}</p>
      </div>
      {{-- @endforeach --}}

      <div class="row">
         @foreach ($products as $product)
         <div class="col-lg-6 mb-5">
            <div class="d-flex single-product">
               <div class="img--left position-relative" data-aos="fade-up" data-aos-duration="1000">
                  <div class="page-shading" data-aos="fade" data-aos-delay="200"></div>
                  <div class="overflow-hidden">
                     <a href="{{ url('/product/' . $product->id) }}">
                     <img src="frontend_assets/images/products/{{$product->image}}" alt="{{ $product->name }}" data-aos="fade-right" data-aos-duration="1000"></a>
                  </div>
               </div>

               <div class="content-right">
                  <div class="d-flex flex-column">
                     <div class="product--title" data-aos="fade-up" data-aos-duration="1000"><p><a href="{{ url('/product/' . $product->id) }}">{{$product->name}}</span></a></p></div>
                     <div class="product--rating" data-aos-delay="100" data-aos-duration="1000">
                        <div class="number-part d-inline-block" data-aos="fade-right">{{$product->rating}}</div>
                        <div class="star-part d-inline-block" data-aos="fade-left">
                           <i class="fa fa-star" data-aos="zoom-in" data-aos-delay="400" data-aos-duration="500"></i>
                           <i class="fa fa-star" data-aos="zoom-in" data-aos-delay="500" data-aos-duration="500"></i>
                           <i class="fa fa-star" data-aos="zoom-in" data-aos-delay="600" data-aos-duration="500"></i>
                           <i class="fa fa-star" data-aos="zoom-in" data-aos-delay="700" data-aos-duration="500"></i>
                           <i class="fa fa-star star" data-aos="zoom-in" data-aos-delay="800" data-aos-duration="500"></i>
                        </div>
                     </div>
                     <div class="rating-review-text" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">{{$product->rating_number}} Reviews and Ratings</div>
                     <div class="product-detail" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                        <p class="para-text">{!! $product->short_description !!}</p>
                     </div>
                     <div class="product-buttons" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                        <a href="{{$product->link}}" class="btn btn-demo cs-padding">View Demo</a>
                        <a href="#" class="btn btn-project cs-padding">Buy Now</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>

@endsection()
