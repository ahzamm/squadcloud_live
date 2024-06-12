@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Add Job</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('careers.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('careers.store')}}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Example : 15 Mbps" required value="{{old('title')}}">
                    @error('title')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Description <span style="color: red">*</span></label>
                    <textarea name="description" rows="4" placeholder=""  class="form-control summernote">{{old('description')}}</textarea>
                    @error('color')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Location <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="location" placeholder="Example : 15 Mbps" required value="{{old('location')}}">
                      @error('location')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Employement Type <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="employment_type" placeholder="Example : 15 Mbps" required value="{{old('employment_type')}}">
                      @error('employment_type')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Education Level <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="education_level" placeholder="Example : 15 Mbps" required value="{{old('education_level')}}">
                      @error('education_level')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Experience Level <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="experience_level" placeholder="Example : 15 Mbps" required value="{{old('experience_level')}}">
                      @error('experience_level')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Skills <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="skills" placeholder="Example : 15 Mbps" required value="{{old('skills')}}">
                      @error('skills')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Salary Range <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="salary_range" placeholder="Example : 15 Mbps" required value="{{old('salary_range')}}">
                      @error('salary_range')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Application Deadline <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="application_deadline" placeholder="Example : 15 Mbps" required value="{{old('application_deadline')}}">
                      @error('application_deadline')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Email <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="email" placeholder="Example : 15 Mbps" required value="{{old('email')}}">
                      @error('email')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Phone <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="phone" placeholder="Example : 15 Mbps" required value="{{old('phone')}}">
                      @error('phone')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Date Posted <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="date_posted" placeholder="Example : 15 Mbps" required value="{{old('date_posted')}}">
                      @error('date_posted')
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
