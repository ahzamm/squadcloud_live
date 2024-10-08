@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa fa-photo-film"></i></span> Update Bottom Slider</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('bottom_sliders.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('bottom_sliders.update', $bottom_slider->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Title <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="title" value="{{ old('title') == null ? $bottom_slider->title : old('title') }}">
                      @error('title')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Bottom Slider Image <span style="color: red">*</span></label>
                      @isset($bottom_slider->image)
                        <img src="{{ asset('frontend_assets/images/bottom_sliders/' . $bottom_slider->image) }}" height="60" width="120" alt="" srcset="">
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $bottom_slider->image }}" name="image">
                      @error('image')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
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
    $(document).ready(function() {
      $('#pageContent').summernote({
        height: 300
      });
    });
  </script>
@endpush
