@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info mt-2">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Add Team</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('teams.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
              <div class="card-body pad">
                @csrf
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="name" placeholder="Example : Bitcoin" value="{{ old('name') }}">
                      @error('name')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Photo <span style="color: red">*</span></label>
                      <input type="file" name="image">
                      @error('image')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Designation <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="designation" placeholder="Transforming Ideas into Innovative Mobile Experiences" value="{{ old('designation') }}">
                      @error('designation')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">LinkedIn <span style="color: red">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="linkedinPrefix">https://</span>
                        </div>
                        <input type="text" class="form-control" id="linkedinInput" name="linkedin" placeholder="Enter your LinkedIn URL" value="{{ old('linkedin') }}">
                      </div>
                      @error('linkedin')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
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
