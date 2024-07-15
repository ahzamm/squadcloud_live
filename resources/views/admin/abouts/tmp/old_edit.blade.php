@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update About</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('abouts.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('abouts.update',$about->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Video URL <span style="color: red">*</span></label>
                    @isset($about->video_url)
                    <input type="text" class="form-control" name="video_url"  value="{{old('video_url') == NULL?$about->video_url:old('video_url') }}">
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    @error('video_url')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Icon 1 <span style="color: red">*</span></label>
                    @isset($about->icon_1)
                    <img src="{{ asset('frontend_assets/images/abouts/'. $about->icon_1) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $about->icon_1 }}" name="icon_1">
                    @error('icon_1')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Heading 1 <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="heading_1"  value="{{old('heading_1') == NULL?$about->heading_1:old('heading_1') }}">
                    @error('heading_1')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Description 1 <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="description_1"  value="{{old('description_1') == NULL?$about->description_1:old('description_1') }}">
                    @error('description_1')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Icon 2 <span style="color: red">*</span></label>
                    @isset($about->icon_2)
                    <img src="{{ asset('frontend_assets/images/abouts/'. $about->icon_2) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $about->icon_2 }}" name="icon_2">
                    @error('icon_2')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Heading 2 <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="heading_2"  value="{{old('heading_2') == NULL?$about->heading_1:old('heading_2') }}">
                    @error('heading_2')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Description 2 <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="description_2"  value="{{old('description_1') == NULL?$about->description_1:old('description_2') }}">
                    @error('description_2')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Icon 3 <span style="color: red">*</span></label>
                    @isset($about->icon_3)
                    <img src="{{ asset('frontend_assets/images/abouts/'. $about->icon_3) }}" height="60"
                    width="120" alt="" srcset="" >
                    @endisset
                    <br><br>
                    <input type="file" value="{{ $about->icon_3 }}" name="icon_3">
                    @error('icon_3')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Heading 3 <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="heading_3"  value="{{old('heading_3') == NULL?$about->heading_3:old('heading_3') }}">
                    @error('heading_3')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Description 3 <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="description_3"  value="{{old('description_3') == NULL?$about->description_3:old('description_3') }}">
                    @error('description_3')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Closing_remarks <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="closing_remarks"  value="{{old('closing_remarks') == NULL?$about->closing_remarks:old('closing_remarks') }}">
                    @error('closing_remarks')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  {{ $about->is_active == 1? 'checked' :'unchecked' }} name="is_active" id="checkboxSuccess1">
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