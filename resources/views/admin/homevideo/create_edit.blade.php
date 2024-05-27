@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><i class="fa-solid fa-images"></i></span> {{$Title}}</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{ $Back }}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          @foreach ($errors->all() as $error)
              <li class="alert alert-danger">{{$error}}</li>
          @endforeach
          <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
              <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="">Upload Video <span style="color: red">*</span></label> <br>
                    @if(isset($data))
                    <video controls width="200" class="mt-3 mb-3">
                      <source src="{{ asset('HomeVideo/' . $data->video ) }}" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                    <input type="file" class="form-control-file" name="video" id="video">
                    @else
                    <input type="file" class="form-control-file" name="video" id="video" required>
                    @endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <label for="" style="visibility: hidden">A</label>
                    <div class="icheck-success d-block">
                      <input type="checkbox" name="active" id="checkboxSuccess1" {{ isset($data) && $data->active ? 'checked' : '' }}>
                      <label for="checkboxSuccess1">
                        Status (On & Off)
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-primary float-right">{{$SaveButoon}}</button>
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