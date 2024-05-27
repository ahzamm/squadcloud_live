@extends('layouts/backend')
@section('page_title', 'product_class')
@section('product_class_select', 'active')
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
          <h1 align="center" class="main-title">Add Product Class</h1>
          @endif  
          <a href="{{ url('admin/product_class') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>







            <div class="row">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">
                      <form action="{{ route('setting.manage_product_class_process') }}" method="post" enctype="multipart/form-data" class="row g-3">      
                      @csrf      

                         <div class="col-md-6">
                          <label for="inputCity" class="form-label">Title</label>
                          <input type="text" value="{{ $title  }}" placeholder="Enter Product Class title" name="title"  class="form-control" id="inputCity">
                          @error('title')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>

                         <div class="col-md-6">
                          <label for="slug" class="form-label">Slug</label>
                          <input type="text" value="{{ $slug  }}" placeholder="Enter product_class slug" name="slug"  class="form-control" id="inputCity">
                          @error('slug')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>

                        <div class="form-group">
                          <input id="id" value="{{ $id }}" name="id" type="hidden">                                            
                        </div>

                        <div class="col-12">
                        @if($id>0)
                          <div class="red-btn"><input type="Submit" value="Update"></div>
                        @else
                          <div class="red-btn"><input type="Submit" value="Add"></div>
                        @endif
                          <!-- <a href="{{ url('admin/slider') }}">
                            <div class="red-btn"><input type="button" value="Back"></div>
                          </a> --> 
                        </div>
                      </form>
                    </div>

                  </div>
              </div>
            </div>
          </section>
        </div>
      </main>


@endsection()