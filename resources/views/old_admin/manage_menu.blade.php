@extends('layouts/backend')
@section('page_title', 'Menu')
@section('menu_select', 'active')
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
          <h1 align="center" class="main-title">Add Menu</h1>
          @endif  
          <a href="{{ url('admin/menu') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>

                               
              <div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">
                      <form class="row g-3" action="{{ route('menu.manage_menu_process') }}" method="post" enctype="multipart/form-data">
                      @csrf

                       <div class="col-md-6">
                         <label for="menu_name"class="form-label">Menu Name</label>
                         <input id="menu_name" value="{{ $menu_name }}" name="menu_name" placeholder="Enter Menu Name" type="text" class="form-control" required> 
                          @error('menu_name')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>

                        <div class="col-md-6">
                        <label for="menu_slug" class="form-label">Menu Slug</label>
                        <input id="menu_slug" value="{{ $menu_slug }}" name="menu_slug" placeholder="Enter Menu Slug" type="text" class="form-control" required>
                          @error('menu_slug')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="link" class="form-label">Menu Link</label>
                        <input id="link" value="{{ $link }}" name="link" placeholder="Enter Menu Link" type="text" class="form-control" required> 
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
                          <!-- <a href="{{ url('admin/menu') }}">
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