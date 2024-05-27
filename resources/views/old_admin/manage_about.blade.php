@extends('layouts/backend')
@section('page_title', 'About')
@section('about_select', 'active')
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
          <h1 align="center" class="main-title">Add About</h1>
          @endif  
          <a href="{{ url('admin/client') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>
          
          

              <div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">
                      <form class="row g-3" action="{{ route('about.manage_about_process') }}" method="post" enctype="multipart/form-data">
                      @csrf

                       <div class="col-md-6">
                          <label for="icon_1" class="form-label">Icon 1</label>
                          <input id="icon_1" value="{{ $icon_1 }}" name="icon_1" type="file" class="form-control" >                                            
                          @error('icon_1')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      
                      <div class="col-md-6">
                          <label for="title_1" class="form-label">Title 1</label>
                          <input id="title_1" value="{{ $title_1 }}" placeholder="Enter Title 1" name="title_1" type="text" class="form-control" >                                            
                          @error('title_1')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      
                      <div class="col-md-6">
                          <label for="description_1" class="form-label">Description 1</label>
                          <textarea maxlength="80" id="editor" name="description_1" placeholder="Enter Description 1" class="form-control">{{ $description_1 }}</textarea>                                            
                          @error('description_1')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      
                      <div class="col-md-6">
                          <label for="icon_2" class="form-label">Icon 2</label>
                          <input id="icon_2" value="{{ $icon_2 }}" name="icon_2" type="file" class="form-control">
                          @error('icon_2')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <label for="title_2" class="form-label">Title 2</label>
                          <input id="title_2" value="{{ $title_2 }}" placeholder="Enter Title 2" name="title_2" type="text" class="form-control" >                                            
                          @error('title_2')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <label for="description_2" class="form-label">Description 2</label>
                          <textarea maxlength="120" id="editor2" name="description_2" placeholder="Enter Description 2" class="form-control">{{ $description_2 }}</textarea>                                            
                          @error('description_2')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <label for="icon_3" class="form-label">Icon 3</label>
                          <input id="icon_3" value="{{ $icon_3 }}" name="icon_3" type="file" class="form-control">
                          @error('icon_3')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <label for="title_3" class="form-label">Title 3</label>
                          <input id="title_3" value="{{ $title_3 }}" placeholder="Enter Title 3" name="title_3" type="text" class="form-control" >                                            
                          @error('title_3')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <label for="description_3" class="form-label">Description</label>
                          <textarea maxlength="120" id="editor3" name="description_3" placeholder="Enter Description" class="form-control">{{ $description_3 }}</textarea>                                             
                          @error('description_3')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <label for="slug" class="form-label">Slug</label>
                          <input id="slug" value="{{ $slug }}" placeholder="Enter Slug" name="slug" type="text" class="form-control">
                          @error('slug')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <label for="video_url" class="form-label">Video</label>
                          <input id="video_url" value="{{ $video_url }}" placeholder="Enter Video" name="video_url" type="url" class="form-control" >                                            
                          @error('video_url')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <label for="main_description" class="form-label">Main Description</label>
                          <textarea maxlength="180" id="editor4" name="main_description" placeholder="Enter Main Description" class="form-control">{{ $main_description }}</textarea>                                           
                          @error('main_description')
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