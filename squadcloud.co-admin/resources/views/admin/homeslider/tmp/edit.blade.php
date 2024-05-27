@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><i class="fa-solid fa-images"></i></span> Update Home (Slider)</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('homeslider.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('homeslider.update',$homeslider->id)}}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @method('PUT')
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Slide Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Example : Best Internet" required value="{{$homeslider->title}}">
                    @error('title')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Slide Slogan <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="slogan" placeholder="Example : One World One Connection" required value="{{$homeslider->slogan}}">
                    @error('slogan')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Image Alt <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="image_alt" placeholder="Example : One World" value="{{$homeslider->image_alt}}">
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
                  <div class="form-group">
                    <label for="">Upload Video <span style="color: red">*</span></label> <br>
                    @if(isset($homeslider))
                    <video controls width="200" class="mt-3 mb-3">
                      <source src="{{ asset('VideoHeader/' . $homeslider->video ) }}" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                    <input type="file" class="form-control-file" name="video" id="video">
                    @else
                    <input type="file" class="form-control-file" name="video" id="video">
                    @endif
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <label for="" style="visibility: hidden">A</label>
                    <div class="icheck-success d-block">
                      <input type="checkbox"  {{$homeslider->active == 1? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
                      <label for="checkboxSuccess1">
                        Status (On & Off)
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-primary float-right">Update</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
</div>
@endsection
@push('scripts')
@endpush