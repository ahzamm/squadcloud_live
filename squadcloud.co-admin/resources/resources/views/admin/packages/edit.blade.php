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
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Package</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('packages.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('packages.update',$package->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Internet Package Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="package_name"  value="{{old('package_name') == NULL?$package->name:old('package_name') }}">
                    @error('package_name')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Internet Bandwidth (Mbps) <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="mbps"  value="{{old('mbps') == NULL?$package->limit:old('mbps') }}">
                    @error('mbps')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Internet Packages Color Codes <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="color"  value="{{old('color') == NULL?$package->color:old('color') }}">
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
                      @php
                      $province = ["sindh","punjab","balochistan","kpk"];   
                      @endphp
                      @foreach ($province as $item)
                      <option value="{{$item}}" {{old('province') == $item?'selected':($package->province == $item? 'selected':'' )}}>{{ucwords($item)}}</option>
                      @endforeach
                    </select>
                    @error('province')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Upload Internet Package Image <span style="color: red">*</span></label> <br>
                    <input type="file" value="{{ $package->package_slider_img }}" name="package_slider_img">
                    @error('package_slider_img')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  {{ $package->active == 1? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
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
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
</div>
@endsection
@push('scripts')
<script>
  $(document).ready(function(){
    $('#pageContent').summernote({
      height:300
    });
  });
</script>
@endpush
<!-- Code Finalize -->