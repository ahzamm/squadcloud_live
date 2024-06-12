@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Client</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('clients.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('careers.update',$career->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Job Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="job_title"  value="{{old('job_title') == NULL?$career->job_title:old('job_title') }}">
                    @error('job_title')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Description <span style="color: red">*</span></label>
                      <textarea name="job_description" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{$career->job_description}}</textarea>
                      @error('job_description')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Location <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="location"  value="{{old('location') == NULL?$career->location:old('location') }}">
                      @error('location')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Employment Type <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="employment_type"  value="{{old('employment_type') == NULL?$career->employment_type:old('employment_type') }}">
                      @error('employment_type')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Education Level <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="education_level"  value="{{old('education_level') == NULL?$career->education_level:old('education_level') }}">
                      @error('education_level')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Experience Level <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="experience_level"  value="{{old('experience_level') == NULL?$career->experience_level:old('experience_level') }}">
                      @error('experience_level')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Skills <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="skills"  value="{{old('skills') == NULL?$career->skills:old('skills') }}">
                      @error('skills')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Salary Range <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="salary_range"  value="{{old('salary_range') == NULL?$career->salary_range:old('salary_range') }}">
                      @error('salary_range')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Application Deadline <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="application_deadline"  value="{{old('application_deadline') == NULL?$career->application_deadline:old('application_deadline') }}">
                      @error('application_deadline')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Email <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="email"  value="{{old('email') == NULL?$career->email:old('email') }}">
                      @error('email')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Phone <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="phone"  value="{{old('phone') == NULL?$career->phone:old('phone') }}">
                      @error('phone')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Date Posted <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="date_posted"  value="{{old('date_posted') == NULL?$career->date_posted:old('date_posted') }}">
                      @error('date_posted')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  {{ $career->is_active == 1? 'checked' :'unchecked' }} name="is_active" id="checkboxSuccess1">
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
