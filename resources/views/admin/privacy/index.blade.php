@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa fa-address-book"></i></span> Update Privacy Page</h3>
            </div>
            <form id="updateTermForm" action="{{ route('privacy.update') }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label for="">Title Image <span style="color: red">*</span></label>
                      @isset($privacy->title_image)
                        <img src="{{ asset('frontend_assets/images/title/' . $privacy->title_image) }}" height="60" width="120" alt="" srcset="" style="float:right">
                      @endisset
                      <br>
                      <input type="file" value="{{ $privacy->title_image }}" name="title_image">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Privacy Policy <span style="color: red">*</span></label>
                      <textarea class="form-control summernote" name="privacy" rows="4">{{ $privacy->privacy }}</textarea>
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
