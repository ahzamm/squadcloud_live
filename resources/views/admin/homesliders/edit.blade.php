@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><i class="fa-solid fa-images"></i></span> Update Home (Slider)</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('homeslider.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            @if ($homeslider->image_1 || $homeslider->image_2 || $homeslider->image_3 || $homeslider->image_4)
            {{-- IMAGE FORM --}}
              <form action="{{ route('homeslider.update', $homeslider->id) }}" method="POST" enctype="multipart/form-data">
                <div class="card-body pad">
                  @method('PUT')
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Heading <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="heading" value="{{ old('heading') == null ? $homeslider->heading : old('heading') }}">
                        @error('heading')
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Subheading <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="subheading" value="{{ old('subheading') == null ? $homeslider->subheading : old('subheading') }}">
                        @error('subheading')
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Description <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="description" value="{{ old('description') == null ? $homeslider->description : old('description') }}">
                        @error('description')
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Image 1 <span style="color: red">*</span></label>
                        @isset($homeslider->image_1)
                          <img src="{{ asset('frontend_assets/images/home_sliders/' . $homeslider->image_1) }}" height="60" width="120" alt="" srcset="">
                        @endisset
                        <br><br>
                        <input type="file" value="{{ $homeslider->image_1 }}" name="image_1">
                        @error('image_1')
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Image 2 <span style="color: red">*</span></label>
                        @isset($homeslider->image_2)
                          <img src="{{ asset('frontend_assets/images/home_sliders/' . $homeslider->image_2) }}" height="60" width="120" alt="" srcset="">
                        @endisset
                        <br><br>
                        <input type="file" value="{{ $homeslider->image_2 }}" name="image_2">
                        @error('image_2')
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Image 3 <span style="color: red">*</span></label>
                        @isset($homeslider->image_3)
                          <img src="{{ asset('frontend_assets/images/home_sliders/' . $homeslider->image_3) }}" height="60" width="120" alt="" srcset="">
                        @endisset
                        <br><br>
                        <input type="file" value="{{ $homeslider->image_3 }}" name="image_3">
                        @error('image_3')
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Image 4 <span style="color: red">*</span></label>
                        @isset($homeslider->image_4)
                          <img src="{{ asset('frontend_assets/images/home_sliders/' . $homeslider->image_4) }}" height="60" width="120" alt="" srcset="">
                        @endisset
                        <br><br>
                        <input type="file" value="{{ $homeslider->image_4 }}" name="image_4">
                        @error('image_4')
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group clearfix">
                        <div class="icheck-success d-inline">
                          <input type="checkbox" {{ $homeslider->is_active == 1 ? 'checked' : 'unchecked' }} name="is_active" id="checkboxSuccess1">
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
            @else
            {{-- VIDEO FORM --}}
              <form action="{{ route('homesliders.updatevideo', $homeslider->id) }}" method="POST" enctype="multipart/form-data">
                <div class="card-body pad">
                  @method('PUT')
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Upload Video <span style="color: red">*</span></label> <br>
                        @if (isset($homeslider))
                          <video controls width="200" class="mt-3 mb-3">
                            <source src="{{ asset('VideoHeader/' . $homeslider->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                          </video>
                          <input type="file" class="form-control-file" name="video" id="video">
                        @else
                          <input type="file" class="form-control-file" name="video" id="video">
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group clearfix">
                        <label for="" style="visibility: hidden">A</label>
                        <div class="icheck-success d-block">
                          <input type="checkbox" {{ $homeslider->is_active == 1 ? 'checked' : 'unchecked' }} name="is_active" id="checkboxSuccess2">
                          <label for="checkboxSuccess2">
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
            @endif
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('scripts')
@endpush
