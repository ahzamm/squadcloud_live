@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa fa-users-viewfinder"></i></span> Update Client</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('clients.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Title <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="title" value="{{ old('title') == null ? $client->title : old('title') }}">
                      @error('title')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Link <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="link" value="{{ old('link') == null ? $client->link : old('link') }}">
                      @error('link')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Client Logo <span style="color: red">*</span></label>
                      @isset($client->logo)
                        <img src="{{ asset('frontend_assets/images/clients/' . $client->logo) }}" height="60" width="120" alt="" srcset="">
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $client->logo }}" name="logo">
                      @error('image')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Description <span style="color: red">*</span></label>
                      <textarea name="description" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{ $client->description }}</textarea>
                      @error('description')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" {{ $client->is_active == 1 ? 'checked' : 'unchecked' }} name="is_active" id="checkboxSuccess1">
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
