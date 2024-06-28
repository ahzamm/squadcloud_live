@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Home Slider</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('homesliders.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('homesliders.update',$homeslider->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Heading <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="heading"  value="{{old('heading') == NULL?$homeslider->heading:old('heading') }}">
                      @error('heading')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Subheading <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="subheading"  value="{{old('subheading') == NULL?$homeslider->subheading:old('subheading') }}">
                      @error('subheading')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Description <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="description"  value="{{old('description') == NULL?$homeslider->description:old('description') }}">
                      @error('description')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image 1 <span style="color: red">*</span></label>
                      @isset($homeslider->image_1)
                      <img src="{{ asset('frontend_assets/images/home_sliders/'. $homeslider->image_1) }}" height="60"
                      width="120" alt="" srcset="" >
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $homeslider->image_1 }}" name="image_1">
                      @error('image_1')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image 2 <span style="color: red">*</span></label>
                      @isset($homeslider->image_2)
                      <img src="{{ asset('frontend_assets/images/home_sliders/'. $homeslider->image_2) }}" height="60"
                      width="120" alt="" srcset="" >
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $homeslider->image_2 }}" name="image_2">
                      @error('image_2')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image 3 <span style="color: red">*</span></label>
                      @isset($homeslider->image_3)
                      <img src="{{ asset('frontend_assets/images/home_sliders/'. $homeslider->image_3) }}" height="60"
                      width="120" alt="" srcset="" >
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $homeslider->image_3 }}" name="image_3">
                      @error('image_3')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image 4 <span style="color: red">*</span></label>
                      @isset($homeslider->image_4)
                      <img src="{{ asset('frontend_assets/images/home_sliders/'. $homeslider->image_4) }}" height="60"
                      width="120" alt="" srcset="" >
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $homeslider->image_4 }}" name="image_4">
                      @error('image_4')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  {{ $homeslider->is_active == 1? 'checked' :'unchecked' }} name="is_active" id="checkboxSuccess1">
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
    </div>
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
