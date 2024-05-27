@extends('layouts/backend')
@section('page_title', 'Blog')
@section('blog_select', 'active')
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
          <h1 align="center" class="main-title">Add Blog</h1>
          @endif  
          <a href="{{ url('admin/blog') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>


      
                          
              <div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">
                      <form class="row g-3" action="{{ route('blog.manage_blog_process') }}" method="post" enctype="multipart/form-data">
                      @csrf

                      
                      <div class="col-md-6">
                          <label for="title" class="form-label">Blog Title</label>
                          <input id="title" value="{{ $title }}" name="title" placeholder="Enter Blog Title" type="text" class="form-control" >                                            
                          @error('title')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      
                      <div class="col-md-6">
                          <label for="description" class="form-label">Blog Description</label>
                          <textarea id="editor" name="description" placeholder="Enter Blog Description" class="form-control">{{ $description }}</textarea>
                          @error('description')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                    
                      <div class="col-md-6">
                          <label for="writer" class="form-label">Blog Writer</label>
                          <input id="writer" value="{{ $writer }}" name="writer" placeholder="Enter Blog Writer" type="text" class="form-control" > 
                          @error('writer')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      
                      <div class="col-md-6">
                          <label for="keyword" class="form-label">Blog Keyword</label>
                          <input id="keyword" value="{{ $keyword }}" name="keyword" placeholder="Enter Blog Keyword" type="text" class="form-control" >
                          @error('keyword')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      
                      <div class="col-md-6">
                          <label for="image" class="form-label">Blog Image</label>
                          <input id="image" name="image" type="file" class="form-control">
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
                          <!-- <a href="{{ url('admin/blog') }}">
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