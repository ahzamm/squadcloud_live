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
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-location-pin"></i></span> Province & Cities</h3>
              <div class="d-flex align-items-center ml-auto"> <!-- Updated class here -->
                <a class="btn btn-success btn-sm ml-2" href="{{ route('cities.create') }}"> <!-- Moved Add City button after dropdown -->
                  <i class="fa fa-plus"></i> Add Province Cities
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th>Serial#</th>
                      <th>City Name</th>
                      <th>Province Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cities as $key=> $item)
                    @foreach ($province as $key2 => $item2)
                    @if($item->province_id == $item2->id)
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item2->name}}</td>
                      <td>{{$item->active == 1?'active':'deactive'}}</td>
                      <td>
                        {{-- <button class="btn btn-success btn-sm viewFrontPages" data-value="{{$item->id}}"><i class="fa fa-eye"></i></button> --}}
                        <a class="btn btn-primary btn-sm" href="{{route('cities.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger deleteRecord btn-sm text-white" data-value="{{$item->id}}"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    @endif
                    @endforeach
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
  let deleteUrl = "{{route('destroy.cities')}}";
  $(document).on('click', '.deleteRecord', function() {
    var logo = $(this).data("value");
    var token = $("meta[name='csrf-token']").attr("content");
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
          url: deleteUrl + '/' + logo,
          method: 'get',
          dataType: 'json',
          success: function(res) {
            if(res.unauthorized ==true){
              swal('Error!', 'No Rights To Delete City ', 'error');
            }
            if (res.status) {
              swal('Updated!', 'City deleted', 'success');
              location.reload();
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
  function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }
  $(function() {
    $("#example1").DataTable({
      "responsive": true
      //   "autoWidth": false,
    });
  });
  $(document).on('click', '.viewFrontPages', function() {
    $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
      <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
      </div>`);
    id = $(this).attr('data-value');
    $.ajax({
      method: 'get',
      url: '/admin/front-pages/' + id,
      dataType: 'html',
      success: function(res) {
        $('#frontPagesModal').find('.modal-content').html(res);
      }
    })
  })
  $(document).on('click', '#emailEditP, #emailEditC', function() {
    $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
      <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
      </div>`);
    valFlag = $(this).attr('data-value');
    $.ajax({
      method: 'get',
      url: '/admin/partner-emails/' + valFlag,
      dataType: 'html',
      success: function(res) {
        $('#frontPagesModal').find('.modal-content').html(res);
      },
      error: function(jhxr, err, status) {
        console.log(jhxr);
      }
    })
  })
  $(document).on('click', '.removeMail', function() {
    $(this).parents('li').remove();
  });
  $(document).on('click', '#addEmail', function() {
    email = $('#email').val();
    if (email != '' && validateEmail(email)) {
      $('.todo-list').append(`<li>
        <span class="text">${email}</span>
        <span class="float-right removeMail" style="cursor: pointer">
        <i class="fas fa-times"></i>
        </span>
        <input type="hidden" name="emails[]" value="${email}">
        </li>`);
      $('#email').removeClass('is-invalid').val('');
    } else {
      $('#email').addClass('is-invalid')
    }
  })
  // changeContactEmail
  $(document).on('click', '#updateEmails', function() {
    $.ajax({
      url: "/admin/partner-emails",
      type: "POST",
      data: new FormData(document.forms.namedItem("changeContactEmail")),
      contentType: false,
      cache: false,
      processData: false,
      dataType: 'JSON',
      beforeSend: function() {
        // $('#loader-img').css('display','block');
      },
      success: function(res) {
        if (res.status) {
          $('#frontPagesModal').modal('hide');
          toastr.info('Emails Updated Successfully');
        }
      },
      error: function(jhxr, status, err) {
        console.log(jhxr);
      },
      complete: function() {
        //  $('#loader-img').css('display','none');
      }
    });
  })
</script>
@endpush