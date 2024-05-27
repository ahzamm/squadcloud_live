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
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-user-tie"></i></span> Update Reseller & Partner</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('reseller.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('reseller.update',$edit_reseller->id)}}" method="POST" enctype="multipart/form-data">
            <div class="card-body pad">
              @method('PUT')               
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Partner & Reseller Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="username" placeholder="Example : Jawad Alam" required value="{{$edit_reseller->username}}">
                    @error('username')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">First Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="first_name" placeholder="Example : Jawad" required value="{{$edit_reseller->first_name}}">
                    @error('first_name')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Last Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="last_name" placeholder="Example : Alam" required value="{{$edit_reseller->last_name}}">
                    @error('last_name')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Contact Number <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="phone" placeholder="Example : 0300 1234567" required value="{{$edit_reseller->phone}}">
                    @error('phone')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Business Address <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="address" placeholder="Example : Clifton Karachi" required value="{{$edit_reseller->address}}">
                    @error('address')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">CNIC Number <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nic" placeholder="Example : 0000-0000000-0" required value="{{$edit_reseller->nic}}">
                    @error('nic')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email Address <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Example : abc@gmail.com" required value="{{$edit_reseller->email}}">
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
                      <option value="{{$data->name}}" @if($data->name == $edit_reseller->city )selected @endif>{{$data->name}}</option>
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
                      <option value="{{$area_data->name}}" @if($area_data->name == $edit_reseller->area )selected @endif>{{$area_data->name}}</option>
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
                      <option value="Diomond" @if($edit_reseller->category == 'Diomond')selected @endif>Diomond</option>
                      <option value="Gold" @if($edit_reseller->category == 'Gold')selected @endif>Gold</option>
                      <option value="Silver" @if($edit_reseller->category == 'Silver')selected @endif>Silver</option>
                      <option value="Jublie" @if($edit_reseller->category == 'Jublie')selected @endif>Jublie</option>
                      <option value="Silver Jublie" @if($edit_reseller->category == 'Silver Jublie')selected @endif>Silver Jublie</option>
                      <option value="Plantinum" @if($edit_reseller->category == 'Plantinum')selected @endif>Plantinum</option>
                    </select>
                    @error('area')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description">Description <span style="color: red">*</span></label>
                    <textarea class="form-control summernote" name="description" value="{{old('description')}}" rows="4" placeholder="Description Add Here............">{{$edit_reseller->description}}</textarea>
                    @error('description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Reseller Image <span style="color: red">*</span></label>
                    <!-- <img src="{{asset('reseller-images/'.$edit_reseller->image)}}" alt="" srcset="" class="img-responsive" height="140" width="140"> -->
                    <input type="file" class="form-control-file" name="reseller_image" >
                    @error('reseller_image')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group clearfix">
                    <label for="" style="visibility: hidden">A</label>
                    <div class="icheck-success d-block">
                      <input type="checkbox"  @if($edit_reseller->active == 1) checked @endif name="status" id="checkboxSuccess1" value="1">
                      <label for="checkboxSuccess1">
                        Status (On & Off) <span style="color: red">*</span>
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
@endpush
<!-- Code Finalize -->