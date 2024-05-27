@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Add About</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('abouts.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('abouts.store')}}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Video URL <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="video_url" placeholder="Example : 15 Mbps" required value="{{old('video_url')}}">
                    @error('video_url')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Icon 1 <span style="color: red">*</span></label><br>
                    <input type="file" name="icon_1">
                    @error('icon_1')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Heading 1<span style="color: red">*</span></label><br>
                    <input type="text" class="form-control" name="heading_1" placeholder="Example : Green" required value="{{old('heading_1')}}">
                    @error('heading_1')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Description 1<span style="color: red">*</span></label><br>
                    <input type="text" class="form-control" name="description_1" placeholder="Example : Green" required value="{{old('description_1')}}">
                    @error('description_1')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Icon 2 <span style="color: red">*</span></label><br>
                    <input type="file" name="icon_2">
                    @error('icon_2')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Heading 2<span style="color: red">*</span></label><br>
                    <input type="text" class="form-control" name="heading_2" placeholder="Example : Green" required value="{{old('heading_2')}}">
                    @error('heading_2')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Description 2<span style="color: red">*</span></label><br>
                    <input type="text" class="form-control" name="description_2" placeholder="Example : Green" required value="{{old('description_2')}}">
                    @error('description_2')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Icon 3 <span style="color: red">*</span></label><br>
                    <input type="file" name="icon_3">
                    @error('icon_3')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Heading 3<span style="color: red">*</span></label><br>
                    <input type="text" class="form-control" name="heading_3" placeholder="Example : Green" required value="{{old('heading_3')}}">
                    @error('heading_3')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Description 3<span style="color: red">*</span></label><br>
                    <input type="text" class="form-control" name="description_3" placeholder="Example : Green" required value="{{old('description_3')}}">
                    @error('description_3')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Closing Remarks<span style="color: red">*</span></label><br>
                    <input type="text" class="form-control" name="closing_remarks" placeholder="Example : Green" required value="{{old('closing_remarks')}}">
                    @error('closing_remarks')
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