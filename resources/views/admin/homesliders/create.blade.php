@extends('admin.layouts.app')
@section('content')
<style>

.homeslider-tab .nav-tabs .nav-item.show .nav-link, .homeslider-tab .nav-tabs .nav-link.active {
  color: #fff;
  border-color: #dee2e6 #dee2e6 #fff;
  background-color: #b21828;
}
</style>
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><i class="fa-solid fa-images"></i></span> Add Home (Slider)</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('homeslider.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <nav class="homeslider-tab">
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-slider-tab" data-toggle="tab" href="#nav-slider" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fa fa-image"></i> Slider</a>
                <a class="nav-item nav-link" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false"><i class="fa fa-video"></i> Video</a>
              </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-slider" role="tabpanel" aria-labelledby="nav-slider-tab">
                <form action="{{ route('homesliders.storeimages') }}" method="POST" enctype="multipart/form-data">
                  {{-- IMAGES FORM --}}
                  <div class="card-body pad">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Heading <span style="color: red">*</span></label>
                          <input type="text" class="form-control" name="heading" placeholder="Example : Bitcoin" value="{{ old('heading') }}">
                          @error('heading')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Subheading <span style="color: red">*</span></label>
                          <input type="text" class="form-control" name="subheading" placeholder="Example : Bitcoin" value="{{ old('subheading') }}">
                          @error('subheading')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Description <span style="color: red">*</span></label>
                          <input type="text" class="form-control" name="description" placeholder="Example : Bitcoin" value="{{ old('description') }}">
                          @error('description')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12" id='image_wrapper'>
                        <div class="form-group">
                          <label for="">Select Image<span style="color: red">*</span></label>
                          <input type="file" name="image_1">
                          <button class="btn btn-primary btn-sm" onclick="addRow()" type="button"><i class="fa fa-plus"></i></button>
                          @error('image_1')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      {{-- <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Image 2 <span style="color: red">*</span></label>
                          <input type="file" name="image_2">
                          @error('image_2')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Image 3 <span style="color: red">*</span></label>
                          <input type="file" name="image_3">
                          @error('image_3')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Image 4 <span style="color: red">*</span></label>
                          <input type="file" name="image_4">
                          @error('image_4')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div> --}}
                      <div class="col-md-6">
                        <div class="form-group clearfix">
                          <div class="icheck-success d-inline">
                            <input type="checkbox" {{ old('is_active') != null ? 'checked' : 'unchecked' }} name="is_active" id="checkboxSuccess1">
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
              <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
                <form action="{{ route('homesliders.storevideo') }}" method="POST" enctype="multipart/form-data">
                  {{-- VIDEO FORM --}}
                  <div class="card-body pad">
                    @csrf
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Heading <span style="color: red">*</span></label>
                          <input type="text" class="form-control" name="heading" placeholder="Example : Bitcoin" value="{{ old('heading') }}">
                          @error('heading')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Subheading <span style="color: red">*</span></label>
                          <input type="text" class="form-control" name="subheading" placeholder="Example : Bitcoin" value="{{ old('subheading') }}">
                          @error('subheading')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Description <span style="color: red">*</span></label>
                          <input type="text" class="form-control" name="description" placeholder="Example : Bitcoin" value="{{ old('description') }}">
                          @error('description')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">

                        <div class="form-group">
                          <label for="">Upload Video <span style="color: red">*</span></label> <br>
                          @if (isset($data))
                            <video controls width="200" class="mt-3 mb-3">
                              <source src="{{ asset('HomeVideo/' . $data->video) }}" type="video/mp4">
                              Your browser does not support the video tag.
                            </video>
                            <input type="file" class="form-control-file" name="video" id="video">
                            @error('video')
                              <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                            @enderror
                          @else
                            <input type="file" class="form-control-file" name="video" id="video">
                            @error('video')
                              <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                            @enderror
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group clearfix">
                          <label for="" style="visibility: hidden">A</label>
                          <div class="icheck-success d-block">
                            <input type="checkbox" {{ old('status') != null ? 'checked' : 'unchecked' }} name="status" id="checkboxSuccess2">
                            <label for="checkboxSuccess2">
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

          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('scripts')
<script>
  function addRow() {
    let html = `<div class="form-group">
      <label for="">Select Image<span style="color: red">*</span></label>
      <input type="file" name="image_1">
      <button class="btn btn-danger btn-sm deleteRow" type="button"><i class="fa fa-minus"></i></button>
      @error('image_1')
        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
      @enderror
    </div>`;
    $('#image_wrapper').append(html);
  }
  $(document).on('click', '.deleteRow', function() {
    $(this).parent().closest('div').remove();
  })
</script>
@endpush
