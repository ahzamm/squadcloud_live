@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header">
            <h3 class="card-title">
              Edit Site Message
            </h3>
          </div>
          <form action="{{route('message.update',$message_edit->id)}}" method="POST" enctype="multipart/form-data">
            <div class="card-body pad">
              @method('PUT')               
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="message" value="{{old('description')}}" rows="4" placeholder="Message add here.">{{$message_edit->message}}</textarea>
                    @error('message')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Image</label>
                    <img src="{{asset('message/'.$message_edit->image)}}" alt="" srcset="" class="img-fluid" height="20%" width="30%">
                    <input type="file" class="form-control-file" name="image" >
                    @error('image')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  {{ $message_edit->active == 1? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
                      <label for="checkboxSuccess1">
                        Status
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right">Update</button>
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
