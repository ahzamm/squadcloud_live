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
 <div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card mt-3 card-outline card-info">
            <div class="card-header">
              <h3 class="card-title"><span><i class="fa-solid fa-box-open"></i></span> Packages</h3>
              <a class="btn btn-success btn-sm float-right" href="{{route('packages.create')}}"><i class="fa fa-plus"></i> Add Packages</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th>Serial#</th>
                      <th>Internet Package</th>
                      <th>Province</th>
                      <th>Internet Bandwidth (IPT)</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($packages as $key=> $item)
                    <tr class="table-row"> 
                      <td>{{++$key}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->province}}</td>
                      <td>{{$item->limit}}</td>
                      <td>{{$item->active == 1?'active':'deactive'}}</td>
                      <td class="d-flex justify-content-center" style="gap: 5px;">
                        <button class="btn btn-success btn-sm viewFrontPages" data-value="{{ $item->id }}"><i class="fa fa-eye"></i></button>
                        <a class="btn btn-primary btn-sm" href="{{ route('packages.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm btnDeleteMenu" data-value="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                      </td>
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
  let packageDeleteUrl  = "{{route('package.destroy')}}"; 
  $(document).on('click' ,'.btnDeleteMenu' ,function(){
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
    }).then( function(result) {
      if (result.value) {
       $.ajax({
        url:packageDeleteUrl+'/'+ id,
        method:'get',
        dataType:'json',
        success:function(res){
          if(res.unauthorized){
            swal('Error!' , 'No Rights To delete Package' , "error");
          }
          if(res.status)
          {
           swal('Updated!', 'Package deleted', 'success');
           location.reload();
                              // console.log("delete record");
                            }
                            else
                            {
                              //$(secondInput).siblings('span').removeClass('d-none');
                            }
                          },
                          error:function(jhxr,status,err){
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
        $(document).on('click','.viewFrontPages',function(){
          $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
            </div>`);
          id = $(this).attr('data-value');
          $.ajax({
            method:'get',
            url:'/admin/front-pages/'+id,
            dataType: 'html',
            success:function(res){
              $('#frontPagesModal').find('.modal-content').html(res);
            }
          })
        })
        $(document).on('click','#emailEditP, #emailEditC',function(){
          $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
            </div>`);
          valFlag = $(this).attr('data-value');
          $.ajax({
            method:'get',
            url:'/admin/partner-emails/'+valFlag,
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
      url: "/admin/partner-emails",
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
  });
  // Delete Function
</script>
<script>
  $(document).on('click', '.viewFrontPages', function() {
    $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
      <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
      </div>`);
    id = $(this).attr('data-value');
    $.ajax({
      method: 'get',
      url: '/admin/packages/' + id,
      dataType: 'html',
      success: function(res) {
        $('#frontPagesModal').find('.modal-content').html(res);
      }
    })
  })
</script>
@endpush
<!-- Code Finalize -->