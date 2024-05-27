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
 @push('style')
 <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
 <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
 @endpush
 @section('content')
 <div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-circle-question"></i></span> Update Frequently Ask Question (FAQ)</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('front-faqs.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('front-faqs.update',$faq->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Question <span style="color: red">*</span></label>
                    <textarea name="question" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{$faq->question}}</textarea>
                    @error('question')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Answer <span style="color: red">*</span></label>
                    <textarea name="answer" rows="5" placeholder="Example : I am fine" required class="form-control summernote">{{$faq->answer}}</textarea>
                    @error('answer')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="">Is Active <span style="color: red">*</span></label>
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" {{$faq->active == 1?'checked':''}}  name="active" id="checkboxSuccess1">
                      <label for="checkboxSuccess1">
                        Status (On & Off)
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-primary float-right"><i class=""></i>Update</button>
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