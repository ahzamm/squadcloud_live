<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 @extends('admin.layouts.app')
 @section('content')
 <div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Add Package</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('packages.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('packages.store')}}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Internet Package Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="package_name" placeholder="Example : Bitcoin" required value="{{old('package_name')}}">
                    @error('package_name')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Internet Bandwidth (Mbps) <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="mbps" placeholder="Example : 15 Mbps" required value="{{old('mbps')}}">
                    @error('mbps')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Internet Packages Color Codes <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="color" placeholder="Example : Green" required value="{{old('color')}}">
                    @error('color')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Select Province <span style="color: red">*</span></label>
                    <select class="form-control" name="province">
                      <option value=>--Select Province--</option>
                      <option value="sindh" {{old('province')}}>Sindh</option>
                      <option value="punjab">Punjab</option>
                      <option value="balochistan">Balochistan</option>
                      <option value="kpk">KPK</option>
                    </select>
                    @error('province')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Upload Internet Package Image <span style="color: red">*</span></label> <br>
                    <input type="file" name="package_slider_img">
                    @error('package_slider_img')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" {{old('status') != null? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
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
<!-- Code Finalize -->