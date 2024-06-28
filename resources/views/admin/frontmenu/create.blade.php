@extends('admin.layouts.app')
@push('style')
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
@section('title', 'Add Menu')
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><i class="fa-solid fa-bars"></i></span> Front Menu</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{ route('frontmenu.index') }}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <div class="card-header">
            <div class="row mt-5 justify-content-center">
              <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="card" style="border-color: rgb(126, 120, 120);">
                  <div class="card-header">
                    <h5 class="card-title">Create Main Menu</h5>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('frontmenu.store') }}" method="POST" id="AddMenusForm" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Main Menu Name <span style="color: red">*</span></label>
                            <input name="menu" type="text" class="form-control" placeholder="Example : Contact Us" value="{{ old('menu') }}">
                          </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Route <span style="color: red">*</span></label>
                            <input name="route" type="text" class="form-control" placeholder="Example : Contact Us" value="{{ old('route') }}">
                          </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Tagline <span style="color: red">*</span></label>
                            <input name="tagline" type="text" class="form-control" placeholder="Example : Contact Us" value="{{ old('tagline') }}">
                          </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label for="title_image">Title Image <span style="color: red">*</span></label>
                            <input type="file" name="title_image" value="{{ old('title_image') }}">

                            @error('title_image')
                              <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Page Title <span style="color: red">*</span></label>
                            <input name="page_title" type="text" class="form-control" placeholder="Example : Contact Us" value="{{ old('page_title') }}">
                          </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
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
                      <div class="col-md-12" id="singleRoute" style="display: none">
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <a class="btn btn-outline-secondary btn-sm float-right ml-2" href="{{ route('frontmenu.index') }}">Cancel</a>
                          <button class="btn btn-outline-primary btn-sm float-right" type="submit" id="menuBtn">Submit</button>
                        </div>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
</div>
@endsection
@push('scripts')
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function() {
    $('.selectList').select2({
      theme: 'bootstrap4'
    })
    $('#selectIcon').select2({
      theme: 'bootstrap4',
      templateResult: formatState,
      templateSelection: formatState
    });
    $('.select2.select2-container').css('width', 'auto');
  })

  function checkinput(input) {
    if (input.val() == "") {
      $(input).css('border', '1px solid red');
      return false;
    } else {
      $(input).css('border', '1px solid #444951');
      return true;
    }
  }
</script>
@endpush
