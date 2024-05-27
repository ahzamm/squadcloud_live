@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Add Contact</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('contacts.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('contacts.store')}}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Example : 15 Mbps"  value="{{old('title')}}">
                    @error('title')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Tagline <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="tagline" placeholder="Example : 15 Mbps"  value="{{old('tagline')}}">
                    @error('tagline')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Phone <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="phone" placeholder="Example : 15 Mbps"  value="{{old('phone')}}">
                    @error('phone')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="email" placeholder="Example : 15 Mbps"  value="{{old('email')}}">
                    @error('email')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Address <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="address" placeholder="Example : 15 Mbps"  value="{{old('address')}}">
                    @error('address')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Office Openning Timming <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="office_hours_start" placeholder="Example : 15 Mbps"  value="{{old('office_hours_start')}}">
                    @error('office_hours_start')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Office Closing Timming <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="office_hours_end" placeholder="Example : 15 Mbps"  value="{{old('office_hours_end')}}">
                    @error('office_hours_end')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Location URL <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="location_url" placeholder="Example : 15 Mbps"  value="{{old('location_url')}}">
                    @error('location_url')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                



                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" {{old('is_active') != null? 'checked' :'unchecked' }} name="is_active" id="checkboxSuccess1">
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
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
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