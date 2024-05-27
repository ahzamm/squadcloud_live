@extends('layouts/backend')
@section('page_title', 'Header')
@section('header_select', 'active')
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
          <h1 align="center" class="main-title">Header</h1>
          @endif  
          <a href="{{ url('admin/header') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>

 
               <div class="row">
                    <div class="bb-design">
                      
                    <form class="row g-3" action="{{ route('setting.manage_header_process') }}" method="post" enctype="multipart/form-data">
                    @csrf
                   
                        <div class="col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input id="title"  maxlength="10"  value="{{ $title }}" name="title" placeholder="Enter Title" type="text" class="form-control">
                        @error('title')
                         <p class="text-danger text-center">{{$message}}</p>
                         @enderror
                        </div>
                       
                        <div class="col-md-6">
                        <label for="slug" class="form-label">Slug</label>
                        <input id="slug" value="{{ $slug }}" name="slug" placeholder="Enter Slug" type="text" class="form-control" >     
                        @error('slug')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="sub_title" class="form-label">Sub Title</label>
                        <input id="sub_title" value="{{ $sub_title }}" name="sub_title" placeholder="Enter Sub Title" type="text" class="form-control" >     
                        @error('sub_title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" placeholder="Enter Description" class="form-control" >{{ $description }}</textarea>                                           
                        @error('description')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                        </div>

                         <div class="col-md-4">
                         <label for="image" class="form-label">Header Image 1</label>
                         <input id="img_1" name="img_1" type="file" class="form-control">
                         <small>dimensions:min_width=550,min_height=420</small>
                         @error('img_1')
                         <p class="text-danger text-center">{{$message}}</p>
                         @enderror
                        </div>


                        <div class="col-md-4">
                        <label for="image" class="form-label">Header Image 2</label>
                       <input id="img_2" name="img_2" type="file" class="form-control">
                      <small>dimensions:min_width=400,min_height=300</small>
                       @error('img_2')
                      <p class="text-danger text-center">{{$message}}</p>
                       @enderror
                        </div>

                        <div class="col-md-4">
                        <label for="image" class="form-label">Header Image 3</label>
                       <input id="img_3" name="img_3" type="file" class="form-control">
                       <small>dimensions:min_width=400,min_height=300</small>
                       @error('img_3')
                       <p class="text-danger text-center">{{$message}}</p>
                       @enderror
                        </div>


                        <div class="col-md-4">
                        <label for="image" class="form-label">Header Image 4</label>
                      <input id="img_4" name="img_4" type="file" class="form-control">
                      <small>dimensions:min_width=400,min_height=300</small>
                      @error('img_4')
                      <p class="text-danger text-center">{{$message}}</p>
                      @enderror
                    </div>

                        <div class="col-md-4">
                        <label for="display_order" class="form-label">Display Order</label>
                      <input id="display_order" value="{{ $display_order }}" name="display_order" placeholder="Enter Display Order" type="number" class="form-control" >                                            
                      @error('display_order')
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
        
                          </div>
                        </a>
                          
                          
                        </div>
                      </form>
                    </div>
                  </div>
                </section>
              </div>
              </main>

@endsection()