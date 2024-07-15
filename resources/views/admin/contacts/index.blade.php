@extends('admin.layouts.app')

@push('styles')
  <style>
    .tooltip-container {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }

    .tooltip-container .fa-question-circle {
      margin-left: 5px;
      color: #007bff;
    }

    .tooltip-container .tooltip-content {
      visibility: hidden;
      width: 200px;
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 10px;
      position: absolute;
      z-index: 1000;
      bottom: 125%;
      left: 50%;
      transform: translateX(-50%);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 4px;
      text-align: center;
    }

    .tooltip-container .tooltip-content::after {
      content: '';
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #fff transparent transparent transparent;
    }

    .tooltip-container:hover .tooltip-content {
      visibility: visible;
    }
  </style>
@endpush
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa fa-phone-volume"></i></span> Update Contact</h3>
              <div class="ml-auto">
              </div>
            </div>
            <form action="{{ route('contacts.update') }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Location URL <span style="color: red">*</span>
                        <span class="tooltip-container">
                          <i class="fa fa-question-circle"></i>
                          <div class="tooltip-content">
                            <img class="tooltip-img" data-src="{{ asset('backend/dist/img/google_map.gif') }}" alt="" />
                          </div>
                        </span>
                      </label>
                      @isset($contact->office_hours_end)
                        <input type="text" class="form-control" name="location_url" value="{{ old('location_url') == null ? $contact->location_url : old('location_url') }}">
                      @endisset
                      @error('location_url')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Title <span style="color: red">*</span></label>
                      @isset($contact->title)
                        <input type="text" class="form-control" name="title" value="{{ old('title') == null ? $contact->title : old('title') }}">
                      @endisset

                      @error('title')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Tagline <span style="color: red">*</span></label>
                      @isset($contact->tagline)
                        <input type="text" class="form-control" name="tagline" value="{{ old('tagline') == null ? $contact->tagline : old('tagline') }}">
                      @endisset

                      @error('tagline')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Phone <span style="color: red">*</span></label>
                      @isset($contact->phone)
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') == null ? $contact->phone : old('phone') }}">
                      @endisset

                      @error('phone')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Email <span style="color: red">*</span></label>
                      @isset($contact->email)
                        <input type="text" class="form-control" name="email" value="{{ old('email') == null ? $contact->email : old('email') }}">
                      @endisset

                      @error('email')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Address <span style="color: red">*</span></label>
                      @isset($contact->address)
                        <input type="text" class="form-control" name="address" value="{{ old('address') == null ? $contact->address : old('address') }}">
                      @endisset

                      @error('address')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Office Openning Timming <span style="color: red">*</span></label>
                      @isset($contact->office_hours_start)
                        <input type="text" class="form-control" name="office_hours_start" value="{{ old('office_hours_start') == null ? $contact->office_hours_start : old('office_hours_start') }}">
                      @endisset

                      @error('office_hours_start')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Office Colsing Timming <span style="color: red">*</span></label>
                      @isset($contact->office_hours_end)
                        <input type="text" class="form-control" name="office_hours_end" value="{{ old('office_hours_end') == null ? $contact->office_hours_end : old('office_hours_end') }}">
                      @endisset

                      @error('office_hours_end')
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

      // Hover functionality for the tooltip
      $('.tooltip-container').hover(function() {
        var $tooltip = $(this).find('.tooltip-content');
        var $img = $tooltip.find('.tooltip-img');
        $img.attr('src', $img.data('src')); // Set the src attribute to play the GIF
        $tooltip.css('visibility', 'visible');
      }, function() {
        var $tooltip = $(this).find('.tooltip-content');
        var $img = $tooltip.find('.tooltip-img');
        $img.attr('src', ''); // Clear the src attribute to stop the GIF
        $tooltip.css('visibility', 'hidden');
      });
    });
  </script>
@endpush
