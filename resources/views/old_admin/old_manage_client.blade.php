@extends('layouts/backend')
@section('page_title', 'client')
@section('client_select', 'active')
@section('content')


<div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">


                    <a href="{{ url('admin/client') }}">
                          <div class="red-btn">
                          <input type="button" value="Back">
                          </div>
                      </a> 

                      <form action="{{ route('client.manage_client_process') }}" method="post" enctype="multipart/form-data" class="row g-3">
                         @csrf
                         <div class="col-md-6">
                          <label for="inputCity" class="form-label">Main Heading</label>
                          <input type="text" value="{{ $heading  }}" placeholder="Enter Main Heading" name="heading"  class="form-control" id="inputCity">
                          @error('heading')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>

                        <div class="col-md-6">
                          <label for="inputPassword4" class="form-label">Main Description</label>
                          <input type="text" value="{{ $description }}" placeholder="Enter Main Description" name="description" class="form-control" id="inputPassword4">
                          @error('description')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                        </div>

                        <div class="col-md-6">
                          <label for="inputCity" class="form-label">client link</label>
                          <input type="text" value="{{ $link }}" placeholder="Enter client link" name="link"  class="form-control" id="inputCity">
                          @error('link')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                        </div>


                        <div class="col-md-6">
                          <label for="inputCity" class="form-label">Portfolio Slug</label>
                          <input type="text" value="{{ $slug  }}" placeholder="Enter Main slug" name="slug"  class="form-control" id="inputCity">
                          @error('slug')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                        </div>

                        <div class="col-md-6">
                          <label for="inputEmail4" class="form-label">Client image</label>
                          <input type="file"  placeholder="image" name="image"  class="form-control" id="inputEmail4" >
                          @error('image')
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
                </main>
              </div>


@endsection()