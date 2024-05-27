@extends('layouts/backend')
@section('page_title', 'social')
@section('social_select', 'active')
@section('content')



        <!-- ! Main -->
        <main class="main users chart-page" id="skip-target">
        <div class="container">
        

        <section class="ftco-section">
        <div class="container">

      

          <div class="eedit-btn">
          @if($id>0)
          <h1 align="center" class="main-title">Manage Product</h1>
          @else
          <h1 align="center" class="main-title">Add Social</h1>
          @endif  
          <a href="{{ url('admin/social') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>






 
               <div class="row">
                <!-- <main class="main users chart-page" id="skip-target">
                  <div class="container"> -->
                    <!-- <h1 align="center" class="main-title">Form</h1> -->

                    <div class="bb-design">

                      <form action="{{ route('social.manage_social_process') }}" method="post" enctype="multipart/form-data" class="row g-3">
                         
                      @csrf
                        
                         <div class="col-md-6">
                          <label for="title" class="form-label">Social Title</label>
                          <input type="text" value="{{ $title  }}" placeholder="Enter Social Title" name="title"  class="form-control" id="inputCity">
                          @error('title')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>


                         <div class="col-md-6">
                          <label for="link" class="form-label">Social Link</label>
                          <input type="text" value="{{ $link  }}" placeholder="Enter Social link" name="link"  class="form-control" id="inputCity">
                          @error('link')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>



                        <div class="col-md-6">
                          <label for="inputEmail4" class="form-label">Social Image</label>
                          <input type="file"  placeholder="image" name="image"  class="form-control" id="inputEmail4" >
                          @error('image')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                        </div>



                        <div class="form-group">
                          <input id="id" value="{{ $id }}" name="id" type="hidden">                                            
                            </div>
                          <div>
                          @if($id>0)
                          <div class="red-btn">
                        <input type="Submit" value="update">
                        
                        </div>
                          @else
                          <div class="red-btn">
                        <input type="Submit" value="Add">
                        </div>
                          @endif
                          <!-- <a href="{{ url('admin/slider') }}">
                          <div class="red-btn">
                          <input type="button" value="Back">
                          </div>
                          </a>  -->
                       </div>
                      </form>
                    </div>
                  </div>
                  </section>
              </div>
              </main>


@endsection()