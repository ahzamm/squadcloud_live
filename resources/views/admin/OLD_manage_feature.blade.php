@extends('layouts/backend')
@section('page_title', 'feature')
@section('feature_select', 'active')
@section('content')


<div class="row">
                <main class="main users chart-page" id="skip-target">
                  <div class="container">

                      @if($id>0)
                      <h1 align="center" class="main-title">Manage Slider</h1>
                      @else
                      <h1 align="center" class="main-title">Add Slider</h1>
                      @endif              
                    <!-- <h1 align="center" class="main-title">Form</h1> -->
                    
                    <div class="bb-design">


                    <a href="{{ url('admin/feature') }}">
                          <div class="red-btn">
                          <input type="button" value="Back">
                          </div>
                      </a> 

                      <form action="{{ route('setting.manage_feature_process') }}" method="post" enctype="multipart/form-data" class="row g-3">
                         
                      @csrf
                        
                      <div class="form-group">
                        <label for="product_id" class="control-label mb-1">Product Name</label>
                        <select name="product_id" id="product_id" class="form-control" required>
                            <option value="" disabled>Select Product Name</option>
                            @foreach($product as $item)
                                <option value="{{ $item->id }}" @if($item->id == $id) selected @endif>{{ $item->product_name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                        </div>

                         <div class="col-md-6">
                          <label for="feature" class="form-label">Feature</label>
                          <textarea type="text" value="{{ $feature }}" placeholder="Enter feature feature" name="feature"  class="form-control" id="inputCity">{{ $feature }}</textarea>
                          @error('feature')
                          <p class="text-danger text-center">{{$message}}</p>
                          @enderror
                         </div>

                         <div class="col-md-6">
                          <label for="slug" class="form-label">Slug</label>
                          <input type="text" value="{{ $slug  }}" placeholder="Enter slug " name="slug"  class="form-control">
                          @error('slug')
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