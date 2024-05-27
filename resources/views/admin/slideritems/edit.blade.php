@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Slideritem</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('slideritems.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('slideritems.update',$slideritem->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">

              <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Heading <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="heading"  value="{{old('heading') == NULL?$slideritem->heading:old('heading') }}">
                    @error('heading')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Sub Heading <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="subheading"  value="{{old('subheading') == NULL?$slideritem->subheading:old('subheading') }}">
                    @error('subheading')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Description <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="description"  value="{{old('description') == NULL?$slideritem->description:old('description') }}">
                    @error('description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Image 1 <span style="color: red">*</span></label>
                    @isset($slideritem->image_1)
                    <img src="{{ asset('frontend_assets/images/slideritems/'. $slideritem->image_1) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $slideritem->image_1 }}" name="image_1">
                    @error('image_1')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Image 2 <span style="color: red">*</span></label>
                    @isset($slideritem->image_2)
                    <img src="{{ asset('frontend_assets/images/slideritems/'. $slideritem->image_2) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $slideritem->image_2 }}" name="image_2">
                    @error('image_2')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Image 3 <span style="color: red">*</span></label>
                    @isset($slideritem->image_3)
                    <img src="{{ asset('frontend_assets/images/slideritems/'. $slideritem->image_3) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $slideritem->image_3 }}" name="image_2">
                    @error('image_3')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Image 4 <span style="color: red">*</span></label>
                    @isset($slideritem->image_3)
                    <img src="{{ asset('frontend_assets/images/slideritems/'. $slideritem->image_4) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $slideritem->image_4 }}" name="image_2">
                    @error('image_4')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  {{ $slideritem->is_active == 1? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
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