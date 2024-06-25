@extends('admin.layouts.app')
@section('content')
<style>
     .switch {
    position: relative;
    display: inline-block;
    width: 55px;
    height: 27px;
  }
  /* Hide default HTML checkbox */
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }
  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }
  .slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }
  input:checked + .slider {
    background-color: green;
  }
  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }
  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }
  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }
  .slider.round:before {
    border-radius: 50%;
  }
</style>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update General Configurations</h3>
                            <div class="ml-auto">
                            </div>
                        </div>
                        <form action="{{ route('careers.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            <div class="card-body pad">
                                @csrf
                                <div class="row">



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Top Heading <span style="color: red">*</span></label>
                                        @isset($career->top_heading)
                                            <input type="text" class="form-control" name="top_heading"
                                                value="{{ old('top_heading') == null ? $career->top_heading : old('top_heading') }}">
                                        @endisset
                                        @error('top_heading')
                                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Middle Heading <span style="color: red">*</span></label>
                                        @isset($career->middle_heading)
                                            <input type="text" class="form-control" name="middle_heading"
                                                value="{{ old('middle_heading') == null ? $career->middle_heading : old('middle_heading') }}">
                                        @endisset
                                        @error('middle_heading')
                                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Bottom Heading <span style="color: red">*</span></label>
                                        @isset($career->bottom_heading)
                                            <input type="text" class="form-control" name="bottom_heading"
                                                value="{{ old('bottom_heading') == null ? $career->bottom_heading : old('bottom_heading') }}">
                                        @endisset
                                        @error('bottom_heading')
                                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                                        @enderror
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
    <script>
        $(document).ready(function() {
          $('#example').DataTable();
          let changeStatusUrl  = "{{route('general-configurations.otp_configuration.update')}}";
              // Changing Status
              $(".status_check").on('change' , function(e){
                let currentStatus  = "";
                if($(this).prop('checked') == true){
                 currentStatus   = 1;
                 $(this).closest('tr').find('.status').text('active');
               }
               else{
                currentStatus = 0 ;
                $(this).closest('tr').find('.status').text('deactive');
              }
              var status =   $(this);
              e.preventDefault();
              $.ajax({
                url: changeStatusUrl ,
                type:"Post" ,
                data: { status : currentStatus},
                success:function(response){
                  if( response == "unauthorized"){
                    e.preventDefault();
                    swal("Error!" , "Status Not Changed , Because You have No Rights To change status" , "error");
                    status.prop('checked' , false);
                  }
                  if(response == "success"){
                    swal({
                      title: 'Status Changed!',
                      text: "User Status Has been Changed!",
                      animation: false,
                      customClass: 'animated pulse',
                      type: 'success',
                    });
                    location.reload();
                  } else {
                    swal({
                    title: 'Error occurred!',
                    text: "Failed to Change User Access Status!",
                    animation: false,
                    customClass: 'animated pulse',
                    type: 'error',
                    });
              }
                }
              })
            })
           });
          </script>

<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
@endpush
