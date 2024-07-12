@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Vacancy</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('faqs.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form id="jobForm" action="{{ route('faqs.update', $faq->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Question <span style="color: red">*</span></label>
                      <textarea name="question" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{ old('question') == null ? $faq->question : old('question') }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Answer <span style="color: red">*</span></label>
                      <textarea name="answer" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{ old('answer') == null ? $faq->answer : old('answer') }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" {{ $faq->is_active == 1 ? 'checked' : 'unchecked' }} name="is_active" id="checkboxSuccess1">
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
    $(document).ready(function() {
      $('#pageContent').summernote({
        height: 300
      });
    });
  </script>
@endpush
