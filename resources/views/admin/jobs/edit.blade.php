@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Vacancy</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('jobs.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('jobs.update',$job->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Job Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="job_title"  value="{{old('job_title') == NULL?$job->job_title:old('job_title') }}">
                  </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image <span style="color: red">*</span></label>
                      @isset($job->image)
                      <img src="{{ asset('frontend_assets/images/jobs/'. $job->image) }}" height="60"
                      width="120" alt="" srcset="" >
                      @endisset
                      <br><br>
                      <input type="file" value="{{ $job->image }}" name="image">
                    </div>
                  </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Description <span style="color: red">*</span></label>
                      <textarea name="job_description" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{$job->job_description}}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Location <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="location"  value="{{old('location') == NULL?$job->location:old('location') }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="employment_type">Employement Type <span style="color: red">*</span></label>
                        <select class="form-control" id="employment_type" name="employment_type">
                            <option value="">Select Employement Type</option>
                            <option value="Full Time" {{ (old('employment_type') ?? $job->employment_type) == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                            <option value="Part Time" {{ (old('employment_type') ?? $job->employment_type) == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                            <option value="Intern" {{ (old('employment_type') ?? $job->employment_type) == 'Intern' ? 'selected' : '' }}>Intern</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Salary Range <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="salary_range"  value="{{old('salary_range') == NULL?$job->salary_range:old('salary_range') }}">
                    </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  {{ $job->is_active == 1? 'checked' :'unchecked' }} name="is_active" id="checkboxSuccess1">
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
    </div>
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
