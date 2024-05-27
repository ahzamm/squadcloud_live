@extends('layouts/backend')
@section('page_heading_1', 'contact')
@section('contact_select', 'active')
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
          <h1 align="center" class="main-title">Add Contact</h1>
          @endif  
          <a href="{{ url('admin/contact') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>
                          
              <div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">
                      <form class="row g-3" action="{{ route('contact.manage_contact_process') }}" method="post" enctype="multipart/form-data">
                      @csrf

                     <div class="col-md-6">
                          <label for="heading_1" class="form-label">Heading 1</label>
                          <input type="text" value="{{ $heading_1  }}" placeholder="Enter contact heading_1" name="heading_1"  class="form-control" id="inputCity">
                          @error('heading_1')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>


                         <div class="col-md-6">
                          <label for="heading_2" class="form-label">Heading 2</label>
                          <input type="text"  minlength="28" maxlength="33" value="{{ $heading_2  }}" placeholder="Enter contact heading 2" name="heading 2"  class="form-control" id="inputCity">
                          @error('heading_2')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>

                         <div class="col-md-6">
                          <label for="slug" class="form-label">slug</label>
                          <input type="text" value="{{ $slug  }}" placeholder="Enter contact slug" name="slug"  class="form-control" id="inputCity">
                          @error('slug')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>

                         <div class="col-md-6">
                          <label for="url" class="form-label">Map Url</label>
                          <input type="text" value="{{ $url  }}" placeholder="https://www.google.com/maps/embed?pb=!1m..." name="url"  class="form-control" id="inputCity">
                          @error('url')
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
                          <!-- <a href="{{ url('admin/contact') }}">
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