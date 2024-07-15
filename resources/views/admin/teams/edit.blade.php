@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Team Member</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('teams.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="name" value="{{ old('name') == null ? $team->name : old('name') }}">
                      @error('name')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Photo <span style="color: red">*</span></label>
                      @isset($team->image)
                        <img src="{{ asset('frontend_assets/images/teams/' . $team->image) }}" height="60" width="120" alt="" srcset="">
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $team->image }}" name="image">
                      @error('image')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Designation <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="designation" value="{{ old('designation') == null ? $team->designation : old('designation') }}">
                      @error('designation')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Linkedin <span style="color: red">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="linkedinPrefix">https://</span>
                        </div>
                        <input type="text" class="form-control" name="linkedin" value="{{ old('linkedin') == null ? $team->linkedin : old('linkedin') }}">
                      </div>
                      @error('linkedin')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" {{ $team->is_active == 1 ? 'checked' : 'unchecked' }} name="is_active" id="checkboxSuccess1">
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
    $(document).ready(function() {
      $('#pageContent').summernote({
        height: 300
      });
    });
  </script>
@endpush
