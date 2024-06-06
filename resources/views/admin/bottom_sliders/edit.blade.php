@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Bottom Slider</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('bottom_sliders.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('bottom_sliders.update',$bottom_slider->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Bottom Slider Image <span style="color: red">*</span></label>
                    @isset($bottom_slider->image)
                    <img src="{{ asset('frontend_assets/images/bottom_sliders/'. $bottom_slider->image) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $bottom_slider->image }}" name="logo">
                    @error('image')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title"  value="{{old('title') == NULL?$bottom_slider->title:old('title') }}">
                    @error('title')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  {{ $bottom_slider->is_active == 1? 'checked' :'unchecked' }} name="is_active" id="checkboxSuccess1">
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
