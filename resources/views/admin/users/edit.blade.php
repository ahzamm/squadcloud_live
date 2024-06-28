@extends('admin.layouts.app')
@section('content')
  <link rel="stylesheet" href="{{ asset('site/sweet-alert/sweetalert2.css') }}">
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-users"></i></span> Edit Management User</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('user.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('user.update', $user->id) }}" method="POST" id="submitForm" enctype="multipart/form-data">
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">User Name <span style="color: red">*</label>
                      <input type="text" class="form-control" id="username" name="user_name" placeholder="Example : Administrator"
                        value="{{ old('user_name') == null ? $user->name : old('user_name') }}">
                      @error('name')
                        <p class="text-danger  mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">First Name <span style="color: red">*</label>
                      <input type="text" class="form-control" id="firstname" name="first_name" placeholder="Example : Jawad"
                        value="{{ old('first_name') == null ? $user->first_name : old('first_name') }}">
                      @error('email')
                        <p class="text-danger  mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Last Name <span style="color: red">*</label>
                      <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Example : Alam"
                        value="{{ old('last_name') == null ? $user->last_name : old('last_name') }}">
                      @error('email')
                        <p class="text-danger  mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Email Address <span style="color: red">*</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Example : abc@gmail.com" value="{{ old('email') == null ? $user->email : old('email') }}">
                      @error('email')
                        <p class="text-danger  mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Password <span style="color: red">*</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password must be 8 characters" value="{{ old('password', '') }}">
                      @error('password')
                        <p class="text-danger mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Confirm Password <span style="color: red">*</label>
                      <input type="password" class="form-control" id="password" name="confirm_password" placeholder="Confirm your password" value="{{ old('confirm_password', '') }}">
                      @error('password')
                        <p class="text-danger mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Contact Number <span style="color: red">*</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Example : 0300 1234567" value="{{ old('phone') == null ? $user->phone : old('phone') }}">
                      @error('email')
                        <p class="text-danger  mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">CNIC Number <span style="color: red">*</label>
                      <input type="text" class="form-control" id="cnic" name="cnic" placeholder="0000-0000000-0" value="{{ old('cnic') == null ? $user->cnic : old('cnic') }}">
                      @error('password')
                        <p class="text-danger mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="department">Department <span style="color: red">*</span></label>
                      <select class="form-control" id="department" name="department">
                        <option value="">Select Department</option>
                        <option value="Administrator" {{ old('department', $user->department) == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                        <option value="Back-End Developer" {{ old('department', $user->department) == 'Back-End Developer' ? 'selected' : '' }}>Back-End Developer</option>
                        <option value="Front-End Developer" {{ old('department', $user->department) == 'Front-End Developer' ? 'selected' : '' }}>Front-End Developer</option>
                        <option value="Digital Marketing" {{ old('department', $user->department) == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                        <option value="Content Writer" {{ old('department', $user->department) == 'Content Writer' ? 'selected' : '' }}>Content Writer</option>
                      </select>
                    </div>


                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="address">Address <span style="color: red">*</span></label>
                      <textarea name="address" id="address" cols="30" rows="10" placeholder="Example: Clifton Karachi" class="form-control">{{ old('address', $user->address) }}</textarea>
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
      </div>
    </section>
  </div>
@endsection
@push('scripts')
  <script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
  @if (Session::has('error'))
    <script>
      swal({
        title: 'Error!',
        text: '{{ Session::get('error') }}',
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      });
    </script>
  @endif
  <script>
    $(document).ready(function() {
      $("#submitForm").submit(function(e) {
        if ($('#username').val() == "") {
          e.preventDefault();
          swal({
            title: 'You are missing Something!',
            text: "User Name is required!",
            animation: false,
            customClass: 'animated pulse',
            type: 'error',
          });
          return false;
        }
        if ($('#firstname').val() == "") {
          e.preventDefault();
          swal({
            title: 'You are missing Something!',
            text: "First Name is required!",
            animation: false,
            customClass: 'animated pulse',
            type: 'error',
          });
          return false;
        }
        if ($('#lastname').val() == "") {
          e.preventDefault();
          swal({
            title: 'You are missing Something!',
            text: "Last Name is required!",
            animation: false,
            customClass: 'animated pulse',
            type: 'error',
          });
          return false;
        }
        if ($('#email').val() == "") {
          e.preventDefault();
          swal({
            title: 'You are missing Something!',
            text: "Email is required!",
            animation: false,
            customClass: 'animated pulse',
            type: 'error',
          });
          return false;
        }
        if ($('#phone').val() == "") {
          e.preventDefault();
          swal({
            title: 'You are missing Something!',
            text: "Phone Number is required!",
            animation: false,
            customClass: 'animated pulse',
            type: 'error',
          });
          return false;
        }
        if ($('#cnic').val() == "") {
          e.preventDefault();
          swal({
            title: 'You are missing Something!',
            text: "Cnic Number is required!",
            animation: false,
            customClass: 'animated pulse',
            type: 'error',
          });
          return false;
        }
        if ($('#department').val() == "") {
          e.preventDefault();
          swal({
            title: 'You are missing Something!',
            text: "Department is required!",
            animation: false,
            customClass: 'animated pulse',
            type: 'error',
          });
          return false;
        }
        if ($('#address').val() == "") {
          e.preventDefault();
          swal({
            title: 'You are missing Something!',
            text: "Address is required!",
            animation: false,
            customClass: 'animated pulse',
            type: 'error',
          });
          return false;
        }
      });
    })
  </script>
@endpush
