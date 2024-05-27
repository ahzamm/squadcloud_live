<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 @extends('admin.layouts.app')
 @section('content')
 <style>
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #fff;
    background-color: #007bff;
  }
</style>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><i class="fa-solid fa-images"></i></span> Add Home (Slider)</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('homeslider.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-slider-tab" data-toggle="tab" href="#nav-slider" role="tab" aria-controls="nav-home" aria-selected="true">Slider</a>
              <a class="nav-item nav-link" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false">Video</a>
            </div>
          </nav>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-slider" role="tabpanel" aria-labelledby="nav-slider-tab">
              <form action="{{route('homeslider.store')}}" method="POST" enctype="multipart/form-data">
                <!-- /.card-header -->
                <div class="card-body pad">
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Slide Title <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Example : Best Internet"  value="{{old('title')}}">
                        @error('title')
                        <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Slide Slogan <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="slogan" placeholder="Example : One World One Connection" value="{{old('slogan')}}">
                        @error('slogan')
                        <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Image Alt <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="image_alt" placeholder="Example : One World" value="{{old('image_alt')}}">
                        @error('image_alt')
                        <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Upload Slider Image (Size W/H: 1903x720) <span style="color: red">*</span></label>
                        <input type="file" class="form-control-file" name="banner_image" >
                        @error('banner_image')
                        <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group clearfix">
                        <label for="" style="visibility: hidden">A</label>
                        <div class="icheck-success d-block">
                          <input type="checkbox"  {{old('status') != null? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
                          <label for="checkboxSuccess1">
                            Status (On & Off)
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-outline-primary float-right">Submit</button>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
              <form action="{{route('homeslider.store')}}" method="POST" enctype="multipart/form-data">
                <!-- /.card-header -->
                <div class="card-body pad">
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Slide Title <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Example : Best Internet"  value="{{old('title')}}">
                        @error('title')
                        <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">  
                      <div class="form-group">
                        <label for="">Upload Video <span style="color: red">*</span></label> <br>
                        @if(isset($data))
                        <video controls width="200" class="mt-3 mb-3">
                          <source src="{{ asset('HomeVideo/' . $data->video ) }}" type="video/mp4">
                            Your browser does not support the video tag.
                          </video>
                          <input type="file" class="form-control-file" name="video" id="video">
                          @error('video')
                          <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                          @enderror
                          @else
                          <input type="file" class="form-control-file" name="video" id="video">
                          @error('video')
                          <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                          @enderror
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group clearfix">
                          <label for="" style="visibility: hidden">A</label>
                          <div class="icheck-success d-block">
                            <input type="checkbox"  {{old('status') != null? 'checked' :'unchecked' }} name="status" id="checkboxSuccess2">
                            <label for="checkboxSuccess2">
                              Status (On & Off)
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary float-right">Submit</button>
                  </div>
                </form>         </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- ./row -->
      </section>
    </div>
    @endsection
    @push('scr  ipts')
    @endpush
<!-- Code Finalize -->