@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Add Product</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('products.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Product Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="name" placeholder="Example : Bitcoin" required value="{{old('package_name')}}">
                    @error('name')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Short Description <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="short_description" placeholder="Example : 15 Mbps" required value="{{old('short_description')}}">
                    @error('short_description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Image <span style="color: red">*</span></label>
                    <input type="file" name="image">
                    @error('image')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Link <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="link" placeholder="Example : Green" required value="{{old('link')}}">
                    @error('link')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Rating <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="rating" placeholder="Example : Green" required value="{{old('rating')}}">
                    @error('rating')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Rating Number <span style="color: red">*</span></label>
                    <input type="number" class="form-control" name="rating_number" placeholder="Example : Green" required value="{{old('rating_number')}}">
                    @error('rating_number')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Question <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="question" placeholder="Example : Green" required value="{{old('question')}}">
                    @error('question')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Answer <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="answer" placeholder="Example : Green" required value="{{old('answer')}}">
                    @error('answer')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Price <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="price" placeholder="Example : Green" required value="{{old('price')}}">
                    @error('price')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Price Description <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="price_description" placeholder="Example : Green" required value="{{old('price_description')}}">
                    @error('price_description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Upload Screenshot 1 <span style="color: red">*</span></label> <br>
                    <input type="file" name="screenshot_1">
                    @error('screenshot_1')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Upload Screenshot 2 <span style="color: red">*</span></label> <br>
                    <input type="file" name="screenshot_2">
                    @error('screenshot_2')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Upload Screenshot 3 <span style="color: red">*</span></label> <br>
                    <input type="file" name="screenshot_3">
                    @error('screenshot_3')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Upload Background Image <span style="color: red">*</span></label> <br>
                    <input type="file" name="background_image">
                    @error('background_image')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" {{old('status') != null? 'checked' :'unchecked' }} name="is_active" id="checkboxSuccess1">
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