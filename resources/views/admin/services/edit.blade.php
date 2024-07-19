@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa fa-gears"></i></span> Update Service</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('services.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Service Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="service" value="{{ old('service') == null ? $service->service : old('service') }}">
                      @error('service')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Tagline <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="tagline" value="{{ old('tagline') == null ? $service->tagline : old('tagline') }}">
                      @error('tagline')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Slug <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="slug" value="{{ old('slug') == null ? $service->slug : old('slug') }}">
                      @error('slug')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Service Logo <span style="color: red">*</span></label>
                      @isset($service->logo)
                        <img src="{{ asset('frontend_assets/images/services/' . $service->logo) }}" height="60" width="120" alt="" srcset="">
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $service->logo }}" name="logo">
                      @error('logo')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Background Image <span style="color: red">*</span></label>
                      @isset($service->background_image)
                        <img src="{{ asset('frontend_assets/images/services/' . $service->background_image) }}" height="60" width="120" alt="" srcset="">
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $service->background_image }}" name="background_image">
                      @error('background_image')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Description <span style="color: red">*</span></label>
                      <textarea name="description" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{ $service->description }}</textarea>
                      @error('description')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
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
