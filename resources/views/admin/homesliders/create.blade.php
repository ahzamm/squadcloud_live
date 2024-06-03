@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Add Home Slider</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('homesliders.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('homesliders.store')}}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Heading <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="heading" placeholder="Example : Bitcoin" value="{{old('heading')}}">
                      @error('heading')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Subheading <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="subheading" placeholder="Example : Bitcoin" value="{{old('subheading')}}">
                      @error('subheading')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Description <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="description" placeholder="Example : Bitcoin" value="{{old('description')}}">
                      @error('description')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image 1 <span style="color: red">*</span></label>
                      <input type="file" name="image_1">
                      @error('image_1')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image 2 <span style="color: red">*</span></label>
                      <input type="file" name="image_2">
                      @error('image_2')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image 3 <span style="color: red">*</span></label>
                      <input type="file" name="image_3">
                      @error('image_3')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image 4 <span style="color: red">*</span></label>
                      <input type="file" name="image_4">
                      @error('image_4')
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
