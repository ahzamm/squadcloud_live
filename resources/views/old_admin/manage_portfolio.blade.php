@extends('layouts/backend')
@section('page_title', 'Portfolio')
@section('portfolio_select', 'active')
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
          <h1 align="center" class="main-title">Add Portfolio</h1>
          @endif  
          <a href="{{ url('admin/portfolio') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>


      
                          
              <div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">
                      <form class="row g-3" action="{{ route('portfolio.manage_portfolio_process') }}" method="post" enctype="multipart/form-data">
                      @csrf

                          <div class="col-md-6">
                        <label for="heading" class="form-label">Heading</label>
                        <input id="heading" value="{{ $heading }}" name="heading" placeholder="Enter Heading" type="text" class="form-control" >     
                        @error('heading')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="description" class="form-label">Portfolio Description</label>
                        <textarea maxlength="100" id="editor" name="description" placeholder="Enter Portfolio Description" class="form-control">{{ $description }}</textarea>
                        @error('description')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>
                  
                    
                    <div class="col-md-6">
                        <label for="slug" class="form-label">Portfolio Slug</label>
                        <input id="slug" value="{{ $slug }}" name="slug" placeholder="Enter Portfolio Slug" type="text" class="form-control">                                            
                        @error('slug')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="keyword" class="form-label">Portfolio Keyword</label>
                        <input id="keyword" value="{{ $keyword }}" name="keyword" placeholder="Enter Portfolio Keyword" type="text" class="form-control" >                                            
                        @error('keyword')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="link" class="form-label">Portfolio Link</label>
                        <input type="url" id="link" name="link" placeholder="Enter Portfolio Link" value="{{ $link }}" class="form-control" />
                        @error('link')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="image" class="form-label"> Portfolio Image</label>
                        <input id="image" name="image" type="file" class="form-control">
                        <small>dimensions:max_width=285,max_height=175"</small>
                        @error('image')
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