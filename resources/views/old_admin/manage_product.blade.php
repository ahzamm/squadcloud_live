@extends('layouts/backend')
@section('page_title', 'Product')
@section('product_select', 'active')
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
          <h1 align="center" class="main-title">Add Product</h1>
          @endif  
          <a href="{{ url('admin/product') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>

        
          <!-- <input type="" value="Back"> -->
                          
              <div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">
                      <form class="row g-3" action="{{ route('product.manage_product_process') }}" method="post" enctype="multipart/form-data">
                      @csrf

                       <div class="col-md-6">
                        <label for="title" class="form-label">Title 1</label>
                        <input type="text"  maxlength="13" value="{{ $product_name }}" placeholder="Enter Title 1" name="product_name" class="form-control" id="product_name">
                        @error('product_name')
                          <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                       </div>

                        <div class="col-md-6">
                          <label for="title" class="form-label">Title 2</label>
                          <input type="text" maxlength="13" value="{{ $product_name_2 }}" placeholder="Enter Title 2" name="product_name_2" class="form-control" id="product_name_2">
                          @error('product_name_2')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror  
                        </div>

                        <div class="form-outline col-md-6">
                          <label for="slug" class="form-label">Slug</label>
                          <input type="text" value="{{ $slug }}" placeholder="Enter Slug" name="slug"  class="form-control" id="slug" >
                          @error('slug')
                            <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="description" class="form-label">Short Description</label>
                        <textarea maxlength="50" id="editor2" name="short_description" placeholder="Enter Short Description" class="form-control" >{{ $short_description }}</textarea>                                           
                        @error('short_description')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                      <label for="description" class="form-label">Long Description</label>
                      <textarea maxlength="100" id="editor3" name="long_description" placeholder="Enter Long Description" class="form-control" >{{ $long_description }}</textarea>                                           
                      @error('long_description')
                      <p class="text-danger text-center">{{$message}}</p>
                      @enderror
                  </div>

                     <div class="col-md-6">
                    <label for="image" class="form-label">Product Image 1</label>
                    <input id="img_1" value="{{ $img_1 }}" name="img_1" type="file" class="form-control">
                    @error('img_1')
                    <p class="text-danger text-center">{{$message}}</p>
                    @enderror
                    </div>

                    <div class="col-md-6">
                    <label for="image" class="form-label">Product Screenshot 1</label>
                    <input id="img_2" value="{{ $img_2 }}" name="img_2" type="file" class="form-control">
                    @error('img_2')
                    <p class="text-danger text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">Product Screenshot 2</label>
                    <input id="img_3" value="{{ $img_3 }}" name="img_3" type="file" class="form-control">
                    @error('img_3')
                    <p class="text-danger text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">Product Screenshot 3</label>
                    <input id="img_4" value="{{ $img_4 }}" name="img_4" type="file" class="form-control">
                    @error('img_4')
                    <p class="text-danger text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">Product Image 2</label>
                    <input id="img_5" value="{{ $img_5 }}" name="img_5" type="file" class="form-control">
                    @error('img_5')
                    <p class="text-danger text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="product_class_id" class="form-label">Product Class</label>
                    <select name="product_class_id" id="product_class_id" class="form-select">
                        <option value="" disabled>Select Product Class</option>
                        @foreach($productclass as $item)
                            <option value="{{ $item->id }}" @if($item->id == $id) selected @endif>{{ $item->title }}</option>
                        @endforeach
                    </select>
                    @error('product_class_id')
                        <p class="text-danger text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input id="price" value="{{ $price }}" name="price" placeholder="Enter Price" type="text" class="form-control" >                                            
                    @error('price')
                    <p class="text-danger text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="description" class="form-label">Price Description</label>
                    <textarea maxlength="40" id="price_description" name="price_description" placeholder="Enter Price Description" class="form-control" >{{ $price_description }}</textarea>                                           
                    @error('price_description')
                    <p class="text-danger text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="features" class="form-label">Features</label>
                    <textarea id="editor" name="features" placeholder="Enter Features" class="form-control">{{ $features }}</textarea>
                    @error('features')
                    <p class="text-danger text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="link" class="form-label">Product Link</label>
                    <input type="url" value="{{ $link }}" id="link" name="link" placeholder="Enter Product Link" value="{{ $link }}" class="form-control" />
                    @error('link')
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
                </main>
              </div>
            </div>
          </section>
          <div class="row">


          </div>
        </div>
      </main>


@endsection()