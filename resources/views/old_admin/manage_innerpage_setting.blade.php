@extends('layouts/backend')
@section('page_title', 'Innerpage Setting')
@section('Innerpage Setting_select', 'active')
@section('content')


    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
        <div class="container">
        

        <section class="ftco-section">
          <div class="container">

      

          <div class="eedit-btn">
          @if($id>0)
          <h1 align="center" class="main-title">Manage Innerpage Setting</h1>
          @else
          <h1 align="center" class="main-title">Add Innerpage Setting</h1>
          @endif  
          <a href="{{ url('admin/innerpage_setting') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>
          





 
               <div class="row">
                    
                    <div class="bb-design">
                      <form class="row g-3" action="{{ route('setting.manage_innerpage_setting_process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                         <div class="col-md-6">
                            <label for="title"  class="form-label">Title</label>
                            <input id="title" value="{{ $title }}" name="title" type="text" placeholder="Enter Title" class="form-control" >     
                            @error('title')
                            <p class="text-danger text-center">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="slug"  class="form-label">Slug</label>
                            <input id="slug" value="{{ $slug }}" name="slug" type="text" placeholder="Enter Slug" class="form-control">                                            
                            @error('slug')
                            <p class="text-danger text-center">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="title_image" class="form-label">Title Image</label>
                            <input id="title_image" name="title_image" type="file" class="form-control">
                            <small>dimensions:min_width=1000,min_height=200</small>
                            @error('title_image')
                            <p class="text-danger text-center">{{$message}}</p>
                            @enderror
                        </div>
                        
                        
                        <div class="col-md-6">
                            <label for="description" class="form-label">Description</label>
                            <textarea maxlength="180" rows="5" id="editor" name="description" placeholder="Enter Description" class="form-control" >{{ $description }}</textarea>         
                            @error('description')
                            <p class="text-danger text-center">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="setting_key" class="form-label">key</label>
                            <input id="setting_key" value="{{ $setting_key }}" name="setting_key" type="text" placeholder="Enter key" class="form-control">                                            
                            @error('setting_key')
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