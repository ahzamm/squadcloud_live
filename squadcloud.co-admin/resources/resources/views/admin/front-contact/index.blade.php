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
 <link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">
 <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">   
 <link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">
 @endpush
 @section('content')
 <style>
  .gap-5 {gap:5px}
</style>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card ">
            <div class="card-header">
              <h3 class="card-title"><span><i class="fa-solid fa-phone"></i></span> Contact Us Request's </h3>
              <div class="float-right">
                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#emailModal">Add Email</a>
                <!-- <a href="#" data-toggle="modal" data-target="#updateemailModal"  class="btn btn-secondary btn-sm">View Email</a> -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>Serial#</th>
                      <th>Full Name</th>
                      <th>Email Address</th>
                      <th>Phone Number</th>
                      <th>Request (Date & Time)</th>
                      <th>Request Messages</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data['contacts'] as $key=> $item)
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->phone}}</td>
                      <td>{{$item->created_at}}</td>
                      <td>{{$item->message}}</td>
                      <td style="white-space:nowrap">
                        <button class="btn btn-success btn-sm viewfrontContact" data-toggle="modal" data-target="#infoModal" data-route="{{ route('frontcontactrequest.show', ['id' => $item->id]) }}"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-danger btn-sm btnDeleteContact" data-value="{{$item->id}}"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Contact Detail</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <!-- <form id="insertProfile" action="{{route('user.update' , Auth::user()->id )}}" method="post" enctype="multipart/form-data">
            @csrf -->
            <!-- Modal Body -->
            <div class="modal-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Serial#</th>
                      <th>Full Name</th>
                      <th>Email Address</th>
                      <th>Phone Number</th>
                      <th>Request (Date & Time)</th>
                      <th>Request Messages</th>
                    </tr>
                    <tbody id="userInfo">
                    </tbody>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Add Email Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4>Add Email</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- Modal Body -->
          <form action="{{route('emailcontact.store')}}" method="POST">
            @csrf
            <div class="modal-body" id="emailContainer">
              @foreach ($data['email_contacts'] as $key=> $contact)
              <div class="d-flex gap-5 mb-2" id="row_1">
                <input type="text" class="form-control" name="adminemail[]" value="{{$contact->adminemail}}" placeholder="Enter Email">
                <button class="btn btn-danger btn-sm deleteRow" onclick="removeRow()"><i class="fa fa-minus"></i></button>
              </div>
              @endforeach
              <div class="d-flex gap-5 mb-2" id="row_1">
                <input type="text" class="form-control" name="adminemail[]" placeholder="Enter Email">
                <button type="button" class="btn btn-success" onclick="addRow()"><i class="fa fa-plus"></i></button>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" >Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End -->
  <!-- View Email Modal -->
<!-- <div class="modal fade" id="updateemailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>View Email</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body" id="emailContainer">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Action</th>
                </thead>
                <tbody>
                @foreach ($data['email_contacts'] as $key=> $contact)
                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$contact->adminemail}}</td>
                    <td><a href="{{route('emailcontact.destroy',['id'=>$contact->id])}}"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a></td>
                  </tr>
                @endforeach
                </tbody>
              </table>
          </div>
          </div>
        </div>
      </div> -->
    </div>
    <!-- End -->
    @include('admin.front-faq._modal')
    @endsection
    @push('scripts')
    <script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
    <script>
      function addRow() {
        let htmlRow = '<div class="d-flex gap-5 mb-2"><input type="text" class="form-control" name="adminemail[]" placeholder="Enter Email"><button class="btn btn-danger btn-sm deleteRow" onclick="removeRow()"><i class="fa fa-minus"></i></button></div>';
        $('#emailContainer').append(htmlRow);
      }
      $(document).on('click','.deleteRow',function(){
        $(this).parent().closest('div').remove();
      });
      function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
      }
      $(function () {
        $("#example1").DataTable({
          "responsive": true
    //   "autoWidth": false,
  });
      });
      $(document).on('click','#emailEdit',function(){
        $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
          <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
          </div>`);
        id = $(this).attr('data-value');
        $.ajax({
          method:'get',
          url:'/admin/front-emails/edit',
          dataType: 'html',
          success:function(res){
            $('#frontPagesModal').find('.modal-content').html(res);
          },
          error:function(jhxr,err,status)
          {
            console.log(jhxr);
          }
        })
      })
      $(document).on('click','.removeMail',function(){
        $(this).parents('li').remove();
      });
      $(document).on('click','#addEmail',function(){
        email = $('#email').val();
        if(email != '' && validateEmail(email) )
        {
          $('.todo-list').append(`<li>
            <span class="text">${email}</span>
            <span class="float-right removeMail" style="cursor: pointer">
            <i class="fas fa-times"></i>
            </span>
            <input type="hidden" name="emails[]" value="${email}">
            </li>`);
          $('#email').removeClass('is-invalid').val('');
        }
        else
        {
          $('#email').addClass('is-invalid')
        }
      })
  // changeContactEmail
  $(document).on('click','#updateEmails',function(){
    $.ajax({
      url: "/admin/front-emails/edit",
      type: "POST",
      data:  new FormData(document.forms.namedItem("changeContactEmail")),
      contentType: false,
      cache: false,
      processData:false,
      dataType:'JSON',
      beforeSend:function(){
            // $('#loader-img').css('display','block');
          },
          success:function(res){
           if(res.status)
           {
            $('#frontPagesModal').modal('hide');
            toastr.info('Emails Updated Successfully');
          }
        },
        error:function(jhxr,status,err)
        {
         console.log(jhxr);
       },
       complete:function()
       {
              //  $('#loader-img').css('display','none');
            }
          });
  })
  let deleteUrl = "{{route('user.destroy')}}";
  $(document).on('click' ,'.btnDeleteContact' , function() {
    parentRow = $(this).parents("tr");
    id = $(this).attr('data-value');
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
          method:'delete',
          url:'/admin/front-contact/'+id,
          dataType: 'json',
          success: function(res) {
            if(res.unauthorized == true)  {
              swal("Error!" , "No rights To Delete Contact Messages" , "error");
            }
            if (res.status) {
              $(parentRow).remove();
              swal('Deleted!', 'Contact Request Has been deleted', 'success');
                                // console.log("delete record");
                              } else {
                                //$(secondInput).siblings('span').removeClass('d-none');
                              }
                            },
                            error: function(jhxr, status, err) {
                              console.log(jhxr);
                            }
                          })
      } else if (result.dismiss === 'cancel') {
                    //  swal(
                    //      'Cancelled',
                    //      'Your imaginary data is safe :)',
                    //      'error'
                    //  )
                  }
                })
  })
        //delete menu end
      </script>
      <script>
       $(document).ready(function(){
        $(document).on('click', '.viewfrontContact', function(){
          var userId = $(this).data('value');
        var route = $(this).data('route'); // Get the route from data attribute
        $('#userInfo').html('<tr><td class="text-center" colspan="6"><strong>Data Loading...</strong></td></tr>');
        $.ajax({
          url: route,
          method: 'GET',
            data: { id: userId, nocache: new Date().getTime() }, // Pass the user ID as data
            success: function(response){
                // Update modal body with user details
                $('#userInfo').html('<tr><td>' + response.id + '</td><td>' + response.name + '</td><td>' + response.email + '</td><td>' + (response.phone ?? 'N/A') + 
                  '</td><td>' + response.created_at + '</td><td>' + response.message + '</td></tr>');
                console.log(route);
                console.log(response);
              },
              error: function(xhr){
                console.log(xhr.responseText);
              }
            });
      });
      });
    </script>
    @endpush
      <!-- Code Finalize -->