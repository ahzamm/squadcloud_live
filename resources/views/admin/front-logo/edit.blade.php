@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-copyright"></i></span> Update Brand (Logo & Footer)</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('logo.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('logo.update',$logo_edit->id)}}" method="POST" enctype="multipart/form-data">
            <div class="card-body pad">
              @method('PUT')               
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Upload Brand Logo (Large Size) <span style="color: red">*</span></label>
                    <img src="{{ asset('front-logo/'.$logo_edit->image) }}" height="60"
                    width="120" alt="" srcset="" >
                    <input type="file" class="form-control-file" name="image" id="image">
                    @error('image')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Upload Brand Logo (Small Size) <span style="color: red">*</span></label>
                    <img src="{{ asset('small-front-logo/'.$logo_edit->small_image) }}" height="60"
                    width="120" alt="" srcset="" >
                    <input type="file" class="form-control-file" name="smallLogo" id="smallLogo">
                    @error('smallLogo')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Website Title </label>
                    <input type="text" class="form-control"  name="title" value="{{$logo_edit->title}}" id="title" placeholder="Example : Blink Broadband" required>
                    @error('title')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Website Footer </label>
                    <input type="text" class="form-control" value="{{$logo_edit->footer}}"  name="footer" id="title" placeholder="Example : Powerd By SquadCloud" required>
                    @error('footer')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group clearfix">
                    <label for="" style="visibility: hidden">A</label>
                    <div class="icheck-success d-block">
                      <input type="checkbox"  {{ $logo_edit->active == 1 ? 'checked' : 'unchecked' }} name="status" id="checkboxSuccess1">
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