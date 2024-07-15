@extends('layouts/backend')
@section('page_title', 'Setting')
@section('setting_select', 'active')
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
          <h1 align="center" class="main-title">Add Setting</h1>
          @endif  
          <a href="{{ url('admin/setting') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>




                          
              <div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">
                      <form class="row g-3" action="{{ route('setting.manage_setting_process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                         <div class="col-md-6">
                        <label for="title"  class="form-label">Title</label>
                        <input id="title" value="{{ $title }}" name="title" type="text" class="form-control" >                                            
                        @error('title')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="slug"  class="form-label">Slug</label>
                        <input id="slug" value="{{ $slug }}" name="slug" type="text" class="form-control" >                                            
                        @error('slug')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="value"  class="form-label">Value</label>
                        <textarea id="editor" rows="5" name="value" class="form-control" >{{ $value }}</textarea>         
                        @error('value')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="link"  class="form-label">Button Link</label>
                        <input id="link" value="{{ $link }}" name="link" type="link" class="form-control" >                                            
                        @error('link')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="text"  class="form-label">Key</label>
                        <input id="key" value="{{ $key }}" name="key" type="text" class="form-control" >                                            
                        @error('key')
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

      <script>

$("document").ready(function(){
    setTimeout(function(){
        $("#message_id").remove();
    }, 3000 );
});
      </script>

@endsection()