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
 <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
 @endpush
 @section('content')
 <div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0">View All Employees</h3>
              <a href="{{ route('employee.create') }}" class="btn btn-success btn-sm ml-auto">
                <i class="fa fa-plus"></i> Add Employee
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($employees as $key=> $item)
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->active == 1?'active':'deactive'}}</td>
                      <td>
                        {{-- <button class="btn btn-success btn-sm viewFrontPages" data-value="{{$item->id}}"><i class="fa fa-eye"></i></button> --}}
                        <a class="btn btn-primary btn-sm" href="{{route('employee.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
                        <button class="btn btn-sm btn-info btnShowAccessModal" data-value="{{$item->id}}"><i class="fa fa-unlock"></i></button>
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
{{-- @include('admin.front_pages._modal') --}}
<div class="modal fade" id="modalShowAccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modify Member Access</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalBody">
        <div class="p-2 d-flex justify-content-center">
          <div class="sk-wave text-center">
            <div class="sk-rect sk-rect1"></div>
            <div class="sk-rect sk-rect2"></div>
            <div class="sk-rect sk-rect3"></div>
            <div class="sk-rect sk-rect4"></div>
            <div class="sk-rect sk-rect5"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true
      //   "autoWidth": false,
    });
  });
  //   $(document).on('click','.viewFrontPages',function(){
  //       $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
  //             <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
  //         </div>`);
  //         id = $(this).attr('data-value');
  //         $.ajax({
  //             method:'get',
  //             url:'/admin/front-pages/'+id,
  //             dataType: 'html',
  //             success:function(res){
  //                 $('#frontPagesModal').find('.modal-content').html(res);
  //             }
  //         })
  //   })
  $(document).on('click', '.btnShowAccessModal', function() {
    $('#modalShowAccess').modal('show');
    id = $(this).attr('data-value');
    $.ajax({
      type: 'GET',
      url: '/admin/useraccess/show/' + id,
      dataType: 'html',
      beforeSend: function() {
        $('#modalBody').html(`<div class="p-2 d-flex justify-content-center">
          <div class="sk-wave text-center">
          <div class="sk-rect sk-rect1"></div>
          <div class="sk-rect sk-rect2"></div>
          <div class="sk-rect sk-rect3"></div>
          <div class="sk-rect sk-rect4"></div>
          <div class="sk-rect sk-rect5"></div>
          </div>
          </div>`);
      },
      success: function(res) {
        $('#modalBody').html(res);
      },
      error: function(jhxr, status, err) {
        console.log(jhxr);
      },
      complete: function() {
      }
    })
  });
  $(document).on('change', '.changeAccess', function() {
    status = 0;
    accessId = $(this).attr('data-value');
    if ($(this).prop("checked") == true) {
      status = 1;
      // console.log(accessId);
    } else if ($(this).prop("checked") == false) {
      status = 0;
    }
    $.ajax({
      type: 'POST',
      url: '/admin/useraccess/update/' + accessId,
      data: {
        access_status: status,
      },
      dataType: 'json',
      beforeSend: function() {
      },
      success: function(res) {
        if (res.status) {
          Messenger().post({
            message: "Access Status Change Successfully.. !",
            type: "success"
          });
        }
      },
      error: function(jhxr, status, err) {
        console.log(jhxr);
      },
      complete: function() {
      }
    })
  })
</script>
@endpush
<!-- Code Finalize -->