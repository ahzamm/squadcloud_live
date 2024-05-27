@extends('layouts/backend')
@section('page_title', 'rating')
@section('rating_select', 'active')
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
          <h1 align="center" class="main-title">Add Rating</h1>
          @endif  
          <a href="{{ url('admin/slider') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>





















                          
              <div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">
                      <form action="{{ route('setting.manage_rating_process') }}" method="post" enctype="multipart/form-data" class="row g-3">                
                       @csrf

                       <div class="col-md-6">
                          <label for="product ID" class="form-label">Product Id</label>
                          <select name="product_id" id="product_id" class="form-select">
                           <option value="" disabled>Select Product Id</option>
                            @foreach($product as $item)
                                <option value="{{ $item->id }}" @if($item->id == $id) selected @endif>{{ $item->title }}</option>
                            @endforeach
                        </select>
                         @error('product_id')
                            <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="col-md-6">
                          <label for="title" class="form-label">Title</label>
                          <input type="text" value="{{ $title  }}" placeholder="Enter rating Title" name="title"  class="form-control" id="inputCity">
                          @error('title')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>

                         <div class="form-group">
                         <label for="slug" class="control-label mb-1">Slug</label>
                         <input id="slug" value="{{ $slug }}" name="slug" placeholder="Enter Slug" type="text" class="form-control" >     
                         @error('slug')
                         <p class="text-danger">{{$message}}</p>
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