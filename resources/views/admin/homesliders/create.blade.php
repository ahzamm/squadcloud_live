@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Add Service</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('services.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('services.store')}}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Service Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="service" placeholder="Example : Bitcoin" value="{{old('service')}}">
                      @error('service')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Service Logo <span style="color: red">*</span></label>
                      <input type="file" name="logo">
                      @error('logo')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Tagline <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="tagline" placeholder="Transforming Ideas into Innovative Mobile Experiences" required value="{{old('tagline')}}">
                      @error('tagline')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Description <span style="color: red">*</span></label>
                      <textarea name="description" rows="4" placeholder="Example : How are you"  class="form-control summernote">{{old('description')}}</textarea>
                      @error('description')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Slug <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="slug" placeholder="Transforming Ideas into Innovative Mobile Experiences" required value="{{old('slug')}}">
                      @error('slug')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Background Image <span style="color: red">*</span></label>
                      <input type="file" name="background_image">
                      @error('background_image')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>

                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" {{old('is_active') != null? 'checked' :'unchecked' }} name="is_active" id="checkboxSuccess1">
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
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
</div>
@endsection
@push('scripts')
<script>
  $(document).ready(function() {
    $('#pageContent').summernote({
      height: 300
    });
  });
</script>
@endpush
