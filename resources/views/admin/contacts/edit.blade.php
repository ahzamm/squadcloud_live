@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Contact</h3>
            <div class="ml-auto">
              <!-- <a class="btn btn-outline-secondary btn-sm" href="{{route('contacts.message_request')}}">
                <i class="fa fa-arrow-left"></i> Message Requests
              </a> -->
              <a class="btn btn-success btn-sm float-right" href="{{route('contacts.message_request')}}">  Message Requests  </a>
            </div>
          </div>
          <form action="{{route('contacts.update',$contact->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Location URL <span style="color: red">*</span></label>
                    @isset($contact->office_hours_end)
                    <input type="text" class="form-control" name="location_url"  value="{{old('location_url') == NULL?$contact->location_url:old('location_url') }}">
                    @endisset
                    @error('location_url')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Title <span style="color: red">*</span></label>
                    @isset($contact->title)
                    <input type="text" class="form-control" name="title"  value="{{old('title') == NULL?$contact->title:old('title') }}">
                    @endisset
                    
                    @error('title')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Tagline <span style="color: red">*</span></label>
                    @isset($contact->tagline)
                    <input type="text" class="form-control" name="tagline"  value="{{old('tagline') == NULL?$contact->tagline:old('tagline') }}">
                    @endisset
                    
                    @error('tagline')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Phone <span style="color: red">*</span></label>
                    @isset($contact->phone)
                    <input type="text" class="form-control" name="phone"  value="{{old('phone') == NULL?$contact->phone:old('phone') }}">
                    @endisset
                    
                    @error('phone')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email <span style="color: red">*</span></label>
                    @isset($contact->email)
                    <input type="text" class="form-control" name="email"  value="{{old('email') == NULL?$contact->email:old('email') }}">
                    @endisset
                    
                    @error('email')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Address <span style="color: red">*</span></label>
                    @isset($contact->address)
                    <input type="text" class="form-control" name="address"  value="{{old('address') == NULL?$contact->address:old('address') }}">
                    @endisset
                    
                    @error('address')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Office Openning Timming <span style="color: red">*</span></label>
                    @isset($contact->office_hours_start)
                    <input type="text" class="form-control" name="office_hours_start"  value="{{old('office_hours_start') == NULL?$contact->office_hours_start:old('office_hours_start') }}">
                    @endisset
                    
                    @error('office_hours_start')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Office Colsing Timming <span style="color: red">*</span></label>
                    @isset($contact->office_hours_end)
                    <input type="text" class="form-control" name="office_hours_end"  value="{{old('office_hours_end') == NULL?$contact->office_hours_end:old('office_hours_end') }}">
                    @endisset
                    
                    @error('office_hours_end')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
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