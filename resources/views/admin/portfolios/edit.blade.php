@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Portfolio</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('portfolios.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('portfolios.update',$portfolio->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Portfolio Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title"  value="{{old('title') == NULL?$portfolio->title:old('title') }}">
                    @error('title')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Description <span style="color: red">*</span></label>
                    {{-- <input type="text" class="form-control" name="description"  value="{{old('description') == NULL?$portfolio->description:old('description') }}"> --}}
                    <textarea name="description" rows="4" class="form-control summernote">{{$portfolio->description}}</textarea>
                    @error('mbps')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Link <span style="color: red">*</span></label>
                    <input type="url" class="form-control" name="link"  value="{{old('link') == NULL?$portfolio->link:old('link') }}">
                    @error('color')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Image <span style="color: red">*</span></label> <br>
                    @isset($portfolio->image)
                    <img src="{{ asset('frontend_assets/images/portfolio/'. $portfolio->image) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $portfolio->image }}" name="image">
                    @error('image')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>









                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Route <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="route"  value="{{old('route') == NULL?$portfolio->route:old('route') }}">
                      @error('route')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Rating <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="rating"  value="{{old('rating') == NULL?$portfolio->rating:old('rating') }}">
                      @error('rating')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Rating Number<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="rating_number"  value="{{old('rating_number') == NULL?$portfolio->rating_number:old('rating_number') }}">
                      @error('rating_number')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Price<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="price"  value="{{old('price') == NULL?$portfolio->price:old('price') }}">
                      @error('price')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Price Description<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="price_description"  value="{{old('price_description') == NULL?$portfolio->price_description:old('price_description') }}">
                      @error('price_description')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Screenshot 1 <span style="color: red">*</span></label> <br>
                      @isset($portfolio->screenshot_1)
                      <img src="{{ asset('frontend_assets/images/portfolio/'. $portfolio->screenshot_1) }}" height="60"
                      width="120" alt="" srcset="" >
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $portfolio->screenshot_1 }}" name="screenshot_1">
                      @error('screenshot_1')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Screenshot 2 <span style="color: red">*</span></label> <br>
                      @isset($portfolio->screenshot_2)
                      <img src="{{ asset('frontend_assets/images/portfolio/'. $portfolio->screenshot_2) }}" height="60"
                      width="120" alt="" srcset="" >
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $portfolio->screenshot_2 }}" name="screenshot_2">
                      @error('screenshot_2')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Screenshot 3 <span style="color: red">*</span></label> <br>
                      @isset($portfolio->screenshot_3)
                      <img src="{{ asset('frontend_assets/images/portfolio/'. $portfolio->screenshot_3) }}" height="60"
                      width="120" alt="" srcset="" >
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $portfolio->screenshot_3 }}" name="screenshot_3">
                      @error('screenshot_3')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Background Image <span style="color: red">*</span></label> <br>
                      @isset($portfolio->background_image)
                      <img src="{{ asset('frontend_assets/images/portfolio/'. $portfolio->background_image) }}" height="60"
                      width="120" alt="" srcset="" >
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $portfolio->background_image }}" name="background_image">
                      @error('background_image')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  {{ $portfolio->is_active == 1? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
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
