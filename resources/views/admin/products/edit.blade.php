@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Product</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('products.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Product Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="name"  value="{{old('name') == NULL?$product->name:old('name') }}">
                    @error('name')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Short Description <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="short_description"  value="{{old('short_description') == NULL?$product->short_description:old('short_description') }}">
                    @error('short_description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="image">Image <span style="color: red">*</span></label>
                    @isset($product->image)
                    <img src="{{ asset('frontend_assets/images/products/'. $product->image) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $product->image }}" name="image">
                    @error('image')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Link <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="link"  value="{{old('link') == NULL?$product->link:old('link') }}">
                    @error('link')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Rating <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="rating"  value="{{old('rating') == NULL?$product->rating:old('rating') }}">
                    @error('rating')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Rating Number <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="rating_number"  value="{{old('rating_number') == NULL?$product->rating_number:old('rating_number') }}">
                    @error('rating_number')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Question <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="question"  value="{{old('question') == NULL?$product->question:old('question') }}">
                    @error('question')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Answer <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="answer"  value="{{old('answer') == NULL?$product->answer:old('answer') }}">
                    @error('answer')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Price <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="price"  value="{{old('price') == NULL?$product->price:old('price') }}">
                    @error('price')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Price Description <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="price_description"  value="{{old('price_description') == NULL?$product->price_description:old('price_description') }}">
                    @error('price_description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="screenshot_1">Upload Screenshot 1 <span style="color: red">*</span></label>
                    @isset($product->screenshot_1)
                    <img src="{{ asset('frontend_assets/images/products/'. $product->screenshot_1) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $product->screenshot_1 }}" name="screenshot_1">
                    @error('screenshot_1')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="screenshot_2">Upload Screenshot 2 <span style="color: red">*</span></label>
                    @isset($product->screenshot_2)
                    <img src="{{ asset('frontend_assets/images/products/'. $product->screenshot_2) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    
                    <input type="file" value="{{ $product->screenshot_2 }}" name="screenshot_2">
                    @error('screenshot_2')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="screenshot_3">Upload Screenshot 3 <span style="color: red">*</span></label>
                    @isset($product->screenshot_3)
                    <img src="{{ asset('frontend_assets/images/products/'. $product->screenshot_3) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    
                    <input type="file" value="{{ $product->screenshot_3 }}" name="screenshot_3">
                    @error('screenshot_3')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="background_image">Upload Background Image <span style="color: red">*</span></label>
                    @isset($product->background_image)
                    <img src="{{ asset('frontend_assets/images/products/'. $product->background_image) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    
                    <input type="file" value="{{ $product->background_image }}" name="background_image">
                    @error('background_image')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  {{ $product->is_active == 1? 'checked' :'unchecked' }} name="is_active" id="checkboxSuccess1">
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
<script>
  $(document).ready(function(){
    $('#pageContent').summernote({
      height:300
    });
  });
</script>
@endpush