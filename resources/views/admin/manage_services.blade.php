@extends('layouts/backend')
@section('page_title', 'Services')
@section('services_select', 'active')
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
          <h1 align="center" class="main-title">Add Service</h1>
          @endif  
          <a href="{{ url('admin/services') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>

                               
              <div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">
                      <form class="row g-3" action="{{ route('services.manage_services_process') }}" method="post" enctype="multipart/form-data">
                      @csrf

                        <div class="col-md-6">
                            <label for="heading" class="form-label">Service Heading</label>
                            <input id="heading" value="{{ $heading }}" name="heading" placeholder="Enter Service Heading" type="text" class="form-control">                                            
                            @error('heading')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="slug" class="form-label">Service Slug</label>
                            <input id="slug" value="{{ $slug }}" name="slug" placeholder="Enter Service Slug" type="text" class="form-control">                                            
                            @error('slug')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="description" class="form-label">Service Description</label>
                            <textarea id="spaceId" maxlength="100" name="description" placeholder="Enter Service Description" class="form-control">{{ $description }}</textarea>
                            <p>max:100 character</p>
                            @error('description')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="icon" class="form-label">Service Icon</label>
                            <input id="icon" name="icon" type="file" class="form-control">
                            <small>dimensions:min_width=110,min_height=120,max_width=230,max_height=230</small>                                            
                            @error('icon')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="keyword" class="form-label">Service Keyword</label>
                            <input id="keyword" value="{{ $keyword }}" name="keyword" placeholder="Enter Service Keyword" type="text" class="form-control tagsinput" data-a-sign="$" data-role="tagsinput">                                            
                            @error('keyword')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="text_field" class="form-label">text_field</label>
                            <textarea id="editor2" name="text_field" placeholder="Enter text_field" class="form-control">{{ $text_field }}</textarea>
                            @error('text_field')
                            <p class="text-danger">{{$message}}</p>
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
                          <!-- <a href="{{ url('admin/services') }}">
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