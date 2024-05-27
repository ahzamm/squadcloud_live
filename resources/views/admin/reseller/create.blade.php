@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-user-tie"></i></span> Add Reseller & Partner</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('reseller.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('reseller.store')}}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Partner & Reseller Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="username" placeholder="Example : Jawad Alam" required value="{{old('username')}}">
                    @error('username')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">First Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="first_name" placeholder="Example : Jawad" required value="{{old('first_name')}}">
                    @error('first_name')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Last Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="last_name" placeholder="Example : Alam" required value="{{old('last_name')}}">
                    @error('last_name')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Contact Number <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="phone" placeholder="Example : 0300 1234567" required value="{{old('phone')}}">
                    @error('phone')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Business Address <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="address" placeholder="Example : Clifton Karachi" required value="{{old('address')}}">
                    @error('address')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">CNIC Number <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nic" placeholder="Example : 0000-0000000-0" required value="{{old('nic')}}">
                    @error('nic')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email Address <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Example : abc@gmail.com" required value="{{old('email')}}">
                    @error('email')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Province / City <span style="color: red">*</span></label>
                    <select name="city" class="form-control">
                      <option value="">--Select City--</option>
                      @foreach($city as $data)
                      <option value="{{$data->name}}">{{$data->name}}</option>
                      @endforeach
                    </select>
                    @error('city')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Assigned Business Area <span style="color: red">*</span></label>
                    <select name="area" class="form-control">
                      <option value="">--Select Area--</option>
                      @foreach($area as $area_data)
                      <option value="{{$area_data->name}}">{{$area_data->name}}</option>
                      @endforeach
                    </select>
                    @error('area')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Partner / Reseller Category <span style="color: red">*</span></label>
                    <select name="category" class="form-control">
                      <option value="">--Select Category--</option>
                      <option value="Diomond">Diomond</option>
                      <option value="Gold">Gold</option>
                      <option value="Silver">Silver</option>
                      <option value="Jublie">Jublie</option>
                      <option value="Silver Jublie">Silver Jublie</option>
                      <option value="plantinum">Plantinum</option>
                    </select>
                    @error('area')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description">Description <span style="color: red">*</span></label>
                    <textarea class="form-control summernote" name="description" value="{{old('description')}}" placeholder="Description Add Here............" ></textarea>
                    @error('description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Reseller Image <span style="color: red">*</span></label> <br>
                    <input type="file" class="form-control-file" name="reseller_image" >
                    @error('reseller_image')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" style="visibility: hidden">A</label>
                    <div class="icheck-success d-block">
                      <input type="checkbox"  {{old('status') != null? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1" value="1">
                      <label for="checkboxSuccess1">
                        Status (On & Off) <span style="color: red">*</span>
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
@endpush