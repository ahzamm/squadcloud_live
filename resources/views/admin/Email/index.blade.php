@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">
@endpush
@section('content')
<style>
  /* The switch - the box around the slider */
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
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-envelope"></i></span> Email Settings</h3>
              <div class="ml-auto">
                <a href="{{ route('email.create') }}" class="btn btn-success btn-sm">
                  <i class="fa fa-plus"></i> Add SMTP Server
                </a>
              </div>
            </div>
            <div class="card-body ">
              <div class="table-responsive ">
                <table class="table table-bordered table-striped" id="example">
                  <thead>
                    <tr>
                      <th>Serial#</th>
                      <th>SMTP Server</th>
                      <th>SMTP Port</th>
                      <th>Email Address</th>
                      <th>Email Password</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data['email'] as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->smtp_server}}</td>
                      <td>{{$item->port}}</td>
                      <td>{{$item->emails}}</td>
                      <td>{{$item->smtp_password}}</td>
                      <td>
                        <label class="switch">
                          <input type="checkbox" class="status_check" @if($item->status == 1) checked @endif  data-user-id="{{$item->id}}">
                          <span class="slider round"></span>
                        </label>
                      </td>
                      <td>
                        <a href="{{route('email.edit'  , $item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i></a>
                        <a class="btn btn-danger btn-sm btnDeleteMenu text-white" data-value="{{$item->id}}"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@push('scripts')
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
    let changeStatusUrl  = "{{route('email.status')}}";
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
          data: {id : $(this).attr("data-user-id") , status : currentStatus},
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
            }
          }
        })
      })
        // Delete Script
        let deleteUrl = "{{route('email.destroy')}}";
        $(document).on('click' ,'.btnDeleteMenu' , function() {
          menuId = $(this).attr('data-value');
          row = $(this);
          swal({
            title: 'Are you sure?',
            text: "You want to delete this record",
            animation: false,
            customClass: 'animated pulse',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            reverseButtons: true
          }).then(function(result) {
            if (result.value) {
              $.ajax({
                url: deleteUrl + '/' + menuId,
                method: 'get',
                dataType: 'json',
                success: function(res) {
                  if(res.unauthorized){
                    swal("Error!" , "No Rights To Delete Email" , "error");
                    location.reload();
                  }
                  if (res.status) {
                    $(row).parents('tr').remove();
                    swal('Deleted!', 'Email Has been deleted', 'success');
                              }
                            },
                            error: function(jhxr, status, err) {
                              console.log(jhxr);
                            }
                          })
            }
                })
        })
        //delete menu end
      });
    </script>
    @endpush
